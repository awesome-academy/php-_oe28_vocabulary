<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendMailToResetPassword;
use Exception;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('home');
    }
    
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);
       
        return back();
    }

    public function sendResetPasswordLink(Request $request)
    {
        DB::beginTransaction();
        try {
            $token = Str::random(8);
            $hashedToken = sha1($token); 
            $user = $this->userRepo->findUser('email', $request->email);
            $this->userRepo->update($user->id, ['reset_pwd_token' => $hashedToken]);
            $data = [
                'token' => $token,
                'userId' => $user->id
            ];
            dispatch(new SendMailToResetPassword($data, $request->email));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('password.request')->with('status', true);
        }

        return redirect()->route('login')->with('status', true);
    }

    public function newPassword(Request $request)
    {
        $userId = $request->route('userId');

        return view('new_password', compact('userId'));
    }

    public function resetPassword(Request $request)
    {
        $pwd = $request->password;
        $pwdConfirmation = $request->password_confirmation;
        if ($pwd != $pwdConfirmation) {
            return back()->with('message', true);
        }
        else {
            $userId = $request->route('userId');
            $this->userRepo->update(
                $userId,
                [
                    'password' => Hash::make($pwd),
                    'reset_pwd_token' => null
                ]
            );

            return redirect()->route('login')->with('message', true);
        }
    }
}
