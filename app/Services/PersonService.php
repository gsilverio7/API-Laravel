<?php

namespace App\Services;

use App\Models\Person;

class PersonService
{
    private $model;

    public function __construct(Person $person)
    {
        $this->model = $person;
    }

    public function get(int $id): array
    {
        try {
            $model = $this->model;
            return $model->find($id)->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getAll(): array
    {
        try {
            $model = $this->model;
            return $model->get()->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    public function create(array $dados): bool
    {
        try {
            $this->model::create($dados);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
