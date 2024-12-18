<?php

namespace App\Http\Controllers\Utilisateurs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\UserToken;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Notifications\User\NewAccount;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function logout()
    {
        if(Auth::check()){
            $user = Auth::user();
            $user->online=false;
            $user->save();
            Auth::logout();
            return redirect(url('/'));
        }
    }

    public function activation(Request $request, $token){
        // dd($request, $request->all(), $request->email, $request['token'], $token);
        $exists = UserToken::where('value', $token)->where('expire_at', '>', Carbon::now())->where('expired',false)->first();

        if(!$exists){
            return redirect()->route('home.page')->with('error', 'Lien est expiré!');
        }

        return view('auth.reset-password', [
            'token' => $exists->value,
            'request' => $request, 
            'email' => $exists->user->email
        ]);
    }

    public function activate(Request $request,$token){
        $data = $request->all();
        $exists = UserToken::where('value',$token)->where('expire_at','>',Carbon::now())->where('expired',false)->first();
        if(!$exists){
            return redirect()->route('home.page')->with('error','Lien est expiré!');
        }

        $exists->user->active = true;
        $exists->user->save();
        $exists->delete();

        return redirect()->route('home.page')->with('success','Compte Vérifié. Vous pouvez vous connecter maintenant');
    }

    public function newToken($id){
        $user =User::findOrFail($id);
        $exists = $user->tokens()->first();
        if($exists){
            $exists->delete();
        }

        $token = $user->tokens()->create([
            'value'=>Str::random(32),
            'expire_at'=>Carbon::now()->add(1, 'hour'),
        ]);
        return redirect()->route('panel.utilisateurs.show',[$user])->with('success','Nouveau Lien créé avec succès!');
    }

    public function setPassword(Request $request){
        $data = $request->except('_token');
        $exists = UserToken::where('value',$data['token'])->where('expire_at','>',Carbon::now())
            ->where('expired',false)->first();

        // dd($data, $exists);

        if(!$exists){
            abort(404);
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            //'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect(route('activation', [$data['token']]))
                ->withErrors($validator)
                ->withInput();
        }

        // dd($exists, $exists->user);

        $user = $exists->user;
        // $user->active = true;
        $user->email_verified_at = Carbon::now();
        $user->password = bcrypt($data['password']);
        $user->save();
        $exists->expired= true;
        $exists->save();

        return redirect()->route('home.page')->with('success', 'Donnés Enregistrées!');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cette adresse e-mail.']);
        }

        $token = Str::random(64);

        UserToken::create([
            'user_id' => $user->id,
            'value' => $token,
            'expire_at' => Carbon::now()->addHours(2),
            'expired' => false
        ]);

        $user->notify(new ResetPasswordNotification($token));

//        Mail::send('emails.forgot-password', ['token' => $token], function($message) use($request){
//            $message->to($request->email);
//            $message->subject('Réinitialisation du mot de passe');
//        });

        return redirect()->route('home.page');
        //return back()->with('status', 'Nous vous avons envoyé par e-mail le lien de réinitialisation du mot de passe !');
    }


    public function showResetForm(Request $request, $token)
    {
        //dd($request->email, $token);
        return view('auth.reset-password-forgot', ['token' => $token, 'email' => $request->email]);
    }


    public function resetPassword(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'token' => 'required',
            // 'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $userToken = UserToken::where('value', $request->token)
            ->where('expire_at', '>', Carbon::now())
            ->where('expired', false)
            ->first();

        // dd($data, $userToken);

        if (!$userToken) {
            return back()->withErrors(['email' => 'Ce lien de réinitialisation n\'est pas valide ou a expiré.']);
        }

        //$user = User::where('email', $request->email)->first();
        $user = User::where("id", $userToken->user_id)->first();

        // dd($userToken->user_id, $data, $userToken, $user);

        if (!$user) {
            return back()->withErrors(['email' => 'Nous ne pouvons pas trouver un utilisateur avec cette adresse e-mail.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $userToken->expired = true;
        $userToken->save();

        //return redirect()->route('login')->with('status', 'Votre mot de passe a été réinitialisé !');
        return redirect()->route('home.page');
    }
}
