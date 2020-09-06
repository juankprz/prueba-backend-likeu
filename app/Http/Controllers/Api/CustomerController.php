<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    /**
     * @OA\get(
     *      path="/api/visualizar/clientes",
     *      tags={"Clientes"},
     *      summary="Metodo que tiene como funcionalidad visualizar todos los clientes creados dentro del sistema",
     *      description="Metodo que tiene como funcionalidad visualizar todos los clientes creados dentro del sistema",
     *      @OA\Response(
     *          response=200,
     *          description="Mostrar todos los clientes"
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
       return response()->json(['Clientes'=>Customer::all()], 200);
    }

/**
     * @OA\post(
     *      path="/api/registrar/cliente",
     *      tags={"Clientes"},
     *      summary="Metodo que tiene como funcionalidad crear un  cliente  dentro del sistema",
     *      description="Metodo que tiene como funcionalidad crear un  cliente  dentro del sistema",
     *  @OA\Parameter(
     *          name="cedula",
     *          description="Escriba el numero de cedula  que se va registrar",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     * @OA\Parameter(
     *          name="nombre",
     *          description="Escriba el nombre que se va registrar, ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *   @OA\Parameter(
     *          name="apellido",
     *          description="Escriba el apellido que se va registrar",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *  *   @OA\Parameter(
     *          name="fecha_nacimiento",
     *          description="Escriba la fecha de nacimiento  que se va registrar, por ej: 1996-06-28",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *   @OA\Parameter(
     *          name="correo",
     *          description="Escriba el correo que se va registrar",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *   @OA\Parameter(
     *          name="telefono",
     *          description="Escriba el telefono que se va registrar",
     *          required=true,
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
     */


    public function store(Request $request)
    {
        $Customer= new Customer();
        $Customer->dni=$request->cedula;
        $Customer->name=$request->nombre;
        $Customer->lastname=$request->apellido;
        $Customer->date_of_birth=$request->fecha_nacimiento;
        $Customer->email=$request->correo;
        $Customer->phone=$request->telefono;
        $Customer->save();

        return response()->json([
            "msj" => "Registro de Cliente Exitoso",
            "Datos registrados"=>[
                "dni"=> $request->cedula,
                "name"=>$Customer->name,
                "lastname"=>$Customer->lastname,
                "date of birth"=>$Customer->date_of_birth,
                "email"=> $Customer->email,
                "phone"=> $Customer->phone
            ]
        ], 200);
    }
 /**
     * @OA\get(
     *      path="/api/visualizar/cliente/{dni}",
     *      tags={"Clientes"},
     *      summary="Metodo que tiene como funcionalidad visualizar una  agenda creada dentro del sistema",
     *      description="Este metodo retorna una de  las agendas registradas en base de datos",
     *  @OA\Parameter(
     *          name="dni",
     *          description="Digite el dni del cliente",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Mostrar cliente a quien le pertenece el numero dni"
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
    public function show($dni)
    {
        $Customer=Customer::find($dni);
        if(is_null( $Customer)){
            return response()->json(['mensaje'=>'Cliente no encontrado'], 422);
        }else{
        return response()->json([

     'Cliente'=>[
            "dni"=>$Customer->dni,
            "name"=>$Customer->name,
            "lastname"=>$Customer->lastname,
            "date_of_birth"=>$Customer->date_of_birth,
             "email"=>$Customer->email,
             "phone"=>$Customer->phone,
             "diaries"=>$Customer->diaries
        ]

    ], 200);
    }

    }

}
