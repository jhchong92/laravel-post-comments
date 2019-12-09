<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testListComments()
    {
        $comments = factory(Comment::class, mt_rand(10, 50))->make();
        factory(Post::class)->create()->comments()->saveMany($comments);
        $response =  $this->get('/api/comments');
        $response->assertStatus(200);
        $response->assertJsonCount($comments->count(), 'data');
    }

    public function testPostComment()
    {
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->make();
        $response = $this->post("/api/posts/{$post->id}/comment", $comment->toArray());
        $response->assertStatus(200);

        $this->assertDatabaseHas('comments', [
            'title' => $comment->title,
            'body' => $comment->body
        ]);
    }


}
