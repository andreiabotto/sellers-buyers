<?php

namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface IRepository
{
    public function Find(int $id);
    public function All();
    public function Create(Model $model);
    public function Update(int $id, Model $model);
    public function Delete(int $id);
    public function Commit();
}
