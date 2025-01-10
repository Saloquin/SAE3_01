<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvGenerator extends Controller
{
    public function generateCsv()
    {
        // Fetch records from the database (Using DB facade for better integration with Laravel)
        $users = DB::table('UTILISATEUR')->get(['UTI_NOM', 'UTI_PRENOM', 'UTI_MAIL', 'NIV_ID']);

        if ($users->isNotEmpty()) {
            // Filename with year
            $filename = "Bilan_" . (date('Y') - 1) . "-" . date('Y') . ".csv";
            
            // Prepare a streamed response to send the CSV directly to the user
            $response = new StreamedResponse(function () use ($users) {
                $handle = fopen('php://output', 'w');
                
                // Set column headers
                fputcsv($handle, ['UTI_NOM', 'UTI_PRENOM', 'UTI_MAIL', 'NIV_ID']);
                
                // Output each row of the data
                foreach ($users as $user) {
                    fputcsv($handle, [(string) $user->UTI_NOM, (string) $user->UTI_PRENOM, (string) $user->UTI_MAIL, (int) $user->NIV_ID]);
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
