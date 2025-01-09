<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uti;

Class EditProfile extends Controller{

    public function show()
    {
        session_start();
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
            'password' => md5($validated['password1']),
        ]);
        return redirect('profile');
    }


}
