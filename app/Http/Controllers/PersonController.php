<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonService;

class PersonController extends Controller
{
    /**
     * @OA\Info(
     *    title="API",
     *    description="API REST que busca e cadastra pessoas no banco de dados. Criada com Laravel e JWT.",
     *    version="1.0.0",
     * ),
     *   @OA\SecurityScheme(
     *       securityScheme="bearerAuth",
     *       in="header",
     *       name="bearerAuth",
     *       type="http",
     *       scheme="bearer",
     *       bearerFormat="JWT",
     *    ),
     */

    private $service;

    public function __construct(PersonService $service)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/get/{id}",
     *     summary="Busca uma pessoa do banco de dados",
     *     tags={"Pessoas"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(
     *         description="Id da pessoa a ser buscada",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={"id":1, "name": "João Pedro"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sem autenticação"
     *     )
     * )
     */
    public function get(int $id)
    {
        return response()->json($this->service->get($id));
    }

    /**
     * @OA\Get(
     *     path="/api/getAll",
     *     summary="Busca todas as pessoas registradas no banco de dados",
     *     tags={"Pessoas"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={{"id":1, "name": "João Pedro"}, {"id":2, "name": "Maria Luiza"}}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sem autenticação"
     *     )
     * )
     */
    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    /**
     * @OA\Post(
     *     path="/api/create",
     *     summary="Adiciona uma nova pessoa no banco de dados",
     *     tags={"Pessoas"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="formData",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 example={"name": "Jessica Silva"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sem autenticação"
     *     )
     * )
     */
    public function create(Request $request)
    {
        return response()->json($this->service->create($request->all()));
    }
}
