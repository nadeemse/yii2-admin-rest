<?php

/**
 * Voda text class
 * This will use to send sms to customers
 */
namespace common\helpers\smsGatway;

use common\helpers\CurlHelper;
use api\core\components\api\exception\RestException;

class VodaText
{
    const USER_ID = '20055721';
    const USER_PASS = '4rzdzd';
    const SENDER = 'Brrat';

    public function sendSms($phone_number, $country_code, $sms) {

        $url = 'http://mshastra.com/sendurlcomma.aspx?user='.self::USER_ID.'&pwd='.self::USER_PASS.
            '&senderid='.self::SENDER.'&mobileno='.$phone_number.'&msgtext='. $sms.'&priority=High&CountryCode='.$country_code;

       $response = CurlHelper::getUrl($url);

        echo '<pre>';
        var_dump($url, $response);
        die();
    }

}