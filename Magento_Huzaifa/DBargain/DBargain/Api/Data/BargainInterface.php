<?php

namespace DBargain\DBargain\Api\Data;

interface BargainInterface
{
    /**
     * String constants for property names
     */
    const BARGAIN_ID      = "bargain_id";
    const PRODUCT_ID      = "product_id";
    const PRODUCT_NAME    = "product_name";
    const USER_ID         = "user_id";
    const SESSION_ID      = "session_id";
    const CUSTOMER_ID     = "customer_id";
    const CUSTOMER_NAME   = "customer_name";
    const ORDER_ID        = "order_id";
    const BARGAINED_PRICE = "bargained_price";
    const CURRENT_PRICE   = "current_price";
    const ADMIN_RESPONSE  = "admin_response";
    const FINALIZED_PRICE = "finalized_price";
    const RESPONDED_AT    = "responded_at";

    /**
     * Getter for BargainId.
     *
     * @return int|null
     */
    public function getBargainId(): ?int;

    /**
     * Setter for BargainId.
     *
     * @param  int|null  $bargainId
     *
     * @return void
     */
    public function setBargainId(?int $bargainId): void;

    /**
     * Getter for UserId.
     *
     * @return int|null
     */
    public function getUserId(): ?int;

    /**
     * Setter for UserId.
     *
     * @param  int|null  $userId
     *
     * @return void
     */
    public function setUserId(?int $userId): void;

    /**
     * Getter for SessionId.
     *
     * @return string|null
     */
    public function getSessionId(): ?string;

    /**
     * Setter for SessionId.
     *
     * @param  string|null  $sessionId
     *
     * @return void
     */
    public function setSessionId(?string $sessionId): void;

    /**
     * Getter for ProductId.
     *
     * @return string|null
     */
    public function getProductId(): ?string;

    /**
     * Setter for ProductId.
     *
     * @param  string|null  $productId
     *
     * @return void
     */
    public function setProductId(?string $productId): void;

    /**
     * Getter for ProductName.
     *
     * @return string|null
     */
    public function getProductName(): ?string;

    /**
     * Setter for ProductName.
     *
     * @param  string|null  $productName
     *
     * @return void
     */
    public function setProductName(?string $productName): void;

    /**
     * Getter for CustomerId.
     *
     * @return int|null
     */
    public function getCustomerId(): ?int;

    /**
     * Setter for CustomerId.
     *
     * @param  int|null  $customerId
     *
     * @return void
     */
    public function setCustomerId(?int $customerId): void;

    /**
     * Getter for OrderId.
     *
     * @return int|null
     */
    public function getOrderId(): ?int;

    /**
     * Setter for OrderId.
     *
     * @param  int|null  $orderId
     *
     * @return void
     */
    public function setOrderId(?int $orderId): void;

    /**
     * Getter for BargainedPrice.
     *
     * @return float|null
     */
    public function getBargainedPrice(): ?float;

    /**
     * Setter for BargainedPrice.
     *
     * @param  float|null  $bargainedPrice
     *
     * @return void
     */
    public function setBargainedPrice(?float $bargainedPrice): void;

    /**
     * Getter for CurrentPrice.
     *
     * @return float|null
     */
    public function getCurrentPrice(): ?float;

    /**
     * Setter for CurrentPrice.
     *
     * @param  float|null  $currentPrice
     *
     * @return void
     */
    public function setCurrentPrice(?float $currentPrice): void;

    /**
     * Getter for AdminResponse.
     *
     * @return string|null
     */
    public function getAdminResponse(): ?string;

    /**
     * Setter for AdminResponse.
     *
     * @param  string|null  $offeredPrice
     *
     * @return void
     */
    public function setAdminResponse(?string $offeredPrice): void;

    /**
     * Getter for CustomerName.
     *
     * @return string|null
     */
    public function getCustomerName(): ?string;

    /**
     * Setter for CustomerName.
     *
     * @param  string|null  $customerName
     *
     * @return void
     */
    public function setCustomerName(?string $customerName): void;

    /**
     * Getter for FinalizedPrice.
     *
     * @return float|null
     */
    public function getFinalizedPrice(): ?float;

    /**
     * Setter for FinalizedPrice.
     *
     * @param  float|null  $finalizedPrice
     *
     * @return void
     */
    public function setFinalizedPrice(?float $finalizedPrice): void;

    /**
     * Getter for RespondedAt.
     *
     * @return string|null
     */
    public function getRespondedAt(): ?string;

    /**
     * Setter for RespondedAt.
     *
     * @param  string|null  $respondedAt
     *
     * @return void
     */
    public function setRespondedAt(?string $respondedAt): void;
}
