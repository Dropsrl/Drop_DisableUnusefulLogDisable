<?php

namespace Drop\DisableUnusefulLog\Magento\Framework\Logger\Handler;

use Drop\DisableUnusefulLog\Model\Data;

/**
 * @deprecated
 */
class System extends \Magento\Framework\Logger\Handler\System
{
    /**
     * {@inheritDoc}
     */
    public function write(array $record)
    {
        if (isset($record['context']['exception'])) {
            $this->exceptionHandler->handle($record);

            return;
        }

        foreach ($this->getData()->getLogNotIn() as $regexp) {
            if (preg_match($regexp, ($record['message'] ?? ""))) {
                return;
            }
        }

        $record['formatted'] = $this->getFormatter()->format($record);

        parent::write($record);
    }

    /**
     * @return \Drop\DisableUnusefulLog\Helper\Data
     */
    private function getData()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Drop\DisableUnusefulLog\Helper\Data::class);
    }
}
