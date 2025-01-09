<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learn;
use App\Models\Formation;
use App\Models\Uti;
use Illuminate\Support\Facades\DB;

class TraineeListFormation extends Controller
{

    public function show(Request $request)
    {

        $formation = Formation::findOrFail($request->input('FOR_ID'));


        $learns = Learn::with('student')->where('FOR_ID', $request->input('FOR_ID'))->get();


        $users = $learns->map(function ($learn) {
            return $learn->student;
        });


        $formationLevel = $formation->level->NIV_ID ?? 0;


        $learnedStudentIds = $learns->pluck('student.UTI_ID');


        $usersPossible = Uti::whereNotIn('UTI_ID', $learnedStudentIds)
            ->where(function ($query) use ($formationLevel) {
                if ($formationLevel == 0) {
                    $query->where('NIV_ID', '=', 0);
                } else {
                    $query->where('NIV_ID', '=', $formationLevel - 1);
                }
            })
            ->get();

        return view('traineelistformation', compact('users', 'formation', 'usersPossible'));
    }



    public function add(Request $request)
    {

        $validated = $request->validate([
            'FOR_ID' => 'required|exists:FORMATION,FOR_ID',
            'UTI_ID' => 'required|exists:UTILISATEUR,UTI_ID',
        ]);

        

        $formationId = $request->input('FOR_ID');
        $studentId = $request->input('UTI_ID');

        $existingLearn = Learn::where('FOR_ID', $formationId)
            ->where('UTI_ID', $studentId)
            ->first();

        if ($existingLearn) {
            return $this->show($request);
        }

        Learn::create([
            'UTI_ID' => $studentId,
            'FOR_ID' => $formationId,
        ]);
        

        $formation = Formation::find($formationId);
        $listSkills = DB::select("select apt_id, apt_libelle from APTITUDE join COMPETENCE using(com_id) where niv_id = ? order by com_id, apt_id", [$formation->NIV_ID]);
        foreach ($listSkills as $skill) {
            DB::table('VALIDER')->insert([
                'UTI_ID' => $studentId,
                'APT_ID' => $skill->apt_id,
                'VAL_STATUT' => 'en cours',
            ]);
        }
        return $this->show($request);
    }


    public function remove(Request $request)
    {

        $validated = $request->validate([
            'FOR_ID' => 'required|exists:FORMATION,FOR_ID',
            'UTI_ID' => 'required|exists:UTILISATEUR,UTI_ID',
        ]);

        $formationId = $validated['FOR_ID'];
        $userId = $validated['UTI_ID'];

        DB::table('apprendre')
            ->where('FOR_ID', $formationId)
            ->where('UTI_ID', $userId)
            ->delete();


        return $this->show($request);
    }
}
