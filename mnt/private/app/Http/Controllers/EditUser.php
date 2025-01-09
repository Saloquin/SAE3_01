<?php

namespace App\Http\Controllers;

use App\Models\Uti;
use Illuminate\Http\Request;
use App\Models\Level;

Class EditUser extends Controller{

    public function show(Request $request){
        $user = Uti::find($request->input('UTI_ID'));
        $levels = Level::whereNotNull('NIV_DESCRIPTION')->get();
        return view('edituser', compact('user','levels'));
    }

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
        ]);

        return redirect()->route('directeur.gestion-utilisateur');
    }

    public function archive(Request $request){
        $user = Uti::find($request->input('UTI_ID'));
        $user->update([
            'UTI_DATE_ARCHIVAGE' => now(),
        ]);
        return redirect()->route('directeur.gestion-utilisateur');
    }


}