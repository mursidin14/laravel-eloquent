<?php

namespace Tests\Feature;

use App\Models\Voucher;
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
}
