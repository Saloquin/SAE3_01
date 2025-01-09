<?php
/**
 * Class Initiator
 *
 * This controller handles the display of the initiator's session data.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\ttModel;
use Illuminate\Support\Facades\DB;
use App\Models\Uti;
use Illuminate\Http\Request;


class Initiator extends Controller
{
    /**
      * Show the initiator's session data.
      *
      * This function starts a session, checks if the user is logged in, and then
      * includes the appropriate navbar based on the user's role. It retrieves the
      * session data for the initiator and prepares it for display in the view.
      *
      * @return \Illuminate\View\View The view displaying the initiator's session data.
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

        //var_dump(Uti::getInitiatorById(2));
        $tt = ttModel::getSessionInitiatorById($_SESSION['id']);
        $arr = [];
        $arr2 = [];
        $i = 0;
        foreach ($tt as $row){
            array_push($arr2, []);
            array_push($arr, $row->cou_date);
            array_push($arr2[$i], $row->cou_date);
            array_push($arr2[$i], $row->uti_id_elv1);
            array_push($arr2[$i], $row->uti_id_elv2);
            array_push($arr2[$i], $row->uti_nom);
            array_push($arr2[$i], $row->uti_prenom);
            array_push($arr2[$i], $row->uti_nom2);
            array_push($arr2[$i], $row->uti_prenom2);
            array_push($arr2[$i], $row->niv);
            array_push($arr2[$i], $row->cou_id);
            $i += 1;
        }
        return view('initiator', compact('arr'), compact('arr2'));
    }

}
