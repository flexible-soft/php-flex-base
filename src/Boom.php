<?php

namespace FlexBase;

/**
 * Boom Component
 */
class Boom extends Component
{
    public static $errors = array(
        // 4xx Client Errors
        'badRequest'  => array(400, 'Bad Request'),
        'unauthorized'  => array(401, 'Unauthorized'),
        'forbidden'  => array(403, 'Forbidden'),
        'notFound'  => array(404, 'Not Found'),
        'methodNotAllowed'  => array(405, 'Method Not Allowed'),
        'notAcceptable'  => array(406, 'Not Acceptable'),
        'proxyAuthRequired'  => array(407, 'Proxy Authentication Required'),
        'clientTimeout'  => array(408, 'Request Timeout'),
        'conflict'  => array(409, 'Conflict'),
        'resourceGone'  => array(410, 'Gone'),
        'internal'  => array(500, 'Internal Server Error'),
    );

    public static function __callStatic($name, $arguments)
    {
        if (!isset(self::$errors[$name])) {
            throw new Exception("Call to undefined method ".__CLASS__."::{$name}()", 500);
        }
        $exception = '\\FlexBase\\Boom\\'.ucfirst($name).'Exception';

        // #1. empty params
        $message = self::$errors[$name][1];
        $data = null;
        $code = self::$errors[$name][0];
        // #2. one param
        if (count($arguments) === 1) {
            // #2.1. array
            if (is_array($arguments[0])) {
                $data = $arguments[0];
            } elseif (is_string($arguments[0])) {
            // #2.2. string
                $message = $arguments[0];
            }
        }
        // #3. two params
        elseif (count($arguments) > 0) {
            $message = $arguments[0];
            $data = $arguments[1];
        }

        return new $exception($message, $code, $data);
    }
}
