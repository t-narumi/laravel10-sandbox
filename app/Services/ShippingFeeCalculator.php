<?php

namespace App\Services;

use InvalidArgumentException;

class ShippingFeeCalculator
{
    public const ZONE_MAINLAND = 'mainland';
    public const ZONE_REMOTE = 'remote';
    public const ZONE_OKINAWA = 'okinawa';

    /**
     * @param int $subtotalYen 商品合計金額（円）
     * @param string $zone 配送地域
     */
    public function calculate(int $subtotalYen, string $zone): int
    {
        if ($subtotalYen < 0) {
            throw new InvalidArgumentException('Subtotal must be 0 or greater.');
        }

        $feesByZone = [
            self::ZONE_MAINLAND => 800,
            self::ZONE_REMOTE => 1200,
            self::ZONE_OKINAWA => 1500,
        ];

        if (!array_key_exists($zone, $feesByZone)) {
            throw new InvalidArgumentException('Unknown shipping zone.');
        }

        if ($subtotalYen >= 10000) {
            return 0;
        }

        return $feesByZone[$zone];
    }
}
