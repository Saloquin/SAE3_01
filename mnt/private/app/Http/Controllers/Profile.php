<?php
/**
 * Class Profile
 *
 * This controller handles the profile-related actions for the application.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\Uti;

Class Profile extends Controller{
    /**
     * Show the profile page for the logged-in user.
     *
     * This method starts a session, checks if the user is logged in by verifying the session ID,
     * and redirects to the login page if the user is not authenticated. It then retrieves the user
     * information from the database using the session ID and includes the appropriate navbar based
     * on the user's role. Finally, it returns the profile view with the user data.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(){
        session_start();


        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }


        $user = Uti::find($_SESSION["id"]);

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        return view('profile', compact('user'));
    }
    /**
     * Log out the current user.
     *
     * This method starts a session, destroys it to log out the user, and redirects to the home page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        session_start();
        session_destroy();
        return redirect('');

    }

}