<?php

namespace App\Http\Controllers\Web\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient\Patient;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $patient = Patient::where('user_id', $user->id)->first();

        return view('app.profile.index', [
            'user' => $user,
            'patient' => $patient,
        ]);
    }

    public function password(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ], [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'current_password.string' => 'La contraseña actual debe ser una cadena.',
            'current_password.min' => 'La contraseña actual debe tener al menos 8 caracteres.',
            'new_password.required' => 'La nueva contraseña es obligatoria.',
            'new_password.string' => 'La nueva contraseña debe ser una cadena.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'confirm_password.required' => 'La confirmación de la contraseña es obligatoria.',
            'confirm_password.string' => 'La confirmación de la contraseña debe ser una cadena.',
            'confirm_password.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
            'confirm_password.same' => 'La confirmación de la contraseña no coincide con la nueva contraseña.',
            'user_id.required' => 'El ID de usuario es obligatorio.',
            'user_id.integer' => 'El ID de usuario debe ser un número entero.',
            'user_id.exists' => 'El ID de usuario no existe.',
        ]);

        $user = Auth::user();

        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect()->back()->withSuccess('Contraseña actualizada correctamente.');
    }
}
