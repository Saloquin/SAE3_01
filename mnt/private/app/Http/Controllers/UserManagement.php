<?php
/**
 * Class UserManagement
 *
 * This controller handles the user management functionalities.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\Uti;
Class UserManagement extends Controller{
    /**
     * Display the user management view.
     *
     * This method starts a session, checks if the user is logged in, includes the appropriate navbar based on the user's role,
     * retrieves the users associated with the same club as the logged-in user, and returns the user management view.
     *
     * @return \Illuminate\View\View
     */
    public function show(){
        session_start();

        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $users = Uti::where('CLU_ID', $clubId)->get();
        return view('usermanagement', compact('users'));
    }

}
