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
        


        include resource_path('includes/header.php');
        


        return view('sessiondetails');
    }

}
