<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->commentCreateProducts();
        $this->commentCreateVoucher();
    }

    public function commentCreateProducts(): void
    {
        $product = Product::query()->find('1');

        $comment = new Comment();
        $comment->email = 'mursidin@gmail.com';
        $comment->titel = 'Testing';
        $comment->commentable_id = $product->id;
        $comment->commentable_type = Product::class;
        $comment->save();
    }

    public function commentCreateVoucher(): void
    {
        $voucher = Voucher::query()->first();

        $comment = new Comment();
        $comment->email = 'mursidin@gmail.com';
        $comment->titel = 'Testing';
        $comment->commentable_id = $voucher->id;
        $comment->commentable_type = Voucher::class;
        $comment->save();
    }
}
