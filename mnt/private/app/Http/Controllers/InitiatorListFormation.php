<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teach;
use App\Models\Formation;
use App\Models\Uti;
use Illuminate\Support\Facades\DB;

Class InitiatorListFormation extends Controller{

    public function show(Request $request)
{
    
    $formation = Formation::findOrFail($request->input('FOR_ID'));

    
    $teach = Teach::with('initiator')->where('FOR_ID', $request->input('FOR_ID'))->get();

   
    $users = $teach->map(function ($teach) {
        return $teach->initiator;
    });

    
    $formationLevel = $formation->level->NIV_ID ?? 0;

    
    $teachIds = $teach->pluck('initiator.UTI_ID');

    
    $usersPossible = Uti::whereNotIn('UTI_ID', $teachIds)
    ->where('UTI_EST_INIT', 1)
        ->where(function ($query) use ($formationLevel) {
            if ($formationLevel == 3) {
                $query->where('NIV_ID', '=', 4);  
            } else {
                $query->where('NIV_ID', '>=', $formationLevel ); 
            }
        })
        ->get();

    return view('initiatorlistformation', compact('users', 'formation', 'usersPossible'));
}



    public function add(Request $request)
    {
        
        $validated = $request->validate([
            'FOR_ID' => 'required|exists:FORMATION,FOR_ID',
            'UTI_ID' => 'required|exists:UTILISATEUR,UTI_ID',
        ]);

        $formation = $request->input('FOR_ID');
        $studentId = $request->input('UTI_ID');
        Teach::create([
            'UTI_ID' => $studentId,
            'FOR_ID' => $formation,
        ]);

        return $this->show($request);
    }

    
    public function remove(Request $request)
{
    
    $validated = $request->validate([
        'FOR_ID' => 'required|exists:FORMATION,FOR_ID',
        'UTI_ID' => 'required|exists:UTILISATEUR,UTI_ID',
    ]);

    $formationId = $validated['FOR_ID'];
    $userId = $validated['UTI_ID'];

    $existingTeach = Teach::where('FOR_ID', $formationId)
            ->where('UTI_ID', $userId)
            ->first();

        if ($existingTeach) {
            return $this->show($request);
        }

    DB::table('initier')
        ->where('FOR_ID', $formationId)
        ->where('UTI_ID', $userId)
        ->delete();


    return $this->show($request);
}

    


}

