<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Initiator;

class InitiatorController extends Controller
{
    public function showSessions(Request $request) {
        // (c'était juste pour tester (et ça fonctionne))
        Initiator::editProgression(2, 3, 1, "acquise", "lâche pas l'école");

        return "ouais";
    }
}
