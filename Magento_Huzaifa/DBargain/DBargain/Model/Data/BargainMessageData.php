<?php

namespace DBargain\DBargain\Model\Data;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use Magento\Framework\DataObject;

class BargainMessageData extends DataObject implements BargainMessageInterface
{
    /**
     * Getter for BargainMessageId.
     *
     * @return int|null
     */
    public function getBargainMessageId(): ?int
    {
        return $this->getData(self::BARGAIN_MESSAGE_ID) === null ? null
            : (int) $this->getData(self::BARGAIN_MESSAGE_ID);
    }

    /**
     * Setter for BargainMessageId.
     *
     * @param  int|null  $bargainMessageId
     *
     * @return void
     */
    public function setBargainMessageId(?int $bargainMessageId): void
    {
        $this->setData(self::BARGAIN_MESSAGE_ID, $bargainMessageId);
    }

    /**
     * Getter for Attempt.
     *
     * @return int|null
     */
    public function getAttempt(): ?int
    {
        return $this->getData(self::ATTEMPT) === null ? null
            : (int) $this->getData(self::ATTEMPT);
    }

    /**
     * Setter for Attempt.
     *
     * @param  int|null  $attempt
     *
     * @return void
     */
    public function setAttempt(?int $attempt): void
    {
        $this->setData(self::ATTEMPT, $attempt);
    }

    /**
     * Getter for Content.
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Setter for Content.
     *
     * @param  string|null  $content
     *
     * @return void
     */
    public function setContent(?string $content): void
    {
        $this->setData(self::CONTENT, $content);
    }

    /**
     * Getter for MessageType.
     *
     * @return string|null
     */
    public function getMessageType(): ?string
    {
        return $this->getData(self::MESSAGE_TYPE);
    }

    /**
     * Setter for MessageType.
     *
     * @param  string|null  $messageType
     *
     * @return void
     */
    public function setMessageType(?string $messageType): void
    {
        $this->setData(self::MESSAGE_TYPE, $messageType);
    }

    /**
     * Getter for IsWarning.
     *
     * @return bool|null
     */
    public function getIsWarning(): ?bool
    {
        return $this->getData(self::IS_WARNING) === null ? null
            : (bool) $this->getData(self::IS_WARNING);
    }

    /**
     * Setter for IsWarning.
     *
     * @param  bool|null  $isWarning
     *
     * @return void
     */
    public function setIsWarning(?bool $isWarning): void
    {
        $this->setData(self::IS_WARNING, $isWarning);
    }

    /**
     * Getter for IsFinal.
     *
     * @return bool|null
     */
    public function getIsFinal(): ?bool
    {
        return $this->getData(self::IS_FINAL) === null ? null
            : (bool) $this->getData(self::IS_FINAL);
    }

    /**
     * Setter for IsFinal.
     *
     * @param  bool|null  $isFinal
     *
     * @return void
     */
    public function setIsFinal(?bool $isFinal): void
    {
        $this->setData(self::IS_FINAL, $isFinal);
    }
}
