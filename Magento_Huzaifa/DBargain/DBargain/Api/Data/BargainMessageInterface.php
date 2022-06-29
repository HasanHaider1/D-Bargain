<?php

namespace DBargain\DBargain\Api\Data;

interface BargainMessageInterface
{
    /**
     * String constants for property names
     */
    const BARGAIN_MESSAGE_ID = "bargain_message_id";
    const ATTEMPT            = "attempt";
    const CONTENT            = "content";
    const MESSAGE_TYPE       = "message_type";
    const IS_WARNING         = "is_warning";
    const IS_FINAL           = "is_final";

    /**
     * Getter for BargainMessageId.
     *
     * @return int|null
     */
    public function getBargainMessageId(): ?int;

    /**
     * Setter for BargainMessageId.
     *
     * @param  int|null  $bargainMessageId
     *
     * @return void
     */
    public function setBargainMessageId(?int $bargainMessageId): void;

    /**
     * Getter for Attempt.
     *
     * @return int|null
     */
    public function getAttempt(): ?int;

    /**
     * Setter for Attempt.
     *
     * @param  int|null  $attempt
     *
     * @return void
     */
    public function setAttempt(?int $attempt): void;

    /**
     * Getter for Content.
     *
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * Setter for Content.
     *
     * @param  string|null  $content
     *
     * @return void
     */
    public function setContent(?string $content): void;

    /**
     * Getter for MessageType.
     *
     * @return string|null
     */
    public function getMessageType(): ?string;

    /**
     * Setter for MessageType.
     *
     * @param  string|null  $messageType
     *
     * @return void
     */
    public function setMessageType(?string $messageType): void;

    /**
     * Getter for IsWarning.
     *
     * @return bool|null
     */
    public function getIsWarning(): ?bool;

    /**
     * Setter for IsWarning.
     *
     * @param  bool|null  $isWarning
     *
     * @return void
     */
    public function setIsWarning(?bool $isWarning): void;

    /**
     * Getter for IsFinal.
     *
     * @return bool|null
     */
    public function getIsFinal(): ?bool;

    /**
     * Setter for IsFinal.
     *
     * @param  bool|null  $isFinal
     *
     * @return void
     */
    public function setIsFinal(?bool $isFinal): void;
}
