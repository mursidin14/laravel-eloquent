<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class UuidsTest extends TestCase
{
   
    public function testCreateVoucher()
    {
        $voucher = new Voucher();
        $voucher->name = 'sample voucher';
        $voucher->voucher_code = '12345678';
        $voucher->save();

        self::assertNotNull($voucher->id);
    }

    public function testCodeVoucherUUID()
    {
        $voucher = new Voucher();
        $voucher->name = 'voucher code';
        $voucher->save();

        self::assertNotNull($voucher->id);
        self::assertNotNull($voucher->voucher_code);
    }

    public function testSoftDelete()
    {
        $this->seed(VoucherSeeder::class);

        $voucher = Voucher::query()->where('name', 'sample voucher')->first();
        $voucher->delete();

        $voucher = Voucher::query()->where('name', 'sample voucher')->first();
        self::assertNull($voucher);

        $voucher = Voucher::query()->withTrashed()->where('name', 'sample voucher')->first();
        self::assertNotNull($voucher);
    }

    public function testScopeLocal()
    {
        $voucher = new Voucher();
        $voucher->name = 'sambal ji';
        $voucher->is_active = true;
        $total = $voucher->save();

        $total = Voucher::query()->active()->count();
        self::assertEquals(1, $total);

        $total = Voucher::query()->nonActive()->count();
        self::assertEquals(0, $total);
    }
}
