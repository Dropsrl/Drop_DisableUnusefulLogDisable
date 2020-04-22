<?php

namespace Drop\DisableUnusefulLog\Logger;

/**
 * Handler class
 */
class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * @var int
     */
    protected $loggerType = \Monolog\Logger::INFO;

    /**
     * @var string
     */
    protected $fileName = '/var/log/drop_disable_unuseful.log';
}
