<?php

namespace App\Http\Controllers\Api;

use App\Diary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiaryController extends Controller
{
       /**
     * @OA\get(
     *      path="/api/visualizar/agendas",
     *      tags={"Agendas"},
     *      summary="Metodo que tiene como funcionalidad visualizar todas las agendas creadas dentro del sistema",
     *      description="Este metodo retorna todas las agendas registradas en base de datos",
     *      @OA\Response(
     *          response=200,
     *          description="Mostrar todas las agendas"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
      * security={{ "apiAuth": {} }}
     * )
     */
    public function index()
    {
        return response()->json(['Agendas'=>Diary::all()], 200);
    }


 /**
     * @OA\post(
     *      path="/api/registrar/agenda",
     *      tags={"Agendas"},
     *      summary="Metodo que tiene como funcionalidad crear una  agenda  dentro del sistema",
     *      description="Metodo que tiene como funcionalidad crear una  agenda  dentro del sistema",
     *  @OA\Parameter(
     *          name="asunto",
     *          description="Escriba el asunto que se va registrar",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     * @OA\Parameter(
     *          name="fecha_hora",
     *          description="Escriba el asunto que se va registrar, ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *  * @OA\Parameter(
     *          name="cliente_dni",
     *          description="Escriba el asunto que se va registrar",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * *  * @OA\Parameter(
     *          name="estado_id",
     *          description="Escriba el estado_id que se va registrar",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Mostrar todas las agendas"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
      * security={{ "apiAuth": {} }}
     * )
     */

    public function store(Request $request)
    {
        $Diary= new Diary();
        $Diary->subject=$request->asunto;
        $Diary->date_and_time=$request->fecha_hora;
        $Diary->customer_dni=$request->cliente_dni;
        $Diary->status_id =$request->estado_id;
        $Diary->save();

        return response()->json([
            "msj" => "Registro de Agenda Exitoso",
            "Datos registrados"=>[
                "subjet"=> $Diary->subject,
                "date_and_time"=>$Diary->date_and_time,
                "customer_dni"=>$Diary->customer_dni,
                "status_id"=> $Diary->status_id

            ]
        ], 200);
    }

  /**
     * @OA\get(
     *      path="/api/visualizar/agenda/{id}",
     *      tags={"Agendas"},
     *      summary="Metodo que tiene como funcionalidad visualizar una  agenda creada dentro del sistema",
     *      description="Este metodo retorna una de  las agendas registradas en base de datos",
     *  @OA\Parameter(
     *          name="id",
     *          description="Digite el id de la agenda",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Mostrar la agenda con el id digitado"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
      * security={{ "apiAuth": {} }}
     * )
     */
    public function show($id)
    {
        $Diary=Diary::find($id);
        if(is_null( $Diary)){
            return response()->json(['mensaje'=>'Agenda no encontrada'], 422);
        }else{
        return response()->json([
            'Agenda'=>[
                "id"=>$Diary->id,
                "subjet"=>$Diary->subject,
                "customer"=>$Diary->customer,
                "status"=>$Diary->status
            ]


], 200);}
    }

     /**
     * @OA\put(
     *      path="/api/actualizar/agenda/{id}",
     *      tags={"Agendas"},
     *      summary="Metodo que tiene como funcionalidad actualizar una de las agendas creadas dentro del sistema",
     *      description="Metodo que tiene como funcionalidad actualizar una de las agendas creadas dentro del sistema",
     *    @OA\Parameter(
     *          name="id",
     *          description="Digite el id de la agenda a actualizar",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="asunto",
     *          description="Nuevo asunto para la agenda",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="fecha_hora",
     *          description="Nueva fecha y hora  para la agenda , por ej: 2020-10-31 13:07:19",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="cliente_dni",
     *          description="Nuevo cliente_dni  para la agenda tenga en cuenta que el dni debe pertenecer a un cliente registrado ",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
      *       @OA\Parameter(
     *          name="estado_id",
     *          description="Nuevo estado_id  para la agenda tenga en cuenta que el id debe pertenecer a un estado registrado ",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Mostrar todas las agendas"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
      * security={{ "apiAuth": {} }}
     * )
     **/



    public function update(Request $request, $id)
    {
        $Diary=Diary::find($id);
        if(is_null( $Diary)){
            return response()->json(['mensaje'=>'Agenda no encontrada'], 422);
        }
        if($Diary->status_id==1){
            if(!is_null($request->asunto)){
            $Diary->subject=$request->asunto;
            }
            if(!is_null($request->fecha_hora)){
               $Diary->date_and_time=$request->fecha_hora;
            }
            if(!is_null($request->cliente_dni)){
                $Diary->customer_dni=$request->cliente_dni;
             }
             if(!is_null($request->estado_id)){
                $Diary->status_id=$request->estado_id;
             }
             if(is_null($request->asunto) && is_null($request->fecha_hora) && is_null($request->cliente_dni) && is_null($request->estado_id) ){
                return response()->json(['mensaje'=>'No hay datos para actualizar'], 422);
             }

             $Diary->save();
             return response()->json(['Agenda'=>'datos actualizados'], 200);
            }else{
                return response()->json(['mensaje'=>'La agenda no se puede actualizar'], 422);
            }

        }



}
