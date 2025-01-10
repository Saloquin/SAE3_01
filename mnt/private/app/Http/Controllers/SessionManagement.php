<?php
/**
 * Class SessionManagement
 * 
 * This controller handles session management for different user roles and manages course sessions.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Skill;
use App\Models\Uti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SessionManagement extends Controller
{
    /**
      * Display the session management page.
      * 
      * This method handles the display of the session management page based on the user's role.
      * It retrieves course and student data based on the provided date and formation level.
      * 
      * @param Request $request The HTTP request instance.
      * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse The view for session management or JSON response for AJAX requests.
      */
    public function show(Request $request)
    {
        
        include resource_path('includes/header.php');
        

        $date = $request->input('cou_date');
        $course = null;
        $studentsData = []; 
        
        if ($date) {
            $course = Lesson::where('COU_DATE', $date)
                            ->where('FOR_ID', session('formation_level'))
                            ->first();
            
            if ($course) {
                $groups = DB::table('groupe')
                            ->where('COU_ID', $course->COU_ID)
                            ->get();

                foreach ($groups as $group) {
                    $student1 = Uti::find($group->UTI_ID_ELV1);
                    $student2 = Uti::find($group->UTI_ID_ELV2);

                    $initiator = Uti::find($group->UTI_ID_INIT);
                    
                    $aptitudesStudent1 = DB::table('maitriser')
                                    ->where('COU_ID', $course->COU_ID)
                                    ->where('UTI_ID', $group->UTI_ID_ELV1)
                                    ->pluck('APT_ID');

                    $aptitudesStudent2 = DB::table('maitriser')
                                    ->where('COU_ID', $course->COU_ID)
                                    ->where('UTI_ID', $group->UTI_ID_ELV2)
                                    ->pluck('APT_ID');
                    
                    
                    $studentsData[$group->UTI_ID_ELV1] = [
                        'student_name' => $student1->UTI_NOM . ' ' . $student1->UTI_PRENOM,
                        'initiator_id' => $initiator->UTI_ID,
                        'initiator_name' => $initiator->UTI_NOM . ' ' . $initiator->UTI_PRENOM,
                        'aptitudes' => $aptitudesStudent1->toArray(),
                    ];
                    
                    if($group->UTI_ID_ELV2 !== null){
                        $studentsData[$group->UTI_ID_ELV2] = [
                            'student_name' => $student2->UTI_NOM . ' ' . $student2->UTI_PRENOM,
                            'initiator_id' => $initiator->UTI_ID,
                            'initiator_name' => $initiator->UTI_NOM . ' ' . $initiator->UTI_PRENOM,
                            'aptitudes' => $aptitudesStudent2->toArray(),
                        ];
                    }
                }
            }
        }
        
        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
                'date' => $date,
                'students_data' => $studentsData
            ]);
        }

        $skills = Skill::getSkillByFormationLevel(session('formation_level'));
        $students = Uti::getStudentByFormation(session('formation_level'));
        $initiators = Uti::getTeacherByFormation(session('formation_level'));

        return view('gestionseance', [
            'skills' => $skills,
            'student' => $students,
            'initiator' => $initiators,
            'date' => $date,
            'course' => $course,
            'students_data' => $studentsData 
        ]);
    }
    /**
      * Execute the request to manage session data.
      * 
      * This method handles the execution of session data management, including validation and insertion of course and group data.
      * 
      * @param Request $request The HTTP request instance.
      * @return \Illuminate\Http\RedirectResponse The redirect response after processing the request.
      */
    public function executeRequest(Request $request)
    {
        
        $studentIds = $request->input('student');
        $initiatorIds = $request->input('initiator');
        $competences = $request->input('competences');
        $date = $request->input('session_date'); 

        $courseId = $request->input('course_id');
        if (empty($courseId)) {
            $courseId = null;
        }

        if (empty($studentIds) || empty($initiatorIds) || empty($competences) || empty($date)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Tous les champs doivent être remplis.');
        }

        if (count($studentIds) != count($initiatorIds)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Chaque élève doit être assigné à un initiateur.');
        }

        foreach ($studentIds as $studentId) {
            if (!isset($competences[$studentId]) || empty($competences[$studentId])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Chaque étudiant doit avoir des aptitudes.');
            }
        }

        $filteredInitiators = array_filter($initiatorIds, fn($value) => is_string($value) || is_int($value));
        $initiatorCounts = array_count_values($filteredInitiators);

        foreach ($initiatorCounts as $initiatorId => $count) {
            if ($count > 2) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "L'initiateur avec l'ID $initiatorId est assigné à plus de 2 étudiants.");
            }
        }
        
        $for_id =  session('formation_level');

        if ($courseId === null) {
            Lesson::insertLesson($for_id, $date);
        }

        $usedStudents = [];
        for ($i = 0; $i < count($studentIds); $i++) {
            if (in_array($studentIds[$i], $usedStudents)) {
                continue;
            }

            $studentId1 = $studentIds[$i];
            $initiatorId = $initiatorIds[$i];
            $aptitudes1 = $competences[$studentId1] ?? [];

            $studentId2 = null;
            $aptitudes2 = [];

            for ($j = $i + 1; $j < count($studentIds); $j++) {
                if ($initiatorIds[$j] === $initiatorId && !in_array($studentIds[$j], $usedStudents)) {
                    $studentId2 = $studentIds[$j];
                    $aptitudes2 = $competences[$studentId2] ?? [];
                    $usedStudents[] = $studentId2;
                    break;
                }
            }

            Lesson::insertGroup($studentId1, $studentId2, $initiatorId, $aptitudes1, $aptitudes2, $courseId);

            $usedStudents[] = $studentId1;
        }

        return redirect('/responsable-formation');
    }


} 