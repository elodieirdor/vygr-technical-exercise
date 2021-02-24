<?php

class PointOfSaleTerminal
{

    private $items = [];
    private $pricing = [];

    public function setPricing(array $pricing): PointOfSaleTerminal
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function scanProduct(string $articleCode): void
    {
        if (false === isset($this->pricing[$articleCode])) {
            throw new \Exception('Undefined price product');
        }

        if (false === array_key_exists($articleCode, $this->items)) {
            $this->items[$articleCode] = 0;
        }

        $this->items[$articleCode]++;
    }

    public function calculateTotal(): float
    {
        $total = 0;
        foreach ($this->items as $articleCode => $itemQuantity) {
            $quantity = $itemQuantity;
            /** @var ProductPricing  */
            $pricing = $this->pricing[$articleCode];

            if ($pricing->getBulkPriceQuantity() && $quantity >= $pricing->getBulkPriceQuantity()) {
                do {
                    $total += $pricing->getBulkPrice();
                    $quantity -= $pricing->getBulkPriceQuantity();
                } while ($quantity >= $pricing->getBulkPriceQuantity());
            }

            $total += ($quantity * $pricing->getUnitPrice());
        }

        return $total;
    }
}
