<?php

namespace Drop\DisableUnusefulLog\Helper;

/**
 * Regex class
 */
class Regex extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Drop\DisableUnusefulLog\Logger\Logger
     */
    protected $_logger;

    /**
     * @param \Drop\DisableUnusefulLog\Logger\Logger $logger
     */
    public function __construct(
        \Drop\DisableUnusefulLog\Logger\Logger $logger
    ) {
        $this->_logger = $logger;
    }

    /**
     * @param  array   $r
     * @return array
     */
    public function getValidRegex(array $r)
    {
        $validRegex = [];

        if ( ! is_array($r)) {
            return $validRegex;
        }

        foreach ($r as $p) {
            try {
                //Remove special char, return carrage, new line, ecc
                $p = trim($p);

                preg_match($p, '');

                if (preg_last_error() !== PREG_NO_ERROR) {
                    throw new \Exception;
                }
            } catch (\Exception $e) {
                $this->_logger->critical(json_encode([
                    'error'  => $e->getMessage(),
                    'regexp' => $p,
                ]));
                continue;
            }

            $validRegex[] = $p;
        }

        return $validRegex;
    }
}
