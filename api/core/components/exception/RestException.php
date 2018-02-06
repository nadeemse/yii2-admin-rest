<?php

namespace api\core\components\exception;

use yii\base\Exception;
use yii\web\NotFoundHttpException;

class RestException extends Exception
{

    /*
    100	Continue
    101	Switching Protocols
    102	Processing
    200	OK
    201	Created
    202	Accepted
    203	Non-Authoritative Information
    204	No Content
    205	Reset Content
    206	Partial Content
    207	Multi-Status
    300	Multiple Choices
    301	Moved Permanently
    302	Moved Temporarily
    303	See Other
    304	Not Modified
    305	Use Proxy
    307	Temporary Redirect
    308	Permanent Redirect
    400	Bad Request
    401	Unauthorized
    402	Payment Required
    403	Forbidden
    404	Not Found
    405	Method Not Allowed
    406	Not Acceptable
    407	Proxy Authentication Required
    408	Request Time-out
    409	Conflict
    410	Gone
    411	Length Required
    412	Precondition Failed
    413	Request Entity Too Large
    414	Request-URI Too Large
    415	Unsupported Media Type
    416	Requested Range Not Satisfiable
    417	Expectation Failed
    418	I\ m a teapot
    422	Unprocessable Entity
    423	Locked
    424	Failed Dependency
    425	Unordered Collection
    426	Upgrade Required
    428	Precondition Required
    429	Too Many Requests
    431	Request Header Fields Too Large
    500	Internal Server Error
    501	Not Implemented
    502	Bad Gateway
    503	Service Unavailable
    504	Gateway Time-out
    505	HTTP Version Not Supported
    506	Variant Also Negotiates
    507	Insufficient Storage
    509	Bandwidth Limit Exceeded
    510	Not Extended
    511	Network Authentication Required
    */



    /**
     * DESC    Through an error with code 204 if the result not found
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    Public static function dataNotFound(){

        throw new \yii\web\HttpException(204, 'No content found against the query', 405);

    }

    /**
     * DESC  through an exception if query parameters is not valid
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    Public static function parametersNotValid($message){

        throw new \yii\web\HttpException(204, $message, 405);


    }

    /**
     * DESC     Through an exception if query parameter is empty
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    Public static function parametersEmpty(){

        throw new \yii\web\HttpException(206, 'Query parameters Should not empty', 405);


    }

    /**
     * DESC        Through and exception if validation errors will occur
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    Public static function validationError($message, $code){

        throw new \yii\web\HttpException(500, $message, $code);


    }

    /**
     * DESC       Through and exception if Access token will not be valid
     *
     * @throws \yii\web\HttpException
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    public static function requestTimeOut(){

        throw new \yii\web\HttpException(408, 'Access token not valid', 405);

    }

    /**
     * DESC             Through and exception if Access is forbidden
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    public static function forbidden(){

        throw new \yii\web\HttpException(403, 'Forbidden Access not Available', 405);

    }

    /**
     * DESC          Through and exception if payment if required for any particular request to call
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    public static function paymentRequired(){

        throw new \yii\web\HttpException(403, 'Payment Required to perform this action', 405);

    }

    /**
     * DESC    Through and exception if url is not found
     *
     * @throws \yii\web\HttpException
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    public static function notFound(){

        throw new \yii\web\HttpException(404, 'Not Found', 405);
    }


    /**
     * DESC   Through an exception if request is taking to long to process
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    public static function requestTooLong(){

        throw new \yii\web\HttpException(414, 'Request URL Is too long', 405);
    }

    /**
     * DESC             Through and exception if many requests are sending at the same time
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    public static function manyRequests(){

        throw new \yii\web\HttpException(414, 'Too Many Requests', 405);
    }

    /**
     * DESC             Through and exception if many requests are sending at the same time
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */

    public static function validationFailed($code, $message){

        throw new \yii\web\HttpException(401, $message, $code);
    }

    /**
     * DESC          Through and exception if payment if required for any particular request to call
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    public static function dataValidationFailed($status, $message, $code){

        throw new \yii\web\HttpException($status, $message, $code);
    }

    /**
     * Not Found HTTP exception
     * */
    public static function notFoundHttpException($message) {
        throw new NotFoundHttpException($message);
    }

}
