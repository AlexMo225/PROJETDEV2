<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListAbonnement;
use Illuminate\Http\Request;

class ListAbonnementController extends Controller
{
    // subcription.vue liste de tout les abonnements
    public function index()
    {
        $abonnements = ListAbonnement::all();
        return response()->json($abonnements);
    }
}
