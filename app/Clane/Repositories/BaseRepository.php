<?php
namespace Clane\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

abstract class BaseRepository extends Repository {
    
    public abstract function model();    
    
    /**
     * @param string $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column = 'id', $direction = 'desc')
    {
        return $this->model->orderBy($column, $direction);
    }

    /**
     * @param array $columns
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate($columns=array('*'), $data){
        return $this->model::updateOrCreate(
            $columns,
            $data
        );
    }
    
    public function updateEntity($data, $id)
    {
        return tap($this->model::where('id', $id)->firstOrFail())->update($data)->fresh();
    }

    public function updateEntityUuid($data, $uuid)
    {
        return tap($this->model::where('uuid', $uuid)->firstOrFail())->update($data)->fresh();
    }

    public function _delete($column, $value)
    {
        return $this->model->where($column, '=', $value)->delete();
       
    }
}