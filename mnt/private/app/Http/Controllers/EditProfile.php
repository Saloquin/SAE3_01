<?php
/**
 * Class EditProfile
 * 
 * Controller for handling user profile editing.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uti;

Class EditProfile extends Controller{
    /**
      * Display the edit profile page.
      * 
      * This method starts a session, includes the appropriate navbar based on the user's role,
      * retrieves the user's information from the database, and returns the edit profile view.
      * 
      * @return \Illuminate\View\View
      */
    public function show()
    {
        session_start();
        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }
        $user = Uti::find($_SESSION["id"]);
        return view('editprofile', compact('user'));
    }
    /**
      * Handle the profile edit request.
      * 
      * This method validates the request data, checks if the passwords match, updates the user's
      * email and password in the database, and redirects to the profile page.
      * 
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\Http\RedirectResponse
      */
    public function edit(Request $request)
    {
        
        $validated = $request->validate([
            'UTI_MAIL' => 'required|email|max:255',
            'password1' => 'required',
            'password2' => 'required',
            'UTI_ID' => 'required|integer',
        ]);

        if ($validated['password1'] != $validated['password2']) {
            return $this->show();
        }

        $user = Uti::find($request->input('UTI_ID'));
        $user->update([
            'UTI_MAIL' => $validated['UTI_MAIL'],
            'UTI_MDP' => md5($validated['password1']),
        ]);
        return redirect('profile');
    }


}