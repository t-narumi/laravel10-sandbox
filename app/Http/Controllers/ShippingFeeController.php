<?php

namespace App\Http\Controllers;

use App\Services\ShippingFeeCalculator;
use Illuminate\Http\Request;

class ShippingFeeController extends Controller
{
    public function __invoke(Request $request, ShippingFeeCalculator $calculator)
    {
        $zones = [
            ShippingFeeCalculator::ZONE_MAINLAND => '本州・四国・九州',
            ShippingFeeCalculator::ZONE_REMOTE => '離島',
            ShippingFeeCalculator::ZONE_OKINAWA => '沖縄',
        ];

        $shippingFee = null;

        if ($request->has(['subtotal', 'zone'])) {
            $validated = $request->validate([
                'subtotal' => ['required', 'integer', 'min:0'],
                'zone' => ['required', 'in:' . implode(',', array_keys($zones))],
            ]);

            $shippingFee = $calculator->calculate((int) $validated['subtotal'], (string) $validated['zone']);
        }

        return view('shipping', [
            'zones' => $zones,
            'subtotal' => $request->input('subtotal', ''),
            'zone' => $request->input('zone', ShippingFeeCalculator::ZONE_MAINLAND),
            'shippingFee' => $shippingFee,
        ]);
    }
}
