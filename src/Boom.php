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
    );

    public static function __callStatic($name, $arguments)
    {
        if (!isset(self::$errors[$name])) {
            throw new Exception("Call to undefined method ".__CLASS__."::{$name}()", 500);
        }
        $exception = '\\FlexBase\\Boom'.ucfirst($name).'Exception';
        return new $exception(isset($arguments[0]) ? $arguments[0] : self::$errors[$name][1], self::$errors[$name][0]);
    }
}

class BoomException extends Exception
{
}

class BoomBadRequestException extends BoomException
{
}

class BoomUnauthorizedException extends BoomException
{
}

class BoomForbiddenException extends BoomException
{
}

class BoomNotFoundException extends BoomException
{
}

class BoomMethodNotAllowedException extends BoomException
{
}

class BoomNotAcceptableException extends BoomException
{
}

class BoomProxyAuthRequiredException extends BoomException
{
}

class BoomClientTimeoutException extends BoomException
{
}

class BoomConflictException extends BoomException
{
}

class BoomResourceGoneException extends BoomException
{
}
