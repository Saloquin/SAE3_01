<?php
/**
 * Class Manager
 * 
 * This controller handles the display of the manager's view.
 * It ensures that the user is authenticated and has the appropriate session variables set.
 * Depending on the user's role, it includes the appropriate navigation bar.
 * It retrieves course information for the authenticated user and passes it to the view.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ttModel;

class Manager extends Controller
{
    /**
      * Display the manager's view.
      * 
      * This method starts a session, checks if the user is authenticated, and includes the appropriate navigation bar based on the user's role.
      * It retrieves course information for the authenticated user and passes it to the view.
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

        $tt = ttModel::getCourseById($_SESSION['id']);
        $arr = [];
        $arr2 = [];
        $i = 0;
        foreach ($tt as $row){
            array_push($arr, $row->cou_id);
            array_push($arr, $row->cou_date);

        }
        return view('manager', compact('arr'));
    }
}  