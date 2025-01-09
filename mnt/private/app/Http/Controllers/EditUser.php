<?php
/**
 * Class EditUser
 * 
 * Controller for editing user information.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\Uti;
use Illuminate\Http\Request;
use App\Models\Level;

Class EditUser extends Controller{
    /**
     * Display the edit user form.
     * 
     * This method checks if the user is authenticated and has the necessary session variables.
     * It then loads the appropriate navbar based on the user's role and retrieves the user and level data.
     * 
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\View\View The view for editing the user.
     */
    public function show(Request $request){
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
        $user = Uti::find($request->input('UTI_ID'));
        $levels = Level::whereNotNull('NIV_DESCRIPTION')->get();
        return view('edituser', compact('user','levels'));
    }
    /**
     * Handle the edit user form submission.
     * 
     * This method validates the input data, checks for specific conditions, and updates the user information in the database.
     * If validation fails or certain conditions are not met, it redirects back to the edit form.
     * 
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse The response after processing the form.
     */
    public function edit(Request $request){
        $validated = $request->validate([
            'UTI_NOM' => 'required|string|max:255',
            'UTI_PRENOM' => 'required|string|max:255',
            'UTI_MAIL' => 'required|email|max:255',  
            'lvl' => 'required|exists:niveau,NIV_ID',  
            'init' => 'required|boolean',  
            'UTI_DATE_NAISSANCE' => 'required|date',
            'UTI_DATE_CERTIFICAT' => 'required|date',
            'UTI_CODE_POSTAL' => 'required|string',
            'UTI_VILLE' => 'required|string',
            'UTI_RUE' => 'required|string',
        ]);
        
        if ($validated['lvl'] < 2 && $validated['init'] == 1) {
            return $this->show($request);
        }
        
        if (!ctype_digit($validated['UTI_CODE_POSTAL'])) {
            return $this->show($request);
        }
        
        if (Uti::where('UTI_MAIL', $validated['UTI_MAIL'])->where('UTI_ID', '!=', $request->input('UTI_ID'))->exists()) {
            return $this->show($request);
        }
        
        $user = Uti::find($request->input('UTI_ID'));
        $user->update([
            'UTI_NOM' => $validated['UTI_NOM'],
            'UTI_PRENOM' => $validated['UTI_PRENOM'],
            'UTI_MAIL' => $validated['UTI_MAIL'],
            'NIV_ID' => $validated['lvl'],
            'UTI_DATE_NAISS' => $validated['UTI_DATE_NAISSANCE'],
            'UTI_DATE_CERTIF' => $validated['UTI_DATE_CERTIFICAT'],
            'UTI_CP' => $validated['UTI_CODE_POSTAL'],
            'UTI_VILLE' => $validated['UTI_VILLE'],
            'UTI_RUE' => $validated['UTI_RUE'],
        ]);

        return redirect()->route('directeur.gestion-utilisateur');

    }

}



    

    