<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessage;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->paginate('15');

        return response()->json($user, 200);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $user)
    {
        $data = $user->all();

        if(!$user->has('password') || !$user->get('password')){
            $message = new ApiMessage('é Necessário informar uma senha');
            return response()->json([$message->getMessage(), 401]);
        }

        try{

            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);

            $profile = $user->profile()->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'usuário registrado com sucesso',
                    'usuario' => $user,
                    'profile' => $profile

                ]
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage(), ['usuario informado não localizado']);
            return response()->json([$message->getMessage(), 401]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{

            $user = $this->user->findOrfail($id);

            if($user){

                $profile = $user->profile()->first();

                return response()->json([
                    'data' => [
                        'user' => $user,
                        'profile' => $profile
                    ]
                ], 200);
            }else{
                $message = new ApiMessage('Nenhum usuário localizado');
            }


        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage());
            return response()->json([$message->getMessage(), 401]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $UserRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if($request->has('password') || $request->get('password')){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        try{

            $user = $this->user->findOrfail($id);
            $user->update($data);
            $profile = $user->profile->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'usuario atualizado com sucesso',
                    'usuario' => $user,
                    'perfil' => $profile
                ]
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage('Não foi possivel atualizar'));
            return response()->json([$message->getMessage(), 401]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $user = $this->user->findOrfail($id);
            $user->delete();

            return response()->json([
                'data' => [
                    'msg' => 'usuario removido com sucesso'
                ]
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage());
            return response()->json([$message->getMessage(), 401]);

        }
    }

    public function listPacientes($id)
    {
        $id_user = $this->$id;
        echo 'Aqui é a listagem dos pacientes';

        try{

            $user = $this->user->findOrfail($id);

            dd($user);

            $pacientes = $user->pacientes->all();


            return response()->json([
                'usuario' =>$user['name'],
                'data' => $pacientes
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage());
            return response()->json([$message->getMessage(), 401]);

        }
    }


}
