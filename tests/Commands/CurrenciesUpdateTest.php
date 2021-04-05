<?php
namespace Tests\Commands;

use Tests\TestCase;

class CurrenciesUpdateTest extends TestCase
{

    public function testCurrenciesUpdateWithoutParameter()
    {
        $this->artisan('currencies:update');
    }

    public function testCurrenciesUpdateWithParameter()
    {
        $this->artisan('currencies:update', ['currencyCode' => 'AUD']);
    }

}
