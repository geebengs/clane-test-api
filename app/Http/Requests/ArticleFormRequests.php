<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Clane\Traits\ValidationTrait;
use Illuminate\Validation\Validator;
use Clane\Repositories\ArticleRepository as Article;

class ArticleFormRequest extends FormRequest
{
    use ValidationTrait;

    protected $validator;
    protected $article;

    public function __construct(Article $article)
    {  
        $this->article = $article;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        $article = $this->article->find($this->id);

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST': 
            {
                return [  
                    'user_id' => 'required|integer',
                    'title' => 'required|string|max:100|unique:articles',
                    'content' => 'required|string',
                    'published' => 'required|boolean'                    
                ];
            }          
            case 'PUT':            
            case 'PATCH':
            {
                return [  
                    'id' => 'required|integer',
                    'user_id' => 'required|integer',
                    'title' => 'required|string|max:100|unique:articles,title,'.$article->id,
                    'content' => 'required|string',
                    'published' => 'required|boolean'                    
                ];
            }
            default:break;
        }
    }

    public function withValidator(Validator $validator)
    {
        //set the validator to the public member so it can be used by the validatin trait
        $this->validator = $validator;
        
        $validator->after(function ($validator) { 
           
            if($this->method() == 'PATCH')
            { 
                $this->validateRouteParameter($this->route('article'), $this->id, "id"); 
            }           
        });
        
    }

    /**
     * {@inheritdoc}
     */
    protected function formatErrors(Validator $validator)
    {
        return $validator->errors();
    }
}
