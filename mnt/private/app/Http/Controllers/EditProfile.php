<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uti;

Class EditProfile extends Controller{

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
