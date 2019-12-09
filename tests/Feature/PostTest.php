<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePost()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->make();
        $reponse = $this->actingAs($user, 'api')->post('/api/post', [
            'title' => $post->title,
            'body' => $post->body,
        ]);

        $reponse->assertStatus(200);
        $this->assertDatabaseHas('posts', [
            'title' => $post->title
        ]);
    }

    public function testListPosts()
    {
        $posts = factory(Post::class, mt_rand(10, 50))->create();
        $response =  $this->get('/api/posts');
        $response->assertStatus(200);
        $response->assertJsonCount($posts->count(), 'data');
    }

}
