<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShippingPageTest extends TestCase
{
    public function test_shipping_page_shows_form(): void
    {
        $response = $this->get('/shipping');

        $response->assertOk();
        $response->assertSee('送料計算');
    }

    public function test_shipping_page_calculates_fee(): void
    {
        $response = $this->get('/shipping?subtotal=9999&zone=mainland');

        $response->assertOk();
        $response->assertSee('送料:');
        $response->assertSee('800');
    }
}
