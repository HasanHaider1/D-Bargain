<?php

namespace DBargain\DBargain\Model\Config\Source;

class ChatPopup implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'popup', 'label' => __('Open popup window')],
            ['value' => 'button', 'label' => __('Show via button')]
        ];
    }
}
