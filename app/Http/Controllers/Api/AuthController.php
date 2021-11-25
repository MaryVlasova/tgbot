<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request)
    {
        
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                            'status' => 'error',
                            'code' => 401 ,
                            'message' => 'Unauthorized'
                    ], 401);
        }
        try {
            $user = User::where('email', $request['email'])->firstOrFail();
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 401 ,
                'message' => 'Unauthorized'
            ], 401);
        }
    
        try {
            $token = $user->createToken('auth_token')->plainTextToken;        
            return response()->json([
                        'status' => 'success',
                        'code' => 200 ,
                        'message' => 'ok' ,
                        'access_token' => $token,
                        'token_type' => 'Bearer',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500 ,
                'message' => 'Unauthorized'
            ], 500);
        }
        

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'ok',
            'code' => 200 ,
            'message' => 'Logged out'
        ], 200);        
    }    
    // {
    //     "access_token": "1|dXZI1St29gii1bdfDHAOg8MPNJ7DVj7NiHCVcMh1",
    //     "token_type": "Bearer"
    //   }
}
