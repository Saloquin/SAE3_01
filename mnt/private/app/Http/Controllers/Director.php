<?php
/**
 * Class Director
 *
 * This controller handles the operations related to the director's functionalities.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use App\Models\Uti;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

Class Director extends Controller{
    /**
     * Display the director's dashboard.
    *
    * This method checks the session for user authentication and displays the appropriate navbar based on the user's role.
    * It retrieves the formations and initiates for the logged-in director and returns the view with the necessary data.
    *
    * @return \Illuminate\View\View
    */
    public function show(){

        include resource_path('includes/header.php');
        
        session()->put('id', 1);
        $clubId = Uti::find(session('id'))->CLU_ID;
        $me = Uti::find(session('id'));

        $formations = Formation::where('CLU_ID', $clubId)
            ->whereRaw('DATEDIFF(SYSDATE(), FOR_ANNEE) BETWEEN 0 AND 365.25')
            ->get();
        $init = Uti::whereNotIn('UTI_ID', $formations->pluck('UTI_ID'))->where('UTI_EST_INIT', 1)->get();

        return view('director', compact('formations' ,'clubId','init','me'));
    }
    /**
     * Edit the responsible person for a formation.
    *
    * This method validates the request data, updates the responsible person for the specified formation, and redirects to the director's dashboard.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function editResponsable(Request $request){
        $validated=$request->validate([
            'formation' => 'required|exists:formation,FOR_ID',
            'responsable' => 'required|exists:utilisateur,UTI_ID',
        ]);
        $formation = Formation::find($request->formation);
        $formation->UTI_ID = $request->responsable;
        $formation->save();
        return redirect()->route('directeur');
    }
    /**
  * Delete a formation.
  *
  * This method validates the request data, deletes the specified formation and its related records from the database, and redirects to the director's dashboard.
  *
  * @param \Illuminate\Http\Request $request
  * @return \Illuminate\Http\RedirectResponse
  */
    public function delete(Request $request){
        $validated = $request->validate([
            'FOR_ID' => 'required|exists:formation,FOR_ID',
        ]);

        $formationId = $validated['FOR_ID'];

        DB::table('apprendre')
            ->where('FOR_ID', $formationId)
            ->delete();

        DB::table('initier')
            ->where('FOR_ID', $formationId)
            ->delete();

        DB::table('formation')
            ->where('FOR_ID', $formationId)
            ->delete();
            return redirect()->route('directeur');
    }
    /**
  * Delete a formation.
  *
  * This method return a csv file containing data about users in a club for a year from the database. 
  *
  * @return \Illuminate\Http\StreamedResponse
  */
    public function generateCsv()
    {
        // Fetch records from the database (Using DB facade for better integration with Laravel)
        $cluID = Uti::find(session('id'))->CLU_ID;
        $users = DB::table('utilisateur')->where("CLU_ID","=", $cluID)->get(['UTI_NOM', 'UTI_PRENOM', 'UTI_MAIL', 'NIV_ID']);

        if ($users->isNotEmpty()) {
            // Filename with year
            $filename = "Bilan_" . (date('Y') - 1) . "-" . date('Y') . ".csv";
            
            // Prepare a streamed response to send the CSV directly to the user
            $response = new StreamedResponse(function () use ($users) {
                $handle = fopen('php://output', 'w');
                
                // Set column headers
                fputcsv($handle, ['UTI_NOM', 'UTI_PRENOM', 'UTI_MAIL', 'NIV_ID'], ';');
                
                // Output each row of the data
                foreach ($users as $user) {
                    fputcsv($handle, [(string) $user->UTI_NOM, (string) $user->UTI_PRENOM, (string) $user->UTI_MAIL, (int) $user->NIV_ID], ';');
                }

                fclose($handle);
            }, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);

            return $response;
        }
        
        return response()->json(['message' => 'No data found to export.'], 404);
    }

}




 
 

 
 