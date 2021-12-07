<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ControleArmario;

class MvArmarioController extends Controller
{
    private $mvarmario;

    public function __construct(ControleArmario $mvarmario){

        return $this->mvarmario = $mvarmario;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $mvarmarios = $this->mvarmario->where('situacao','A')->paginate('10');


            return response()->json($mvarmarios, 200);

            throw new Exception("Error Processing Request", 1);


        }catch (\Exception $e){

            $message = new ApiMessage('nenhum registro encontrado',[$e->getMessage()]);
            return response()->json([$message->getMessage(), 401]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $data = $request->all();
            $mvarmario = $this->mvarmario->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'mvarmario registrado com sucesso',
                    'mvarmario' => $mvarmario
                ]
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage());
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
         try
        {
            $mvarmario = $this->mvarmario->findOrfail($id);
            $paciente = $mvarmario->paciente->first();


            return response()->json($mvarmario, 200);

        }catch(\Exception $e){
            $message = new ApiMessage('mvarmario informado não foi encontrado', [$e->getMessage()]);
            return response()->json([$message, 401]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        try{

            $mvarmario = $this->mvarmario->findOrfail($id);
            $mvarmario->update($data);

            $mvarmario->armario->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'mvarmario atualizado com sucesso',
                    'mvarmario' => $mvarmario
                ]
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage());
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
        //
    }
}
