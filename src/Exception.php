<?php

namespace FlexBase;

/**
 * FlexBase Exception
 */
class Exception extends \Exception
{
    /**
     * data
     * @var array
     */
    protected $data;

    /**
     * Get Data
     * @return array data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Construct
     */
    public function __construct($message = '', $code = 0, $data = NULL, $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }
}
