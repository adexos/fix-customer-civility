<?php

namespace Adexos\FixCustomerCivility\Model;

use Magento\Config\Model\Config\Source\Nooptreq as NooptreqSource;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Api\Data\StoreInterface;

class Options extends \Magento\Customer\Model\Options
{
    /**
     * Retrieve name prefix dropdown options
     *
     * @param null|string|bool|int|StoreInterface $store
     *
     * @return array|bool
     * @throws NoSuchEntityException
     */
    public function getNamePrefixOptions($store = null)
    {
        return $this->_prepareNamePrefixSuffixOptions(
            $this->addressHelper->getConfig('prefix_options', $store),
            $this->addressHelper->getConfig('prefix_show', $store) == NooptreqSource::VALUE_OPTIONAL
        );
    }

    /**
     * Retrieve name suffix dropdown options
     *
     * @param null|string|bool|int|StoreInterface $store
     *
     * @return array|bool
     * @throws NoSuchEntityException
     */
    public function getNameSuffixOptions($store = null)
    {
        return $this->_prepareNamePrefixSuffixOptions(
            $this->addressHelper->getConfig('suffix_options', $store),
            $this->addressHelper->getConfig('suffix_show', $store) == NooptreqSource::VALUE_OPTIONAL
        );
    }

    protected function _prepareNamePrefixSuffixOptions($options, $isOptional = false)
    {
        $options = trim($options);
        if (empty($options)) {
            return false;
        }
        $result = [];
        $options = array_filter(explode(';', $options));
        foreach ($options as $value) {
            $value = $this->escaper->escapeHtml(trim($value));
            $result[$value] = $value;
        }
        if ($isOptional && trim(current($options))) {
            $result = array_merge([' ' => ' '], $result);
        }

        return $result;
    }
}
