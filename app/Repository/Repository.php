<?php

namespace App\Repository;

use App\Repository\Interfaces\IRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class Repository implements IRepository
{
    /***
     * @var Model
     */
    protected $model;

    public function Find(int $id)
    {
        return $this->model->find($id);
    }

    public function Exists($field, $value) : bool
    {
        try {
            return $this->model::where($field, $value)->count() > 0;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function All()
    {
        return $this->model::all();
    }

    public function Create(Model $model)
    {
        return $model->saveOrFail();
    }

    public function Update(int $id, Model $model)
    {
        return $model->saveOrFail();
    }

    public function Delete(int $id)
    {
       return $this->model->deleteOrFail($id);
    }

    public function Commit()
    {
        // TODO: Implement Commit() method.
    }
}
