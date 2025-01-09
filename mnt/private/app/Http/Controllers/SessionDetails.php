<?php
/**
 * Class SessionDetails
 *
 * This controller handles the display of session details.
 * It ensures that the user is authenticated and includes the appropriate navbar based on the user's role.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

Class SessionDetails extends Controller{
    /**
     * Show the session details page.
     *
     * This method starts the session, checks if the user is authenticated,
     * includes the appropriate navbar based on the user's role, and returns the session details view.
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


        return view('sessiondetails');
    }

}
