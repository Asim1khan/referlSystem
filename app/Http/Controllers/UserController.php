<?php

namespace App\Http\Controllers;

use App\Models\Newtwork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function StoreRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|string|email|max:25|unique:users',

        ]);
        $referallcode = Str::random(10);
        if (isset($request->referal_code)) {
            $userDatata = User::where('referral_code', $request->referal_code)->get();
            if (count($userDatata) > 0) {
                $user_id = User::insertGetId([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'referral_code' => $referallcode,
                ]);
                Newtwork::insert([
                    'referral_code' => $request->referal_code,
                    'user_id' => $user_id,
                    'parent_user_id' => $userDatata[0]['id'],
                ]);
                return redirect()->back()->with('success', 'You are Register With Referal Code');
            } else {
                return redirect()->back()->with("error", " Please Enter Corect Referl Code");
            }
        } else {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'referral_code' => $referallcode,
            ]);
            $domain = URL::to('/');
            $url = $domain . '/referl-register?ref=' . $referallcode;
            $data['url'] = $url;
            $data["name"] = $request->name;
            $data["email"] = $request->email;
            $data["password"] = $request->password;
            $data["title"] = 'Register';
            Mail::send(
                'email.register_mail',
                ['data' => $data],
                function ($message) use ($data) {
                    $message->to($data['email'])->subject($data["title"]);
                }
            );
            return redirect()->back()->with('success', 'You are Refister');
        }
    }

    public function loadReferralRegister(Request $request)
    {

        if (isset($request->ref)) {
            $referal = $request->ref;
            $userData = User::where('referral_code', $referal)->get();
            if (count($userData) > 0) {
                return view('referalRegister', compact('referal'));
            } else {
                return view('404');
            }
        }
        else{
            return redirect('/wellcom');
        }
    }
}
