<?php

namespace DBargain\DBargain\Model\Data;

use Magento\Framework\DataObject;

class BargainReportData extends DataObject
{
    /**
     * String constants for property names.
     */
    const BARGAIN_REPORT_ID = "bargain_report_id";
    const PRODUCT_ID        = "product_id";
    const PRODUCT_NAME      = "product_name";
    const NO_OF_BUYERS      = "no_of_buyers";
    const TIMES_PURCHASED   = "times_purchased";

    /**
     * Getter for BargainReportId.
     *
     * @return int|null
     */
    public function getBargainReportId(): ?int
    {
        return $this->getData(self::BARGAIN_REPORT_ID) === null ? null
            : (int) $this->getData(self::BARGAIN_REPORT_ID);
    }

    /**
     * Setter for BargainReportId.
     *
     * @param  int|null  $bargainReportId
     *
     * @return void
     */
    public function setBargainReportId(?int $bargainReportId): void
    {
        $this->setData(self::BARGAIN_REPORT_ID, $bargainReportId);
    }

    /**
     * Getter for ProductId.
     *
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->getData(self::PRODUCT_ID);
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
        return $this->getData(self::PRODUCT_NAME);
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
     * Getter for NoOfBuyers.
     *
     * @return int|null
     */
    public function getNoOfBuyers(): ?int
    {
        return $this->getData(self::NO_OF_BUYERS) === null ? null
            : (int) $this->getData(self::NO_OF_BUYERS);
    }

    /**
     * Setter for NoOfBuyers.
     *
     * @param  int|null  $noOfBuyers
     *
     * @return void
     */
    public function setNoOfBuyers(?int $noOfBuyers): void
    {
        $this->setData(self::NO_OF_BUYERS, $noOfBuyers);
    }

    /**
     * Getter for TimesPurchased.
     *
     * @return int|null
     */
    public function getTimesPurchased(): ?int
    {
        return $this->getData(self::TIMES_PURCHASED) === null ? null
            : (int) $this->getData(self::TIMES_PURCHASED);
    }

    /**
     * Setter for TimesPurchased.
     *
     * @param  int|null  $timesPurchased
     *
     * @return void
     */
    public function setTimesPurchased(?int $timesPurchased): void
    {
        $this->setData(self::TIMES_PURCHASED, $timesPurchased);
    }
}
