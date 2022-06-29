<?php

namespace DBargain\DBargain\Model\Data;

use DBargain\DBargain\Api\Data\BargainInterface;
use Magento\Framework\DataObject;

class BargainData extends DataObject implements BargainInterface
{
    /**
     * Getter for BargainId.
     *
     * @return int|null
     */
    public function getBargainId(): ?int
    {
        return $this->getData(self::BARGAIN_ID) === null ? null
            : (int) $this->getData(self::BARGAIN_ID);
    }

    /**
     * Setter for BargainId.
     *
     * @param  int|null  $bargainId
     *
     * @return void
     */
    public function setBargainId(?int $bargainId): void
    {
        $this->setData(self::BARGAIN_ID, $bargainId);
    }

    /**
     * Getter for UserId.
     *
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->getData(self::USER_ID) === null ? null
            : (int) $this->getData(self::USER_ID);
    }

    /**
     * Setter for UserId.
     *
     * @param  int|null  $userId
     *
     * @return void
     */
    public function setUserId(?int $userId): void
    {
        $this->setData(self::USER_ID, $userId);
    }

    /**
     * Getter for SessionId.
     *
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->getData(self::SESSION_ID) === null ? null
            : (string) $this->getData(self::SESSION_ID);
    }

    /**
     * Setter for SessionId.
     *
     * @param  string|null  $sessionId
     *
     * @return void
     */
    public function setSessionId(?string $sessionId): void
    {
        $this->setData(self::SESSION_ID, $sessionId);
    }

    /**
     * Getter for ProductId.
     *
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->getData(self::PRODUCT_ID) === null ? null
            : (string) $this->getData(self::PRODUCT_ID);
    }

    /**
     * Setter for ProductId.
     *
     * @param  string|null  $productId
     *
     * @return void
     */
    public function setProductId(?string $productId): void
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Getter for ProductName.
     *
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->getData(self::PRODUCT_NAME) === null ? null
            : (string) $this->getData(self::PRODUCT_NAME);
    }

    /**
     * Setter for ProductName.
     *
     * @param  string|null  $productName
     *
     * @return void
     */
    public function setProductName(?string $productName): void
    {
        $this->setData(self::PRODUCT_NAME, $productName);
    }

    /**
     * Getter for CustomerName.
     *
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->getData(self::CUSTOMER_NAME) === null ? null
            : (string) $this->getData(self::CUSTOMER_NAME);
    }

    /**
     * Setter for ProductId.
     *
     * @param  string|null  $customerName
     *
     * @return void
     */
    public function setCustomerName(?string $customerName): void
    {
        $this->setData(self::CUSTOMER_NAME, $customerName);
    }

    /**
     * Getter for CustomerId.
     *
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->getData(self::CUSTOMER_ID) === null ? null
            : (int) $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Setter for CustomerId.
     *
     * @param  int|null  $customerId
     *
     * @return void
     */
    public function setCustomerId(?int $customerId): void
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Getter for OrderId.
     *
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->getData(self::ORDER_ID) === null ? null
            : (int) $this->getData(self::ORDER_ID);
    }

    /**
     * Setter for OrderId.
     *
     * @param  int|null  $orderId
     *
     * @return void
     */
    public function setOrderId(?int $orderId): void
    {
        $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Getter for BargainedPrice.
     *
     * @return float|null
     */
    public function getBargainedPrice(): ?float
    {
        return $this->getData(self::BARGAINED_PRICE) === null ? null
            : (float) $this->getData(self::BARGAINED_PRICE);
    }

    /**
     * Setter for BargainedPrice.
     *
     * @param  float|null  $bargainedPrice
     *
     * @return void
     */
    public function setBargainedPrice(?float $bargainedPrice): void
    {
        $this->setData(self::BARGAINED_PRICE, $bargainedPrice);
    }

    /**
     * Getter for CurrentPrice.
     *
     * @return float|null
     */
    public function getCurrentPrice(): ?float
    {
        return $this->getData(self::CURRENT_PRICE) === null ? null
            : (float) $this->getData(self::CURRENT_PRICE);
    }

    /**
     * Setter for CurrentPrice.
     *
     * @param  float|null  $currentPrice
     *
     * @return void
     */
    public function setCurrentPrice(?float $currentPrice): void
    {
        $this->setData(self::CURRENT_PRICE, $currentPrice);
    }

    /**
     * Getter for adminResponse.
     *
     * @return string|null
     */
    public function getAdminResponse(): ?string
    {
        return $this->getData(self::ADMIN_RESPONSE) === null ? null
            : (string) $this->getData(self::ADMIN_RESPONSE);
    }

    /**
     * Setter for adminResponse.
     *
     * @param  string|null  $adminResponse
     *
     * @return void
     */
    public function setAdminResponse(?string $adminResponse): void
    {
        $this->setData(self::ADMIN_RESPONSE, $adminResponse);
    }

    /**
     * Getter for FinalizedPrice.
     *
     * @return float|null
     */
    public function getFinalizedPrice(): ?float
    {
        return $this->getData(self::FINALIZED_PRICE) === null ? null
            : (float) $this->getData(self::FINALIZED_PRICE);
    }

    /**
     * Setter for FinalizedPrice.
     *
     * @param  float|null  $finalizedPrice
     *
     * @return void
     */
    public function setFinalizedPrice(?float $finalizedPrice): void
    {
        $this->setData(self::FINALIZED_PRICE, $finalizedPrice);
    }

    /**
     * Getter for RespondedAt.
     *
     * @return string|null
     */
    public function getRespondedAt(): ?string
    {
        return $this->getData(self::RESPONDED_AT);
    }

    /**
     * Setter for RespondedAt.
     *
     * @param  string|null  $respondedAt
     *
     * @return void
     */
    public function setRespondedAt(?string $respondedAt): void
    {
        $this->setData(self::RESPONDED_AT, $respondedAt);
    }
}
