<?php

class ProductPricing
{
    private $code;
    private $unitPrice;
    private $bulkPrice;
    private $bulkPriceQuantity;

    public function setCode(string $code): ProductPricing
    {
        $this->code = $code;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setUnitPrice(float $unitPrice): ProductPricing
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setBulkPrice(?float $bulkPrice): ProductPricing
    {
        $this->bulkPrice = $bulkPrice;

        return $this;
    }

    public function getBulkPrice(): ?float
    {
        return $this->bulkPrice;
    }

    public function setBulkPriceQuantity(?float $bulkPriceQuantity): ProductPricing
    {
        $this->bulkPriceQuantity = $bulkPriceQuantity;

        return $this;
    }

    public function getBulkPriceQuantity(): ?float
    {
        return $this->bulkPriceQuantity;
    }

}
