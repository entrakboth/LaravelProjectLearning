<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // TODO : research more advance laravel https://laravel.com/docs/10.x/authentication

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    // view use

    // user login
    public function login(Request $request)
    {

        // check validate | email and password used to match at the database 
        $request->validate([
            'email' => 'required|string|email',
            // 'name' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password'); // we take only email and password


        // give token when email and password are match
        // TODO + research more on  $token = Auth::attempt($credentials);
        $token = Auth::attempt($credentials);
        if (!$token) {      // if token is empty return json error
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401); // return 401 (Unauthorized) when it fails 
        }

        // it show success message and provide token 
        // TODO + research on $user = Auth::user();
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);

    }

    // register new user
    public function register(Request $request)
    {

        // check validate data | name | email | password
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);

        // create new user
          // TODO : research on $user = User::create | advance lavavel 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            // Hash::make($resquest->password) is provide by laravel used to transform user password
            // into a line of string that human cannot be read only the machine know 
            // and it can not be tranform back to original form 
            // sammuray it Hash::make(data) used to tranform data into string or charactor and cant be tranform back  
        ]);

        // give uses a token and message after register successfully 
        // TODO : research on Auth::login | advance lavavel 
        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    // user log out
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    // refresh
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ],
        ]);
    }

    // get a user data
    public function getUserData()
    {
        $user = auth()->user();
        $userData = [
            'name' => $user->name,
            'email' => $user->email,
        ];
        return response()->json([
            'status' => 'success',
            'user' => $userData,
        ]);
    }
}
