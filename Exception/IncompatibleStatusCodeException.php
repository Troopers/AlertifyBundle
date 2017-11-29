<?php

namespace Troopers\AlertifyBundle\Exception;

/**
 * Class IncompatibleStatusCodeException.
 */
class IncompatibleStatusCodeException extends \Exception
{
    /**
     * IncompatibleStatusCodeException constructor.
     *
     * @param string $message
     * @param int    $code
     * @param null   $previous
     */
    public function __construct($message = "Status code 204 can't have content, please choose another one.", $code = 544, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
