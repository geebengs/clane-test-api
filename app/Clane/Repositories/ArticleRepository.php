<?php
namespace Clane\Repositories;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ArticleRepository extends BaseRepository {

    public function model() 
    {
        return 'Clane\models\Article';
    } 

    public function allArticles($per_page=10) {
        $query = $this->orderBy('title', 'asc');
        
        return QueryBuilder::for($query)
            ->allowedFilters([
                'title',
                'content',
                AllowedFilter::exact('published')
            ])           
			->paginate($per_page);       
    }
    
    public function rate($id) {
        $article = $this->find($id);

        if($article) {
            $article->rating += 1;
            $article->save();

            return $article;
        }   

        return $article;     

    }
}