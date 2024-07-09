<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "subject" => "required",
            "message" => "required|min:50",
        ]);

        $data = $request->only('name', 'email', 'subject', 'message');

        try {
            Mail::raw($data['message'], function ($message) use ($data) {
                $message->to('alexmorel1999@gmail.com')
                        ->subject($data['subject'])
                        ->from($data['email'], $data['name']);
            });

            return response()->json(['message' => 'Email envoyé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de l\'envoi de l\'email'], 500);
        }
    }
}
