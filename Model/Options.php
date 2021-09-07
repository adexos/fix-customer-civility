<?php

declare(strict_types=1);

namespace Adexos\FixCustomerCivility\Model;

class Options extends \Magento\Customer\Model\Options
{
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
