<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        // sa retourne juste ok
        // je retourne les actualité (les info de ma bdd) en json
        return response()->json(["message" => "ok"]);
    }
}
