<?php
/**
 * Class Director
 *
 * This controller handles the operations related to the director's functionalities.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\Uti;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Class Director extends Controller{
    /**
     * Display the director's dashboard.
    *
    * This method checks the session for user authentication and displays the appropriate navbar based on the user's role.
    * It retrieves the formations and initiates for the logged-in director and returns the view with the necessary data.
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
        $me = Uti::find($_SESSION["id"]);

        $formations = Formation::where('CLU_ID', $clubId)
            ->whereRaw('DATEDIFF(SYSDATE(), FOR_ANNEE) BETWEEN 0 AND 365.25')
            ->get();
        $init = Uti::whereNotIn('UTI_ID', $formations->pluck('UTI_ID'))->where('UTI_EST_INIT', 1)->get();

        return view('director', compact('formations' ,'clubId','init','me'));
    }
    /**
     * Edit the responsible person for a formation.
    *
    * This method validates the request data, updates the responsible person for the specified formation, and redirects to the director's dashboard.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function editResponsable(Request $request){
        $request->validate([
            'formation' => 'required|exists:formation,FOR_ID',
            'responsable' => 'required|exists:utilisateur,UTI_ID',
        ]);

        $formation = Formation::find($request->formation);
        $formation->UTI_ID = $request->responsable;
        $formation->save();
        return redirect()->route('directeur');
    }
    /**
  * Delete a formation.
  *
  * This method validates the request data, deletes the specified formation and its related records from the database, and redirects to the director's dashboard.
  *
  * @param \Illuminate\Http\Request $request
  * @return \Illuminate\Http\RedirectResponse
  */
    public function delete(Request $request){
        $validated = $request->validate([
            'FOR_ID' => 'required|exists:formation,FOR_ID',
        ]);

        $formationId = $validated['FOR_ID'];

        DB::table('formation')
            ->where('FOR_ID', $formationId)
            ->delete();
            return redirect()->route('directeur');
    }

}




 
 

 
 