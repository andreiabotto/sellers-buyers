<?php

namespace App\Repository;

use App\Repository\Interfaces\IRepository;
use Illuminate\Database\Eloquent\Model;

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

    public function All()
    {
        // TODO: Implement All() method.
    }

    public function Create(Model $model)
    {
        // TODO: Implement Create() method.
    }

    public function Update(int $id, Model $model)
    {
        // TODO: Implement Update() method.
    }

    public function Delete(int $id)
    {
        // TODO: Implement Delete() method.
    }

    public function Commit()
    {
        // TODO: Implement Commit() method.
    }
}
