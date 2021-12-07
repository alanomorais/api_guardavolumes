<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Armario;

class ArmarioController extends Controller
{
    private $armario;

    public function __construct(armario $armario){

        return $this->armario = $armario;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $armarios = $this->armario->where('situacao','A')->paginate('10');

            return response()->json($armarios, 200);

            throw new Exception("Error Processing Request", 1);
			
        }catch (\Exception $e){

            $message = new ApiMessage($e->getMessage());
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
            $armario = $this->armario->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'armario registrado com sucesso',
                    'armario' => $armario
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
            $armario = $this->armario->findOrfail($id);

            return response()->json($armario, 200);

        }catch(\Exception $e){
            $message = new ApiMessage('Armario informado não foi encontrado', [$e->getMessage()]);
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

            $armario = $this->armario->findOrfail($id);

            $armario->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'armario atualizado com sucesso',
                    'armario' => $armario
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
            $armario = $this->armario->findOrfail($id);

            $mvArmario = $armario->mvarmarios()->first();

            if(!empty($mvArmario))
            {
                $message = new ApiMessage("O armario de código {$armario->codigo} possui movimentação e não pode ser removido");
                return response()->json([$message->getMessage(), 401]);
            }else
            {

                $armario->delete();    

                return response()->json([
                    'data' => [
                        'msg' => 'armario removido com sucesso'
                    ]
                ], 200);

            }

        }catch (\Exception $e){

            $message = new ApiMessage('Armario informando não localidado.',[$e->getMessage()]);
            return response()->json([$message->getMessage(), 401]);

        }
    }
}
