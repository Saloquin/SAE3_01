<?php
/**
 * Class Trainee
 * 
 * This controller handles the display of trainee information.
 * It ensures that the user is authenticated and has the appropriate session data.
 * Depending on the user's role, it includes the appropriate navigation bar.
 * It retrieves the trainee's session data and passes it to the view.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ttModel;
use App\Models\Uti;

class Trainee extends Controller
{
    /**
     * Display the trainee information.
     * 
     * This function starts a session and checks if the user is authenticated.
     * If not, it redirects to the login page. It includes the appropriate
     * navigation bar based on the user's role. It retrieves the trainee's
     * session data and passes it to the view.
     * 
     * @return \Illuminate\View\View
     */
    function show(){
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
        $me=Uti::find($_SESSION['id']);
        //var_dump(Uti::getInitiatorById(2));
        $tt = ttModel::getSessionStudentById($_SESSION['id']);
        $arr = [];
        foreach ($tt as $row){
            array_push($arr, $row->apt_libelle);
            array_push($arr, $row->cou_date);
            array_push($arr, $row->uti_nom);
            array_push($arr, $row->uti_prenom);
            array_push($arr, $row->mai_progress);
        }
        // var_dump($tt);
        return view('trainee', compact('arr','me'));
    }
}
