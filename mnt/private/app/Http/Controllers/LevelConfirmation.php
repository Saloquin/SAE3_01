<?php
/**
 * Class LevelConfirmation
 * 
 * This controller handles the level confirmation process for different user roles.
 * It includes methods to show the level confirmation page and accept a level confirmation request.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\LevelConf;
use Illuminate\Http\Request;

Class LevelConfirmation extends Controller{


    /**
    * Show the level confirmation page.
    * 
    * This method starts a session, checks if the user is logged in, and includes the appropriate navbar
    * based on the user's role. It then retrieves the student confirmation data and returns the view.
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
        
        
        $rq = LevelConf::getStudentConf();
        

        return view('levelconfirmation', compact('rq'));
    }
    
    /**
     * Accept a level confirmation request.
    * 
    * This method accepts a level confirmation request by ID and then shows the updated level confirmation page.
    * 
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\View\View
    */
    public function accept(Request $request){
        $id = $request->input('id');
        LevelConf::acceptForm($id);
        return $this->show();
    }

}
