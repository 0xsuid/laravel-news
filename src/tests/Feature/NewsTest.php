<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\News;
use App\Models\User;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_news_create()
    {   
        $user = User::factory()->create();
        $news = News::factory()->make(['user_id' => $user->id]);

        $data = [
            'title' => $news->title,
            'content' => $news->content
        ];

        $this
            ->actingAs($user)
            ->postJson('/create',$data)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_news_read()
    {   
        $news = News::factory()->create();
        // Using belongsTo Relationship
        $user = $news->user;

        $this
            ->actingAs($user)
            ->getJson('/read/'.$news->id)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_news_update()
    {
        $news = News::factory()->create();
        $user = $news->user;
        $news_new = News::factory()->make(['user_id' => $user->id]);

        $data = [
            'title' => $news_new->title,
            'content' => $news_new->content
        ];

        $this
            ->actingAs($user)
            ->postJson('/update/'.$news->id,$data)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_news_delete()
    {
        $news = News::factory()->create();
        $user = $news->user;

        $this
            ->actingAs($user)
            ->getJson('/delete/'.$news->id)
            ->assertJson([
                'success' => true,
            ]);
    }
}
