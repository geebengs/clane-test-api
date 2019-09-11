<?php

namespace Clane\Traits;

trait ValidationTrait {  

    private function validateRouteParameter($routeId, $id, $routeType="uuid")
    {
        //checks to see if the update route parameter is an Id or a uuid 
        if($routeType != "uuid")
        {
            $routeType = "id";
        }
        
        if($routeId != $id)
        {
            $this->validator->errors()->add($routeType, 'Route parameter does not match request id');
        }
    }
}
