<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as Faker;
use Clane\models\User;
use Clane\models\Article;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, DatabaseTransactions;

    protected $faker;
    protected $articleData;
    protected $title;
    protected $user;
    protected $article;
    protected $articleArray;

    /**
     * Set up the test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->title = $this->faker->word;
        $this->user = factory(User::class)->create();
        $this->article = factory(Article::class)->create();
        $this->articleArray = json_decode($this->article, TRUE);

        $this->articleData = [
            'user_id' => $this->user->id,
            'title' => $this->title,            
            'published' => 1,
            'content' => $this->faker->paragraph,            
        ];
    }
    /**
     * Reset the migrations
     */
    public function tearDown(): void
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
        \Mockery::close();
    }
}
