<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\Api
 *
 * @SWG\Swagger(
 *     basePath="/api/v1", *     
 *     @SWG\Info(
 *         version="1.0",
 *         title="Clane Test API",
 *         @SWG\Contact(name="Gbenga Sodunke", url="#"),
 *     ),
 *     
 *     @SWG\Definition(
 *         definition="Article",
 *         required={"title","content","user_id","published"},
 *         @SWG\Property(property="user_id", type="integer", description="Author Id"),
 *         @SWG\Property(property="title", type="string", description="Title"),
 *         @SWG\Property(property="content", type="string", description="Content"),
 *         @SWG\Property(property="published", type="boolean", description="Published Status"),
 *     ),
 *     @SWG\Definition(
 *         definition="ArticleUpdate",
 *         required={"id","title","content","user_id","published"},
 *         @SWG\Property(property="id", type="integer", description="Id"),
 *         @SWG\Property(property="user_id", type="integer", description="Author Id"),
 *         @SWG\Property(property="title", type="string", description="Title"),
 *         @SWG\Property(property="content", type="string", description="Content"),
 *         @SWG\Property(property="published", type="boolean", description="Published Status"),    
 *     ),
 *     @SWG\Definition(
 *         definition="Login",
 *         required={"email", "password"},
 *         @SWG\Property(property="email", type="string", description="Jobboard Name"),
 *         @SWG\Property(property="password", type="string"),*        
 *     ), 
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
