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
        
        include resource_path('includes/header.php');
        
        $me=Uti::find(session('id'));
        //var_dump(Uti::getInitiatorById(2));
        $tt = ttModel::getSessionStudentById(session('id'));
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
