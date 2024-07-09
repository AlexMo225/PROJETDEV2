<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function sendPasswordResetLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = app('auth.password.broker')->createToken($user);

            // Envoyer un email de réinitialisation de mot de passe
            Mail::to($user->email)->send(new PasswordResetEmail($user, $token));

            return response()->json(['message' => 'Password reset link sent.']);
        }

        return response()->json(['message' => 'User not found.'], 404);
    }
}
