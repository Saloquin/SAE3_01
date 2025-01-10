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
        include resource_path('includes/header.php');

        $clubId = Uti::find(session('id'))->CLU_ID;
        $users = Uti::where('CLU_ID', $clubId)->get();
        return view('usermanagement', compact('users'));
    }

}
