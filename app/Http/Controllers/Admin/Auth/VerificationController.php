<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user('admin')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('admin.auth.verify');
    }

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user('admin')->getKey()) {
            //dd($request->route('id'), $request->user('admin'));
            throw new AuthorizationException;
        }

        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('admin')->markEmailAsVerified()) {
            event(new Verified($request->user('admin')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    public function resend(Request $request)
    {
        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('admin')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
