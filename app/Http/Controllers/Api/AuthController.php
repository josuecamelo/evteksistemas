<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class AuthController extends Controller
{
    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        list ($campoLogin, $credentials ) = $this->loginUsername($request);
        $rules = $this->getRegrasCampoAutenticacao($campoLogin, $credentials);

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        //usuário tem que estar ativo no sistema
        //$credentials['ativo'] = 'S';
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Não podemos encontrar uma conta com essas credenciais. Por favor, certifique-se de que você digitou as informações corretas e verificou seu endereço de e-mail.'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Falha ao fazer o login, por favor, tente novamente.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message' => "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    /**
     * Retorna campo usado na autenticação
     * @param string $campoLogin
     * @return array
     */
    public function getRegrasCampoAutenticacao(string $campoLogin, array $credentials): array
    {
        if ($campoLogin === 'email' || filter_var($credentials[$campoLogin], FILTER_VALIDATE_EMAIL)) {
            $rules = [
                $campoLogin => 'required|email',
                'password' => 'required',
            ];
        } else {
            $rules = [
                $campoLogin => 'required|min:4',
                'password' => 'required',
            ];
        }
        return $rules;
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    /*
     * Campo para Informar Qual Campo será usado no login
     * */
    public function loginUsername(Request $request)
    {
        $fields = $request->all();

        /*if (property_exists($fields, 'login') && !filter_var($fields->login, FILTER_VALIDATE_EMAIL)) {
            $fieldLogin = 'login';
        } else {
            $fields->email = $fields->login;
            $fieldLogin = 'email';
            unset($fields->login);
        }*/

        $fieldLogin = 'email';
        return [$fieldLogin, $fields];
    }
}
