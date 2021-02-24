<?php

class ProductPricingFactory
{
    public static function create($data)
    {
        foreach ($data as $productDataPricing) {
            $productPricing = new ProductPricing();
            $productPricing->setCode($productDataPricing['code']);
            $productPricing->setBulkPrice($productDataPricing['bulkPrice']);
            $productPricing->setBulkPriceQuantity($productDataPricing['bulkPriceQuantity']);
            $productPricing->setUnitPrice($productDataPricing['unitPrice']);

            $dataPricing[$productPricing->getCode()] = $productPricing;
        }

        return $dataPricing;
    }
}
