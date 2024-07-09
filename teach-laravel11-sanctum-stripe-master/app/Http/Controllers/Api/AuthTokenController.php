<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
//import classe Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
class AuthTokenController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|string|min:8|confirmed",
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken("client");
            $user->token = $token->plainTextToken;

            // Envoi de l'email de bienvenue
            Mail::to($user->email)->send(new WelcomeEmail($user));

            return response()->json([
                'message' => 'Inscription réussie',
                'user' => $user,
                'token' => $user->token
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'inscription: ' . $e->getMessage()], 500);
        }
    }


    public function login(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8",
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => "Identifiants invalides"], 401);
        }

        $user->tokens()->where("name", "client")->delete();
        $token = $user->createToken("client");

        $user->token = $token->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'user' => $user,
            'token' => $user->token
        ], 200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnexion réussie'], 204);
    }
}
