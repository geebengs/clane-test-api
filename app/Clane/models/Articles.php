<?php

namespace Clane\models;

use Clane\models\BaseModel;

class Article extends BaseModel
{
    /**
    * The properties of this model that can be filled automatically
    * This ensures all attributes will be mass assignable
    * @var array
    */
    protected $guarded = ['id'];  
    
    public function user()
    {
        return $this->belongsTo('Clane\models\User');
    }
     

}
