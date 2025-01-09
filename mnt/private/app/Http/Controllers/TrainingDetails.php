<?php
/**
 * Class TrainingDetails
 *
 * This controller handles the display of training details.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\Uti;
use App\Models\Formation;
use App\Models\trainingInf;

Class TrainingDetails extends Controller{
    /**
     * Show the training details page.
     *
     * This method starts a session, checks if the user is logged in, includes the appropriate header and navbar files based on the user's role,
     * retrieves the list of students and initiators for the active formation, and returns the 'trainingdetails' view with the retrieved data.
     *
     * @return \Illuminate\View\View
     */
    public function show(){
        session_start();

        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        include resource_path('includes/header.php');
        if(isset($_SESSION['director'])){ include resource_path('includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ include resource_path('includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ include resource_path('includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ include resource_path('includes/navbar/navbar_student.php'); }
        $students = trainingInf::getStudentByFor($_SESSION['active_formations'][0]->NIV_ID);
        $initiators = trainingInf::getInitiatorByFor($_SESSION['active_formations'][0]->NIV_ID);
        return view('trainingdetails', compact('students'), compact('initiators'));

    }

}
