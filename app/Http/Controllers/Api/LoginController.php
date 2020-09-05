<?php

namespace App\Http\Controllers\Api;

    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Http\Controllers\Controller;

class LoginController extends Controller
{
     /**
    * @OA\post(
    *     path="/api/login",
    *     summary="Metodo disponible para iniciar sesion dentro de la api",
    *     @OA\Response(
    *         response=200,
    *         description="Responde token de tipo portador"
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Ha ocurrido un error"
    *     )
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
    *     summary="Metodo disponible para cerrar sesion dentro de la api",
    *     @OA\Response(
    *         response=200,
    *         description=" sesion cerrada"
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Ha ocurrido un error"
    *     )
    * )
    */
    public function cerrarsesion()
    {
        auth()->logout();

        return response()->json(['message' => 'Sesion cerrada']);
    }
}
