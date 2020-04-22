<?php

namespace Drop\DisableUnusefulLog\Magento\Framework\Logger;

/**
 * Monolog class
 */
class Monolog extends \Magento\Framework\Logger\Monolog
{
    /**
     * {@inheritDoc}
     */
    public function addRecord(
              $level,
              $message,
        array $context = []
    ) {
        //Print backtrace
        foreach ($this->getData()->getLogBacktrace() as $regexp) {
            if (preg_match($regexp, ($message ?? ""))) {
                $this->getLogger()->error(
                    $this->buildStack(
                        $message
                    )
                );
            }
        }

        //hide write this message on log file
        foreach ($this->getData()->getLogNotIn() as $regexp) {
            if (preg_match($regexp, ($message ?? ""))) {
                return;
            }
        }

        return parent::addRecord($level, $message, $context);
    }

    /**
     * @return \Drop\DisableUnusefulLog\Helper\Data
     */
    private function getData()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Drop\DisableUnusefulLog\Helper\Data::class);
    }

    /**
     * @return \Drop\DisableUnusefulLog\Logger\Logger
     */
    private function getLogger()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Drop\DisableUnusefulLog\Logger\Logger::class);
    }

    /**
     * @return string
     */
    private function buildStack($message)
    {
        $stacks = debug_backtrace();
        $output = '';
        $output .= PHP_EOL . "# START BACKTRACE FOR MESSAGE: " . $message . PHP_EOL;
        foreach ($stacks as $_stack) {
            if ( ! isset($_stack['file'])) {
                $_stack['file'] = '[PHP Kernel]';
            }

            if ( ! isset($_stack['line'])) {
                $_stack['line'] = '';
            }

            $output .= PHP_EOL . "{$_stack["file"]} {$_stack["line"]} {$_stack["function"]}";
        }

        $output .= PHP_EOL . "# END BACKTRACE FOR MESSAGE: " . $message . PHP_EOL;

        return $output;
    }
}
