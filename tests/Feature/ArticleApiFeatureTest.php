<?php

namespace Tests\Feature;

use Tests\TestCase;

class ArticleApiUnitTest extends TestCase
{   
    /** @test */
    public function should_unauthorize_deletion_of_article()
    {
        $article = $this->articleArray;
      
        $response = $this->json('DELETE', '/api/v1/articles/'.$article['id'], $article)
            ->assertStatus(401)
            ->assertSeeText("Unauthenticated");        
    } 

    
    /** @test */
    public function should_delete_an_article()
    {
        $article = $this->articleArray;
      
        $response = $this->actingAs($this->user, 'api')->json('DELETE', '/api/v1/articles/'.$article['id'], $article)
            ->assertStatus(200)
            ->assertJson(['message' => "Article Deleted!"]);        
    } 

    /** @test */
    public function should_unauthorize_update_of_article()
    {
        $article = $this->articleArray;
        $article['published'] = false;

        $response = $this->json('PATCH', '/api/v1/articles/'.$article['id'], $article)
            ->assertStatus(401)
            ->assertSeeText("Unauthenticated");        
    } 

    /** @test */
    public function should_update_an_article()
    {
        $article = $this->articleArray;
        $article['published'] = false;

        $response = $this->actingAs($this->user, 'api')->json('PATCH', '/api/v1/articles/'.$article['id'], $article)
            ->assertStatus(200)
            ->assertJson($article);        
    } 

    /** @test */
    public function should_get_an_article()
    {
        $article = $this->articleArray;

        $response = $this->json('GET', '/api/v1/articles/'.$article['id'])       
            ->assertStatus(200)
            ->assertJson($article); 
    }

    /** @test */
    public function should_get_all_articles()
    {
        $article = $this->articleArray;

        $response = $this->json('GET', '/api/v1/articles')       
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data',
                    'links',
                    'meta'                   
                ]
            ); 
    }

    /** @test */
    public function should_unauthorize_creation_of_an_article()
    {
        $this->json('POST', '/api/v1/articles', $this->articleData)
            ->assertStatus(401)
            ->assertSeeText("Unauthenticated");        
    }   

    /** @test */
    public function should_create_an_article()
    {
        $this->actingAs($this->user, 'api')->json('POST', '/api/v1/articles', $this->articleData)
            ->assertStatus(201)
            ->assertJson($this->articleData);
    }   

    /** @test */
    public function should_unauthorize_rating_of_an_article()
    {
        $article = $this->articleArray;

        $this->json('POST', '/api/v1/articles/'.$article['id'].'/rating', [])
            ->assertStatus(401)
            ->assertSeeText("Unauthenticated");        
    }   

    /** @test */
    public function should_rate_an_article()
    {
        $article = $this->articleArray;

        $this->actingAs($this->user, 'api')->json('POST', '/api/v1/articles/'.$article['id'].'/rating', [])
            ->assertStatus(200)
            ->assertJsonFragment(['rating' => 1]);
    } 

    /** @test */
    public function should_search_article_by_title()
    {
        $title = $this->article->title;

        $this->json('GET', '/api/v1/articles?filter[title]='.$title)
            ->assertStatus(200)
            ->assertJsonFragment(['title' => $title]);
    } 

    /** @test */
    public function should_search_published_article()
    {
        $published = $this->article->published;

        $this->json('GET', '/api/v1/articles?filter[published]='.$published)
            ->assertStatus(200)
            ->assertJsonFragment(['published' => $published]);
    } 
}