<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//import email 

use Illuminate\Support\Facades\Mail;
use App\Mail\UserDeletedEmail;
use App\Mail\UserUpdatedEmail;

class UserController extends Controller
{
    public function index(Request $request) {
        return response()->json($request->user(), 200);
    }

    public function delete(Request $request) {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        $user->delete();
        //email envois 
        Mail::to($user->email)->send(new UserDeletedEmail($user));
        return response()->json(['message' => 'Utilisateur supprimé avec succès'], 200);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();
        //email
        Mail::to($user->email)->send(new UserUpdatedEmail($user));
        return response()->json(['message' => 'Utilisateur mis à jour avec succès', 'user' => $user], 200);
    }
}
