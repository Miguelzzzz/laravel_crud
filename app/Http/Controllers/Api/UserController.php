<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
/**
 * Retorna uma lista paginada de usuários.
 * 
 * Esse método recupera uma lista paginada de usuários do banco de dados 
 * e a retorna como uma resposta JSON.
 * 
 * @return \Illuminate\Http\JsonResponse
 */

    public function index() : JsonResponse{
        // Recupera os usuários do banco de dados, ordenados pelo ID em ordem decrescente, paginados
        $users = User::orderBy('id', 'DESC')->paginate(2);
        //Retorna os usuários recuperados como uma resposta JSON
        return response()->json([
            'status' => true, 
            'users' => $users,
        ], 200);
    }

/**
 * Exibe os detalhes de um usuário específico.
 * 
 * Esse método retorna os detalhes de um usuário específico em formato JSON.
 *  
 * e a retorna como uma resposta JSON.
 * 
 * @param \App\Models\User  $user O objeto do usuário a ser exibido
 * @return \Illuminate\Http\JsonResponse
 */

    public function show(User $user) : JsonResponse{
        // Retorna os detalhes do usuário em formato JSON 
        return response()->json([
            'status' => true, 
            'user' => $user,
        ], 200);
    }

/**
 * Cria novo usuário com os dados fornecidos na requisição
 * 
 * @param \App\Http\Requests\UserRequest  $request O objeto de requisição contendo os dados do usuário a ser criado
 * @return \Illuminate\Http\JsonResponse
 */

    public function store(UserRequest $request) : JsonResponse{
        // Iniciar a transação
        DB::beginTransaction();

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

        // Operção é concluida com êxito
        DB::commit();

            return response()->json([
                'status' => true, 
                'user' => $user,
                'message' => "Usuário cadastrado com sucesso",
            ], 201);

        }catch(Exception $e){
            // Operação não é concluida com êxito
            DB::rollBack();
            // Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false, 
                'message' => "Usuário não cadastrado",
            ], 400);
        }
    }

    /**
     * Atualizar os dados de um usuário existente com base nos dados fornecidos na requisição.
     *
     * @param  \App\Http\Requests\UserRequest  $request  O objeto de requisição contendo os dados do usuário a ser atualizado.
     * @param  \App\Models\User  $user  O usuário a ser atualizado.
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(UserRequest $request, User $user) : JsonResponse {
        // Iniciar a transação
        DB::beginTransaction();

        try{
            // Editar o registro no banco de dados 
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

        // Operção é concluida com êxito
        DB::commit();

        // Retorna os dados do usuário editado e uma mensagem de sucesso com status 200
        return response()->json([
            'status' => true, 
            'user' => $user,
            'message' => "Usuário editado com sucesso",
        ], 200);


        }catch(Exception $e){
            // Operação não é concluida com êxito
            DB::rollBack();
            // Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false, 
                'message' => "Usuário não editado",
            ], 400);
        }
        
        return response()->json([
            'status' => true, 
            'user' => $request,
            'message' => "Usuário editado com sucesso",
        ], 200);
    }

    /**
     * Excluir usuário no banco de dados.
     *
     * @param  \App\Models\User  $user  O usuário a ser excluido.
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy(User $user) : JsonResponse {
        try{
            // Apagar o registro no banco de dados 
            $user->delete();

            // Retorna os dados do usuário excluido e uma mensagem de sucesso com status 200
            return response()->json([
                'status' => true, 
                'user' => $user,
                'message' => "Usuário excluido com sucesso",
            ], 200);
            
        }catch(Exception $e){
           // Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false, 
                'message' => "Usuário não deletado",
            ], 400);
        }
    }
}
