<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleFormRequest;
use App\Http\Requests\RatingFormRequest;
use Clane\Repositories\ArticleRepository as Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Str;

class ArticleApiController extends ApiController
{    
    private $article;

    public function __construct(Article $article) 
    {    
        $this->article = $article;  
        
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * @SWG\Get(
     *      path="/articles",
     *      operationId="getArticleList",
     *      tags={"Article"},
     *      summary="Get list of articles",
     *      description="Returns list of articles", *      
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @SWG\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns list of projects
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->article->allArticles($request->per_page);
	
		return ArticleResource::collection($articles);
    }

    /**
     * @SWG\Post(
     *      path="/articles",
     *      operationId="CreateArticle",
     *      tags={"Article"},
     *      summary="create a articles",
     *      description="Create an article",  * 		
     *      @SWG\Parameter(  
     *  		name="article",
     * 			in="body",          
     * 			required=true,
     *          @SWG\Schema(ref="#/definitions/Article")			
     *	    ),       
    *      @SWG\Response(
    *          response=201,
    *          description="successful operation"
    *       ),
    *       @SWG\Response(response=400, description="Bad request"),
    *       security={
    *           {"api_key_security_example": {}}
    *       }
    *     )
    *
    * logs in a state
    */
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ArticleFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {
        $request['slug'] = Str::slug($request->title, "-");

        $article = $this->article->create($request->all());
        
        return response()->json($article, 201); 
    }

    /**
	 *
	 * - article ------------------------------------------------------
	 *
	 * @SWG\Get(
	 * 		path="/articles/{id}",
	 * 		tags={"Article"},
	 * 		operationId="getArticle",
	 * 		summary="Fetch article details",
	 * 		@SWG\Parameter(
	 * 			name="id",
	 * 			in="path",
	 * 			required=true,
	 * 			type="integer",
	 * 			description="Id",
	 * 		),
	 * 		@SWG\Response(
	 * 			response=200,
	 * 			description="success",
	 * 			@SWG\Schema(ref="#/definitions/Article"),
	 * 		),
	 * 		@SWG\Response(
	 * 			response="default",
	 * 			description="error",
	 * 			@SWG\Schema(ref="#/definitions/Error"),
	 * 		),
	 * 	)
	 *
	 */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->article->find($id);

        if(!$article)
        {
            return response()->json($article, 204);
        }
        
        return response()->json($article, 200);
    }

    /**
	 *
	 * 	@SWG\Patch(
	 * 		path="/articles/{id}",
	 * 		tags={"Article"},
	 * 		operationId="updateArticle",
	 * 		summary="Update an article information",
	 * 		@SWG\Parameter(
	 * 			name="id",
	 * 			in="path",
	 * 			required=true,
	 * 			type="integer",
	 * 			description="Id",
	 * 		),
	 * 		@SWG\Parameter(
	 * 			name="article",
	 * 			in="body",
	 * 			required=true,
	 * 			@SWG\Schema(ref="#/definitions/ArticleUpdate"),
	 *		),
	 * 		@SWG\Response(
	 * 			response=200,
	 * 			description="success",
     *          @SWG\Schema(ref="#/definitions/ArticleUpdate"),
	 * 		),
	 * 		@SWG\Response(
	 * 			response="default",
	 * 			description="error",
	 * 			@SWG\Schema(ref="#/definitions/Error"),
	 * 		),
	 * 	)
	 *
	 */
    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ArticleFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleFormRequest $request, $id)
    {
        $article = $this->article->updateEntity($request->all(), $id);
       
        return response()->json($article, 200);
    }

    /**
	 *
	 * 	@SWG\Post(
	 * 		path="/articles/{id}/rating",
	 * 		tags={"Article"},
	 * 		operationId="rateArticle",
	 * 		summary="Rate an article information",
	 * 		@SWG\Parameter(
	 * 			name="id",
	 * 			in="path",
	 * 			required=true,
	 * 			type="integer",
	 * 			description="Id",
	 * 		),	 		
	 * 		@SWG\Response(
	 * 			response=200,
	 * 			description="success",
     *          @SWG\Schema(ref="#/definitions/ArticleUpdate"),
	 * 		),
	 * 		@SWG\Response(
	 * 			response="default",
	 * 			description="error",
	 * 			@SWG\Schema(ref="#/definitions/Error"),
	 * 		),
	 * 	)
	 *
	 */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rating(Request $request, $id)
    {
        $article = $this->article->find($id);

        if(!$article)
        {
            return response()->json($article, 204);
        }

        $article = $this->article->rate($id);
       
        return response()->json($article, 200);
    }

    /**
     * @SWG\Delete(
     *      path="/articles/{id}",
     *      tags={"Article"},
     *      operationId="Delete an article item",
     *      summary="Delete article",
     *      @SWG\Parameter(
     *          name="id",
	 * 			in="path",
	 * 			required=true,
	 * 			type="integer",
	 * 			description="Id",
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Success"
     *      ),
     * )
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->article->delete($id);

        return response()->json(['message' => 'Article Deleted!'], 200);
    }    
}
