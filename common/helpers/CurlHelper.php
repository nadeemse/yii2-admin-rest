<?php
/**
 * Created by PhpStorm.
 * User: nadeemakhtar
 * Date: 1/25/16
 * Time: 5:37 PM
 */
namespace common\helpers;


class CurlHelper
{
    protected static function defaultSettings()
    {
        return array(
            CURLOPT_AUTOREFERER => true,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        );
    }

    /**
     * @param string $url
     * @param array $additionalConfig
     * @param int $retryCount
     * @param int $sleepMultiplier if > 0, then sleep $sleepMultiplier * $retryIndex seconds before next request
     * after unsuccessful request
     * @return mixed
     * @throws CurlException
     * @throws \Exception
     */

    public static function getUrlFailSafe($url, $additionalConfig = array(), $retryCount = 5, $sleepMultiplier = 2)
    {
        for ($i = 0; $i < $retryCount; $i++) {
            try {
                return self::getUrl($url, $additionalConfig);
            } catch (CurlException $e) {
                sleep($i * $sleepMultiplier);
                if ($i + 1 == $retryCount) {
                    throw $e;
                }
            }
        }

        return false;
    }

    /**
     * @param string $url
     * @param array $additionalConfig
     * @throws CurlException
     * @return mixed downloaded data
     */
    public static function getUrl($url, $additionalConfig = array())
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $errors = curl_error($ch);
        if ($data === false) {
            throw new CurlException("retrieving url $url failed with error: " . curl_error($ch));
        }
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpStatus >= 422) {
            return false;
        }

        return $data;
    }

    /**
     * @param string $url
     * @param array $postFields
     * @param array $additionalConfig
     * @return mixed returned data
     * @throws CurlException
     */
    public static function postUrl($url, $postFields, $additionalConfig = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt_array($ch, self::defaultSettings() + $additionalConfig);
        $data = curl_exec($ch);

        if ($data === false) {
            /*throw new CurlException(
                "posting to $url failed with error: " .
                curl_error($ch) . ". postFields: " . print_r($postFields, true)
            );*/
        }

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpStatus >= 400) {
            /*throw new CurlException(
                "url $url return $httpStatus response code. postFields: " .
                print_r($postFields, true) . "\nreturned data: $data", $httpStatus, $data
            );*/
        }

        return $data;
    }

    /**
     * @param string $url
     * @param string $toFile file name
     * @param array $additionalConfig
     * @throws CurlException
     */
    public static function downloadToFile($url, $toFile, $additionalConfig = array())
    {
        $fp = fopen($toFile, 'w');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt_array($ch, self::defaultSettings() + $additionalConfig);
        $res = curl_exec($ch);
        if ($res === false) {
            throw new CurlException("retrieving url $url failed with error: " . curl_error($ch));
        }
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);

        if ($httpStatus >= 400) {
            throw new CurlException("url $url return $httpStatus response code", $httpStatus);
        }
    }

    /**
     * @param array $urlsToFiles
     * @param callable $callback function(string $url, string $toFile, CurlException|null $e)
     * @param array $additionalConfig
     * @param int $parallelDownloads
     * @throws CurlException
     */
    public static function batchDownload($urlsToFiles, $callback, $additionalConfig = array(), $parallelDownloads = 5)
    {
        $selectTimeout = 1;
        $options = self::defaultSettings() + $additionalConfig;
        $requests = array();

        $master = curl_multi_init();

        /**
         * @param string $url
         * @param string $toFile
         * @throws CurlException
         */
        $addRequest = function ($url, $toFile) use ($options, $master, &$requests) {
            $fp = fopen($toFile, 'w');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt_array($ch, $options);
            if (CURLM_OK != $res = curl_multi_add_handle($master, $ch)) {
                throw new CurlException("error($res) while adding curl multi handle");
            }
            $requests[(int)$ch] = array(
                'url' => $url,
                'filePointer' => $fp,
                'fileName' => $toFile,
            );
        };

        $i = 0;
        foreach (array_slice($urlsToFiles, $i, $parallelDownloads, true) as $url => $toFile) {
            $addRequest($url, $toFile);
            $i++;
        }

        do {
            while (CURLM_CALL_MULTI_PERFORM == $res = curl_multi_exec($master, $running)) {
            }
            if ($res != CURLM_OK) {
                throw new CurlException("curl_multi_exec failed with error code " . $res);
            }

            while ($done = curl_multi_info_read($master)) {
                $e = null;
                $ch = $done['handle'];
                $request = $requests[(int)$ch];
                if ($done['result'] != CURLE_OK) {
                    $e = new CurlException("retrieving url {$request['url']} failed with error: " . curl_error($ch));
                }

                $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($httpStatus >= 400) {
                    $e = new CurlException("url {$request['url']} return $httpStatus response code", $httpStatus);
                }

                fclose($request['filePointer']);
                call_user_func($callback, $request['url'], $request['fileName'], $e);

                if ($i < count($urlsToFiles)) {
                    $entry = array_slice($urlsToFiles, $i++, 1, true);
                    $addRequest(key($entry), reset($entry));
                    $running = true;
                }

                curl_multi_remove_handle($master, $ch);
                curl_close($ch);
            }
            if ($running) {
                curl_multi_select($master, $selectTimeout);
            }
        } while ($running);

        curl_multi_close($master);
    }

    /**
     * @param string[] $urls
     * @param callable $callback function(string $url, string $result, CurlException|null $e)
     * @param array $additionalConfig
     * @param int $parallelDownloads
     * @throws CurlException
     */
    public static function batchGet($urls, $callback, $additionalConfig = array(), $parallelDownloads = 5)
    {
        $selectTimeout = 1;
        $options = self::defaultSettings() + $additionalConfig;
        $requests = array();

        $master = curl_multi_init();

        /**
         * @param string $url
         * @throws CurlException
         */
        $addRequest = function ($url) use ($options, $master, &$requests) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt_array($ch, $options);
            if (CURLM_OK != $res = curl_multi_add_handle($master, $ch)) {
                throw new CurlException("error($res) while adding curl multi handle");
            }
            $requests[(int)$ch] = array(
                'url' => $url,
            );
        };

        $i = 0;
        foreach (array_slice($urls, $i, $parallelDownloads) as $url) {
            $addRequest($url);
            $i++;
        }

        do {
            while (CURLM_CALL_MULTI_PERFORM == $res = curl_multi_exec($master, $running)) {
            }
            if ($res != CURLM_OK) {
                throw new CurlException("curl_multi_exec failed with error code " . $res);
            }

            while ($done = curl_multi_info_read($master)) {
                $e = null;
                $ch = $done['handle'];
                $request = $requests[(int)$ch];
                if ($done['result'] != CURLE_OK) {
                    $e = new CurlException("retrieving url {$request['url']} failed with error: " . curl_error($ch));
                }

                $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($httpStatus >= 400) {
                    $e = new CurlException("url {$request['url']} return $httpStatus response code", $httpStatus);
                }

                $content = curl_multi_getcontent($ch);
                call_user_func($callback, $request['url'], $content, $e);

                foreach (array_slice($urls, $i, 1) as $url) {
                    $addRequest($url);
                    $i++;
                    $running = true;
                }

                curl_multi_remove_handle($master, $ch);
                curl_close($ch);
            }
            if ($running) {
                curl_multi_select($master, $selectTimeout);
            }
        } while ($running);

        curl_multi_close($master);
    }
}

class CurlException extends \Exception
{
    /** @var string */
    protected $data;

    public function __construct($message = "", $code = 0, $data = '', \Exception $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    public function getData()
    {
        return $this->data;
    }
}