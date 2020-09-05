<?php

namespace App\Http\Controllers\Api;

    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Http\Controllers\Controller;

    /**
* @OA\Info(title="API Test Likeu ", version="1.0")
*
* @OA\Server(url="http://127.0.0.1:8000")
*/
 /**
    * @OA\Get(
    *     path="/api/",
     *   tags={"Path"},
    *     summary="Mostrar ejecucion API",
    *     @OA\Response(
    *         response=200,
    *         description="API corriendo con exito."
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
class LoginController extends Controller
{
   /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="getProjectById",
     *      tags={"Autentificación"},
     *      summary="Metodo que tiene como funcionalidad autentificacerse en el sistema",
     *      description="Retorna datos de autentificacion validos",
     *      @OA\Parameter(
     *          name="email",
     *          description="Correo electronico del usuario previamente registrado",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="password",
     *          description="Correo electronico del usuario previamente registrado",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
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
     *      )
     * )
     */


    public function iniciarsesion(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user=User::where('email', $request->email)->get()->first();

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales invalidas'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Lo sentimos no se pudo crear el token'], 500);
        }

        return response()->json([
            'usuario que inicio sesion'=> $user->name,
            'tipo de token' => 'bearer',
            'expira en' => auth()->factory()->getTTL() * 60 ." "."Segundos",
            'token de acceso' => $token
        ]);
    }

     /**
    * @OA\post(
    *     path="/api/logout",
    *   tags={"Autentificación"},
    *     summary="Metodo disponible para cerrar sesion dentro de la api",
    *
    *     @OA\Response(
    *         response=200,
    *         description=" sesion cerrada"
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Ha ocurrido un error"
    *     ),
    * security={{ "apiAuth": {} }}
    * )
    */
    public function cerrarsesion()
    {
        auth()->invalidate(true);
        return response()->json(['message' => 'Sesion cerrada']);
    }
}
