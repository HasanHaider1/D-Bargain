<?php

namespace DBargain\DBargain\Block;

use DBargain\DBargain\Helper\Data;

class Chat extends \Magento\Catalog\Block\Product\View\AbstractView
{
    protected Data $helper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $arrayUtils, $data);
        $this->helper = $helper;
    }

    public function afterExit()
    {
        return (bool) $this->helper->getConfigValue('chat_interface/after_exit');
    }

    public function afterTimeout()
    {
        return (bool) $this->helper->getConfigValue('chat_interface/after_timeout');
    }

    public function chatMode()
    {
        return $this->helper->getConfigValue('chat_interface/chat_mode');
    }

    public function timeoutSeconds()
    {
        return ($this->helper->getConfigValue('chat_interface/timeout_seconds') ?? 1) * 1000;
    }
}
