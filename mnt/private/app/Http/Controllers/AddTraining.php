<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Uti;
use App\Models\Level;
use App\Models\Lesson;

use Illuminate\Http\Request;

class AddTraining extends Controller
{

    public function show()
    {
        session_start();
        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $levels = Level::whereNotNull('NIV_DESCRIPTION')->whereBetween('NIV_ID', [1, 3])->get();
        $init = Uti::getTeacher();
        return view('addtraining', compact('clubId', 'levels', 'init'));
    }

    public function add(Request $request)
    {
        session_start();
        $validated = $request->validate([
            'level' => 'required|exists:niveau,NIV_ID',
            'init' => 'required|exists:utilisateur,UTI_ID',
            'start' => 'required|date',
        ]);

        $formation = Formation::create([
            'NIV_ID' => $validated['level'],
            'UTI_ID' => $validated['init'],
            'FOR_ANNEE' => $validated['start'],
            'CLU_ID' => Uti::find($_SESSION["id"])->CLU_ID,
        ]);

        $formationId = $formation->FOR_ID;
        if (!empty($request->input('day'))) {
            $day = $request->input('day');
            if ($day == 0)
                return redirect()->route('directeur.gestion-formation');
            $startDate = new \DateTime($validated['start']);
            $endDate = (clone $startDate)->modify('+1 year');

            $currentDate = clone $startDate;
            while ($currentDate->format('N') != $day) {
                $currentDate->modify('+1 day');
            }


            while ($currentDate <= $endDate) {
                Lesson::create([
                    'FOR_ID' => $formationId,
                    'COU_DATE' => $currentDate->format('Y-m-d'),
                ]);
                $currentDate->modify('+1 week');
            }
        }

        return redirect()->route('directeur.gestion-formation');
    }


}