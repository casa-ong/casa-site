<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Notifications\SenhaAlteradaComSucessoNotification;
use Validator;
use DB;
use Hash;
use Auth;
use App\Models\User;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function reset(Request $request) 
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/|confirmed',
        ], [
            'email.required' => 'O campo de email é obrigatório',
            'email.email' => 'Digite um endereço de email válido',
            'email.unique' => 'O email digitado já foi cadastrado',
            'password.required' => 'O campo de senha é obrigatório',
            'password.regex' => 'Senha deve conter ao menos uma letra e um número e no mínimo 8 digitos, não é permitido caracteres especiais',
            'password.confirmed' => 'As senhas não conferem',
        ]);

        //check if input is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $password = $request->password;// Validate the token
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();
        
        // Redirect the user back if the email is invalid
        if(!$tokenData) {
            return redirect()->back()->withErrors(['email' => 'Email não encontrado']);//Hash and update the new password
        }

        // Redirect the user back to the password reset request form if the token is invalid
        if (!Hash::check($request->token, $tokenData->token)) {
            return redirect()->route('password.request')->withErrors(['email' => 'Token inválido, faça uma nova solicitação']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = \Hash::make($password);
        $user->update();

        // //login the user immediately they change password successfully
        // Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
        ->delete();

        //Send Email Reset Success Email
        $this->sendSuccessEmail($user);

        return redirect()->route('login')->with('success', 'Senha recuperada com sucesso');
    }

    public function sendSuccessEmail(User $user) 
    {
        $user->notify(new SenhaAlteradaComSucessoNotification($user));
    }
}
