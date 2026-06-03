<?php

namespace Tests\Unit;

use App\Services\ShippingFeeCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ShippingFeeCalculatorTest extends TestCase
{
    #[DataProvider('feeCases')]
    public function test_calculate_fee(int $subtotal, string $zone, int $expectedFee): void
    {
        $calculator = new ShippingFeeCalculator();

        $this->assertSame($expectedFee, $calculator->calculate($subtotal, $zone));
    }

    public static function feeCases(): array
    {
        return [
            'mainland under 10000' => [9999, ShippingFeeCalculator::ZONE_MAINLAND, 800],
            'remote under 10000' => [1, ShippingFeeCalculator::ZONE_REMOTE, 1200],
            'okinawa under 10000' => [0, ShippingFeeCalculator::ZONE_OKINAWA, 1500],
            'free shipping at 10000' => [10000, ShippingFeeCalculator::ZONE_MAINLAND, 0],
            'free shipping above 10000' => [50000, ShippingFeeCalculator::ZONE_OKINAWA, 0],
        ];
    }

    public function test_throws_for_negative_subtotal(): void
    {
        $calculator = new ShippingFeeCalculator();

        $this->expectException(InvalidArgumentException::class);
        $calculator->calculate(-1, ShippingFeeCalculator::ZONE_MAINLAND);
    }

    public function test_throws_for_unknown_zone(): void
    {
        $calculator = new ShippingFeeCalculator();

        $this->expectException(InvalidArgumentException::class);
        $calculator->calculate(0, 'unknown');
    }
}
