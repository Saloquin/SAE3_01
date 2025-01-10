<?php
/**
 * TraineeListFormation Controller
 * 
 * This controller handles the display, addition, and removal of trainees from formations.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\API\Teach;
use Illuminate\Http\Request;
use App\Models\Learn;
use App\Models\Formation;
use App\Models\Uti;
use Illuminate\Support\Facades\DB;
use App\Models\Validate;

class TraineeListFormation extends Controller
{
    /**
      * Display the list of trainees for a specific formation.
      * 
      * @param Request $request The HTTP request object.
      * @return \Illuminate\View\View The view displaying the list of trainees.
      */
    public function show(Request $request)
    {
        

        

        include resource_path('includes/header.php');
        

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
            ->where('UTI_EST_INIT', 0)
            ->where('CLU_ID', Uti::find(session('id'))->CLU_ID)
            ->whereNotIn('UTI_ID', function ($query)  {
                $query->select('UTI_ID')
                    ->from('apprendre');
            })
            ->get();

        return view('traineelistformation', compact('users', 'formation', 'usersPossible'));
    }


    /**
      * Add a trainee to a formation.
      * 
      * @param Request $request The HTTP request object.
      * @return \Illuminate\View\View The view displaying the updated list of trainees.
      */
    public function add(Request $request)
    {

        $validated = $request->validate([
            'FOR_ID' => 'required|exists:formation,FOR_ID',
            'UTI_ID' => 'required|exists:utilisateur,UTI_ID',
        ]);



        $formationId = $request->input('FOR_ID');
        $studentId = $request->input('UTI_ID');

        $existingLearn = Learn::where('FOR_ID', $formationId)
            ->where('UTI_ID', $studentId)
            ->first();

        if ($existingLearn) {
            return $this->show($request);
        }

        $learnCount = Learn::where('FOR_ID', $formationId)->count();
        $studentCount=Learn::where('FOR_ID', $formationId)->count();
        $initCount = Teach::where('FOR_ID', $formationId)->count();
        if ($learnCount >= 10) {
            return $this->show($request);
        }
        if ($studentCount >= 2 * $initCount) {
            return $this->show($request);
        }

        Learn::create([
            'UTI_ID' => $studentId,
            'FOR_ID' => $formationId,
        ]);



        $formation = Formation::find($formationId);
        $listSkills = DB::select("select apt_id, apt_libelle from aptitude join competence using(com_id) where niv_id = ? order by com_id, apt_id", [$formation->NIV_ID]);
        foreach ($listSkills as $skill) {
            if (Validate::where('UTI_ID', $studentId)->where('APT_ID', $skill->apt_id)->doesntExist()) {
                DB::table('valider')->insert([
                    'UTI_ID' => $studentId,
                    'APT_ID' => $skill->apt_id,
                    'VAL_STATUT' => 0,
                ]);
            }
        }
        return $this->show($request);
    }

    /**
      * Remove a trainee from a formation.
      * 
      * @param Request $request The HTTP request object.
      * @return \Illuminate\View\View The view displaying the updated list of trainees.
      */
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'FOR_ID' => 'required|exists:formation,FOR_ID',
            'UTI_ID' => 'required|exists:utilisateur,UTI_ID',
        ]);
        
        $formationId = $validated['FOR_ID'];
        $userId = $validated['UTI_ID'];

        $existingLearn = Learn::where('FOR_ID', $formationId)
            ->where('UTI_ID', $userId)
            ->first();

        if (!$existingLearn) {
            return $this->show($request);
        }

        DB::table('apprendre')
            ->where('FOR_ID', $formationId)
            ->where('UTI_ID', $userId)
            ->delete();


        return $this->show($request);
    }
}

    