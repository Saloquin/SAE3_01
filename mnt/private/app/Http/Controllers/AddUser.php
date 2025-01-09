<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Uti;
use App\Models\Level;
use App\Mail\UserCreatedMail;
use Illuminate\Support\Facades\Mail;

Class AddUser extends Controller{

    public function show()
    {
        session_start();

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $levels = Level::whereNotNull('NIV_DESCRIPTION')->get();
        return view('adduser', compact('clubId','levels'));
    }



    public function insertUser(Request $request)
    {

        $validated = $request->validate([
            'UTI_NOM' => 'required|string|max:255',
            'UTI_PRENOM' => 'required|string|max:255',
            'UTI_MAIL' => 'required|email|unique:utilisateur,UTI_MAIL|max:255',
            'lvl' => 'required|exists:niveau,NIV_ID',
            'init' => 'required|boolean',
            'UTI_DATE_NAISSANCE' => 'required|date',
            'UTI_DATE_CERTIFICAT' => 'required|date',
            'UTI_CODE_POSTAL' => 'required|string',
            'UTI_VILLE' => 'required|string',
            'UTI_RUE' => 'required|string',
            'clubId' => 'required|exists:club,CLU_ID',
        ]);

        if ($validated['lvl'] < 2 && $validated['init'] == 1) {
            return redirect()->route('directeur.ajouter-utilisateur')->with('failed', "L'utilisateur ne peut pas être un initiateur si son niveau est inférieur à 2.");

        }

        if (!ctype_digit($validated['UTI_CODE_POSTAL'])) {
            return redirect()->route('directeur.ajouter-utilisateur')->with('failed', "Le code postal doit contenir uniquement des chiffres.");
        }

        do {
            $license = 'A' .'-'. rand(10, 99) .'-'. rand(100000, 999999);
        } while (Uti::where('UTI_LICENCE', $license)->exists());



        $password = Str::random(16);

        Uti::create([
            'UTI_NOM' => $validated['UTI_NOM'],
            'UTI_PRENOM' => $validated['UTI_PRENOM'],
            'UTI_MAIL' => $validated['UTI_MAIL'],
            'NIV_ID' => $validated['lvl'],
            'UTI_EST_INIT' => $validated['init'],
            'CLU_ID' => $validated['clubId'],
            'UTI_MDP' => md5($password),
            'UTI_DATE_NAISS' => $validated['UTI_DATE_NAISSANCE'],
            'UTI_DATE_CERTIF' => $validated['UTI_DATE_CERTIFICAT'],
            'UTI_CP' => $validated['UTI_CODE_POSTAL'],
            'UTI_VILLE' => $validated['UTI_VILLE'],
            'UTI_RUE' => $validated['UTI_RUE'],
            'UTI_LICENCE' => $license,
        ]);

       Mail::to($validated['UTI_MAIL'])->send(new UserCreatedMail([
            'name' => $validated['UTI_PRENOM'] . ' ' . $validated['UTI_NOM'],
            'email' => $validated['UTI_MAIL'],
            'password' => $password,
        ]));

        return redirect()->route('directeur.ajouter-utilisateur')->with('success', "L'utilisateur a été créé.");
    }

}
