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

        //OJO lo puse con email en lugar de con el username
        public function loginLocal(Request $request)
        {
            // Validar los datos del formulario
            $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            // Intentar iniciar sesión usando el guard local
            if (Auth::guard('web')->attempt($credentials)) {
                // Si la autenticación es exitosa, redirigir al usuario a su página de inicio
                return redirect('/main');
            }

            // Si la autenticación falla, volver al formulario de inicio de sesión con un error
            return back()->withErrors([
                'username' => 'Las credenciales no coinciden con nuestros registros.',
            ])->onlyInput('name');
        }

        public function logoutLocal(Request $request)
        {
            // Cerrar la sesión del usuario
            Auth::guard('web')->logout();

            // Opcional: Invalidar la sesión del usuario
            $request->session()->invalidate();

            // Opcional: Regenerar el token de la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerateToken();

            // Redirigir al usuario a la página de inicio o a donde desees
            return redirect('/');
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
