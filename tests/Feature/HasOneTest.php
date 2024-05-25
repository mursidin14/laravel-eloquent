<?php

namespace Tests\Feature;

use App\Models\Customer;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\VirtualAccountSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HasOneTest extends TestCase
{
    public function testHasOne()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class]);
        
        $customer = Customer::query()->find('UDIN');
        self::assertNotNull($customer);

        $wallet = $customer->wallet;
        self::assertNotNull($wallet);

        self::assertEquals(200000, $wallet->amount);
    }

    public function testHasOneTrought()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class, VirtualAccountSeeder::class]);

        $customer = Customer::query()->find('UDIN');
        self::assertNotNull($customer);

        $virtualaccount = $customer->virtualAccount;
        self::assertNotNull($virtualaccount);
        self::assertEquals('BRI', $virtualaccount->bank);
    }
}
