<?php

namespace Drop\DisableUnusefulLog\Helper;

/**
 * Data class
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Drop\DisableUnusefulLog\Helper\Regex
     */
    protected $_regex;

    /**
     * @var string
     */
    const CONFIGURATION_LOG_NOT_IN = 'drop_disable_unuseful_log/configuration/log_not_in';

    /**
     * @var string
     */
    const CONFIGURATION_LOG_BACKTRACE = 'drop_disable_unuseful_log/configuration/log_backtrace';

    /**
     * Construct
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\Helper\Context              $context
     * @param \Magento\Authorization\Model\RoleFactory           $roleCollectionFactory
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Helper\Context              $context,
        \Drop\DisableUnusefulLog\Helper\Regex              $regex
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_regex      = $regex;
        parent::__construct($context);
    }

    /**
     * @param  string   $configPath
     * @return string
     */
    private function getConfig($configPath)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return array
     */
    public function getLogNotIn()
    {
        $o = $this->getConfig(self::CONFIGURATION_LOG_NOT_IN);

        if (empty($o)) {
            return [];
        }

        return $this->_regex->getValidRegex(
            explode(PHP_EOL, $o)
        );
    }

    /**
     * @return array
     */
    public function getLogBacktrace()
    {
        $o = $this->getConfig(self::CONFIGURATION_LOG_BACKTRACE);

        if (empty($o)) {
            return [];
        }

        return $this->_regex->getValidRegex(
            explode(PHP_EOL, $o)
        );
    }

}
