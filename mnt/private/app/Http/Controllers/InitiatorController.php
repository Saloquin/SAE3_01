<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Initiator;

class InitiatorController extends Controller
{
    public function showSessions(Request $request) {
        Initiator::editProgression(1, 3, 1, "acquise", "lâche pas l'école");

        return "ouais";
    }
}
