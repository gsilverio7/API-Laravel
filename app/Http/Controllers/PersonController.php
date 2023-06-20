<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonService;

class PersonController extends Controller
{
    /**
     * O controlador apenas recebe as chamadas e devolve as repostas. 
     * A maior parte do código e da lógica da API está na service PersonService.
     */

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
     *         description="Id da pessoa",
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
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Nome da pessoa",
     *                     property="name",
     *                     type="string"
     *                 ),
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

    /**
     * @OA\Put(
     *     path="/api/update",
     *     summary="Altera o registro de uma pessoa no banco de dados",
     *     tags={"Pessoas"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Id da pessoa",
     *                     property="id",
     *                     type="int"
     *                 ),
     *                 @OA\Property(
     *                     description="Novo nome da pessoa",
     *                     property="name",
     *                     type="string"
     *                 ),
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
    public function update(Request $request)
    {
        return response()->json($this->service->update($request->all()));
    }

    /**
     * @OA\Delete(
     *     path="/api/delete",
     *     summary="Apaga o registro de uma pessoa do banco de dados",
     *     tags={"Pessoas"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Id da pessoa",
     *                     property="id",
     *                     type="int"
     *                 ),
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
    public function delete(Request $request)
    {
        return response()->json($this->service->delete($request->all()));
    }
}
