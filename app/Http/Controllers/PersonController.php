<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonService;

class PersonController extends Controller
{
    private $service;

    public function __construct(PersonService $service)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->service = $service;
    }

    public function get(int $id)
    {
        return response()->json($this->service->get($id));
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    public function create(Request $request)
    {
        return response()->json($this->service->create($request->all()));
    }
}
