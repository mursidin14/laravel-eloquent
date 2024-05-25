<?php

namespace Database\Seeders;

use App\Models\VirtualAccount;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VirtualAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallet = Wallet::query()->where('customer_id', 'UDIN')->firstOrFail();

        $virtualaccount = new VirtualAccount();
        $virtualaccount->bank = 'BRI';
        $virtualaccount->va_number = '543216789';
        $virtualaccount->wallet_id = $wallet->id;
        $virtualaccount->save();
    }
}
