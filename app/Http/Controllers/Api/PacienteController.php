<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessage;
use App\Http\Requests\PacienteRequest;
use App\Http\Controllers\Controller;
use App\Models\Paciente;

class PacienteController extends Controller
{
    private $paciente;

    public function __construct(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paciente = $this->paciente->paginate('10');

        return response()->json($paciente, 200);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteRequest $request)
    {
        $data = $request->all();
        try{

            $paciente = $this->paciente->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Paciente registrado com sucesso',
                    'paciente' => $paciente
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
        try{

            $paciente = $this->paciente->findOrfail($id);

            return response()->json([
                'data' => [
                    'paciente' => $paciente
                ]
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage('paciente informado não localizado', [$e->getMessage()]);
            return response()->json([$message->getMessage(), 400]);

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteRequest $request, $id)
    {
        $data = $request->all();

        try{

            $paciente = $this->paciente->findOrfail($id);
            $paciente->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Paciente atualizado com sucesso',
                    'paciente' => $paciente
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
        try{

            $paciente = $this->paciente->findOrfail($id);
            $paciente->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Paciente removido com sucesso'
                ]
            ], 200);

        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage());
            return response()->json([$message->getMessage(), 401]);

        }
    }
}
