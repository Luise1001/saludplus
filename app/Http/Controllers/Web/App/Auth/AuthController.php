<?php

namespace App\Http\Controllers\Web\App\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient\Patient;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'El campo de contraseña es obligatorio.',
        ]);

        if (Auth::attempt($credentials)) {
            $patient = Patient::first();
            return redirect()->route('reservation.index', ['patient' => $patient->id])->with('success', 'Bienvenido de nuevo!');
        }

        return back()->withErrors('Las credenciales proporcionadas son incorrectas.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['required', 'string', 'min:8', 'same:password'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatorio.',
            'confirm-password.required' => 'La confirmación de contraseña es obligatorio.',
            'confirm-password.same' => 'Las contraseñas no coinciden.',
            'confirm-password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.unique' => 'El nombre ya está en uso.',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => 10
        ]);


        $patient = Patient::where('email', $request->input('email'))->first();

        if ($patient) {
            
            $patient->update(['user_id' => $user->id]);
        }

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registro exitoso. Bienvenido!');
    }
}
