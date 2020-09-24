<?php

namespace App\Base;

use Exception;

/**
 * @author AdamTyn
 * @description 自定义异常基类
 */
abstract class BaseException extends Exception
{
    /**
     * 异常信息
     * @var string
     */
    protected $_message;

    /**
     * 异常代码
     * @var string
     */
    protected $_code;

    /**
     * ServerException constructor.
     * @param string $code
     * @param string $message
     */
    public function __construct(string $code, string $message = '')
    {
        $this->_message = $message ?? codes($code);

        $this->_code = $code;

        parent::__construct($this->_message);
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->_code;
    }

    /**
     * @author AdamTn
     * @description 渲染自定义的异常
     */
    public function render()
    {
        output($this->code());
    }
}
