<?php
/**
 * Connexion Controller
 *
 * This controller handles user authentication and redirection based on user roles.
 * It includes methods for showing the login page, handling login requests, and password recovery.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\UserCreatedMail;
use App\Mail\UserPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Uti;

class Connexion extends Controller
{
    /**
     * Show the login page.
     *
     * This method starts a session, unsets any existing session variables, and checks if the user is already logged in.
     * If the user is a superadmin, they are redirected to the superadmin page.
     * Otherwise, the user is redirected based on their role.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('connexion');
    }
   
    /**
     * Handle the login request.
     *
     * This method starts a session and validates the login credentials.
     * If the credentials are valid, the user is redirected based on their role.
     * If the credentials are invalid, an error message is displayed.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function login(Request $request)
    {
        //

        $licence = $request->input('licence');
        $password = $request->input('password');
        if (isset($licence) && isset($password)) {

            $res = DB::select('select * from utilisateur where uti_licence = ? and uti_mdp = ?', [$licence, md5($password)]);
            if ($licence == "A-00-000000") {
                session(['superadmin' => true]);
                session(['id' => $res[0]->UTI_ID]);
                return redirect()->route('superadmin.addcomp');
            }
            if (isset($res[0])) {
                session(['active_formations' => DB::select('select * from formation where clu_id = ? and datediff(sysdate(), for_annee) between 0 and 365.25', [$res[0]->CLU_ID])]);
                session(['id' => $res[0]->UTI_ID]);
                if (DB::select('select count(*) as nb from club where uti_id = ?', [session('id')])[0]->nb) {

                    session(['director' => true]);
                    //dd(session()->all());
                    return redirect()->route('directeur');
                }
                foreach (session('active_formations') as $formation) {
                    if ($formation->UTI_ID == session('id')) {
                        session(['manager' => true]);
                        session(['formation_level' => $formation->NIV_ID]);
                        return redirect()->route('responsable');
                        // redirect to training manageur home
                    }

                    $res = DB::select('select count(*) as nb from initier where for_id = ? and uti_id = ?', [$formation->FOR_ID, session('id')]);
                    if ($res[0]->nb) {
                        session(['teacher' => true]);
                        return redirect()->route('initiateur');
                        // redirect to initiator home
                    }
                    $res = DB::select('select count(*) as nb from apprendre where for_id = ? and uti_id = ?', [$formation->FOR_ID, session('id')]);
                    if ($res[0]->nb) {
                        session(['student' => true]);
                        return redirect()->route('eleve');
                        // redirect to student home
                    }
                }
                // renvoyer vers page pas de formation
                echo 'pas de formation';
                exit;
            }
            // remettre page co avec msg d'erreur pas de compte
            echo 'pas de compte';
            exit;
        }
        // remettre page avec msg d'erreur pas rempli
        echo 'pas rempli';
        exit;
    }

    /**
     * Handle password recovery.
     *
     * This method validates the email input and checks if the user exists.
     * If the user exists, a new password is generated and sent to the user's email.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recupMdp(Request $request)
    {


        $validated = $request->validate([
            'email' => 'required|email',
        ]);


        $user = Uti::where('UTI_MAIL', $validated['email']);

        if ($user) {
            $password = Str::random(16);
            $user->update([
                'UTI_MDP' => md5($password),
            ]);
            Mail::to($validated['email'])->send(new UserPasswordMail([
                'name' => $user->first()->UTI_PRENOM . ' ' . $user->first()->UTI_NOM,
                'email' => $user->first()->UTI_MAIL,
                'password' => $password,
                'licence' => $user->first()->UTI_LICENCE,
            ]));
        }

        return redirect()->back()->with('status', 'If your email is in our system, you will receive a password reset link.');
    }

}











