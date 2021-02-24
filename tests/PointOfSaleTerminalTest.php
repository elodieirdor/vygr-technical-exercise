<?php
declare (strict_types = 1);

use PHPUnit\Framework\TestCase;

final class PointOfSaleTerminalTest extends TestCase
{
    // based on result that can be expected by fetching a database
    private function fetchDataPricing(): array
    {
        return [
            [
                "code" => "A",
                "unitPrice" => 1.25,
                "bulkPrice" => 3,
                "bulkPriceQuantity" => 3,
            ],
            [
                "code" => "B",
                "unitPrice" => 4.25,
                "bulkPrice" => null,
                "bulkPriceQuantity" => null,
            ],
            [
                "code" => "C",
                "unitPrice" => 1,
                "bulkPrice" => 5,
                "bulkPriceQuantity" => 6,
            ],
            [
                "code" => "D",
                "unitPrice" => 0.75,
                "bulkPrice" => null,
                "bulkPriceQuantity" => null,
            ],
        ];
    }

    private function getPricing()
    {
        return ProductPricingFactory::create($this->fetchDataPricing());
    }

    public function testAlertUndefinedProduct(): void
    {
        $this->expectException(\Exception::class);

        $terminal = new PointOfSaleTerminal();
        $terminal->scanProduct("E");
        $terminal->calculateTotal();
    }

    // Scan these items in this order: ABCDABA Verify that the total price is $13.25
    public function testScanItems1(): void
    {
        $terminal = new PointOfSaleTerminal();
        $terminal->setPricing($this->getPricing());
        $terminal->scanProduct("A");
        $terminal->scanProduct("B");
        $terminal->scanProduct("C");
        $terminal->scanProduct("D");
        $terminal->scanProduct("A");
        $terminal->scanProduct("B");
        $terminal->scanProduct("A");
        $total = $terminal->calculateTotal();

        $this->assertEquals(13.25, $total);
    }

    //Scan these items in this order: CCCCCCC Verify that the total price is $6.00
    public function testScanItems2(): void
    {
        $terminal = new PointOfSaleTerminal();
        $terminal->setPricing($this->getPricing());
        $terminal->scanProduct("C");
        $terminal->scanProduct("C");
        $terminal->scanProduct("C");
        $terminal->scanProduct("C");
        $terminal->scanProduct("C");
        $terminal->scanProduct("C");
        $terminal->scanProduct("C");
        $total = $terminal->calculateTotal();

        $this->assertEquals(6.00, $total);
    }

    // Scan these items in this order: ABCD Verify that the total price is $7.25
    public function testScanItems3(): void
    {
        $terminal = new PointOfSaleTerminal();
        $terminal->setPricing($this->getPricing());
        $terminal->scanProduct("A");
        $terminal->scanProduct("B");
        $terminal->scanProduct("C");
        $terminal->scanProduct("D");
        $total = $terminal->calculateTotal();

        $this->assertEquals(7.25, $total);
    }
}
