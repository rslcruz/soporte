<?php

namespace API\Http\Controllers;

use Illuminate\Http\Request;

use API\Http\Requests;
use API\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use API\Usuario;


class AuthenticateController extends Controller
{

    public function index()
    {
        // Retrieve all the users in the database and return them
        $usuarios = Usuario::all();
        return $usuarios;
    }

    public function auth(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('nombre_usuario', 'password');
        $token=null;

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $usuario = JWTAuth::toUser($token);
        $usuario->perfil->perfil;
        // if no errors are encountered we can return a JWT
        return response()->json(compact('token','usuario'), 200);

    }
}
