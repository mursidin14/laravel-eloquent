<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testComment()
    {
        $comment = new Comment();
        $comment->email = 'anton@gmail.com';
        $comment->titel = 'good news';
        $comment->comment = 'good job bro';
        $comment->created_at = new \DateTime();
        $comment->updated_at = new \DateTime();
        $comment->save();

        self::assertNotNull($comment->id);
    }

    public function testAttributeComment()
    {
        $comment = new Comment();
        $comment->email = 'ari@gmail.com';
        $comment->created_at = new \DateTime();
        $comment->updated_at = new \DateTime();
        $comment->save();

        self::assertNotNull($comment->id);
    }
}
