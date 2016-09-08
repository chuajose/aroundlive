<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;  

class UserController extends Controller
{
    public function __construct()
    {
    

        $this->middleware('jwt.auth', ['except' => ['login']]); //afecta a todo la class para requerir token
    }
 
    public function login(Request $request)
    {
        // credenciales para loguear al usuario
        $credentials = $request->only('email', 'password');
 
        try {
            // si los datos de login no son correctos
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // si no se puede crear el token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
 
        // todo bien devuelve el token
        return response()->json(compact('token'));
    }

    public function show($id){
        $user = User::find($id);

        if(!$user)return response()->json(['error' => 'not_found'], 200);
        
        $data = array(  
            'data' => compact('user'),
            );
        

        return response()->json($data);
    }

    public function refreshToken(){
        $user = \JWTAuth::parseToken()->authenticate();
        $token = \JWTAuth::getToken();
        $token = \JWTAuth::refresh($token);
        return response()->json(compact('token'));
    }
}