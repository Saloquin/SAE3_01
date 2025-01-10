<?php
/**
 * Class TraineeList
 *
 * This controller handles the display of the trainee list page.
 * It ensures that the user is authenticated and includes the appropriate
 * navigation bar based on the user's role.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

Class TraineeList extends Controller{
    /**
     * Display the trainee list page.
     *
     * This method starts a session, checks if the user is authenticated,
     * and includes the appropriate navigation bar based on the user's role.
     * If the user is not authenticated, they are redirected to the login page.
     *
     * @return \Illuminate\View\View
     */
    public function show(){
        

        

        include resource_path('includes/header.php');
        

        return view('traineelist');
    }

}
