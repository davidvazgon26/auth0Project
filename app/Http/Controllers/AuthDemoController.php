<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthDemoController extends Controller
{
    //

    public function loginLocal(Request $request)
    {
         // Validar los datos del formulario
         $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        // Intentar iniciar sesión usando el guard local
        if (Auth::guard('web')->attempt($credentials)) {
            // Si la autenticación es exitosa, redirigir al usuario a su página de inicio
            return redirect()->intended('main');
        }

        // Si la autenticación falla, volver al formulario de inicio de sesión con un error
        return back()->withErrors([
            'username' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }

       // Manejar el registro del usuario
       public function register(Request $request)
       {
        //   dd($request->all());

           // Validar los datos del formulario
           $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'username' => 'required|string|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el nuevo usuario
        $user = User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),

        ]);

        // Opcional: iniciar sesión automáticamente al registrarse
        // Auth::login($user);

        // Redirigir al usuario a su página de login 
        return redirect()->intended('/');
       }
}
