<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\Notifications\NovaSugestaoNotification;
use App\Notifications\SugestaoEnviadaNotification;
use App\Notifications\NovoVoluntarioNotification;
use \Illuminate\Notifications\Notifiable;
use Notification;
use App\User;
use App\Sugestao;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->markEmailAsVerified())
            event(new Verified($user));

        $users = User::where('admin', true)->get();
        Notification::send($users, new NovoVoluntarioNotification($user));
        return redirect()->route('site.voluntarios')->with('success', 'Email verificado com sucesso!');
    }

    public function verifySugestao(Request $request)
    {
        $sugestao = Sugestao::find($request->route('id'));

        if (!hash_equals((string) $request->route('hash'), sha1($sugestao->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($sugestao->markEmailAsVerified())
            event(new Verified($sugestao));

        $users = User::where('admin', true)->get();
        Notification::send($users, new NovaSugestaoNotification($sugestao));
        $sugestao->notify(new SugestaoEnviadaNotification($sugestao));

        return redirect()->route('sugestao.adicionar')->with('success', 'Email verificado com sucesso!');
    }
}
