<?php

namespace DBargain\DBargain\Block\Form\BargainMessage;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            'Delete',
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this bargainmessage?'),
                $this->getUrl(
                    '*/*/delete',
                    [BargainMessageInterface::BARGAIN_MESSAGE_ID => $this->getBargainMessageId()]
                )
            ),
            [],
            20
        );
    }
}
