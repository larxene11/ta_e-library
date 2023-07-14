<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function allStudent()
    {
        $data = [
           'title' => 'Data Siswa | E-Library SMANDUTA',
           'users' => User::where('level', 'siswa')->latest()->paginate(10)->withQueryString(),
        ];
        return view('admin.siswa.siswa-all', $data);
    }

    public function requestEmail()
    {
        $data = [
           'title' => 'Reset Password | E-Library SMANDUTA'
        ];
        return view('auth.request-email', $data);
    }
    
    public function checkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    
    public function resetPassword(string $token)
    {
        $data = [
           'title' => 'Reset Password | E-Library SMANDUTA',
           'token' => $token
        ];
        return view('auth.forgot-password', $data);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirm', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    // public function allPegawai()
    // {
    //     $data = [
    //        'title' => 'Data Pegawai | E-Library SMANDUTA',
    //        'users' => User::where('level', 'pegawai')->latest()->paginate(10)->withQueryString(),
    //     ];
    //     return view('admin.siswa.siswa-all', $data);
    // }

    public function login()
    {
        $data = [
            'title' => 'Login | E-Library SMANDUTA'
        ];
        return view('auth.login', $data);
    }
    public function register()
    {
        $data = [
            'title' => 'Register | E-Library SMANDUTA'
        ];
        return view('auth.register', $data);
    }
    public function attemptLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'There Is Something Wrong! Please Try Again');
        }
        $validated = $validator->validate();
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            // dd(Auth::user());
            if (Auth::user()->level == 'siswa') {
                return redirect()->route('main');
            }else{
                // dd('yes');
                return redirect()->intended('/dashboard')->with('success', 'Login Success! <br> Welcome ' . auth()->user()->name);
            }
            
        }
        return redirect()->back()->with('error', 'Login Failed! <br> Please Try Again');
    }
    public function attemptRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:8|max:50',
            'email' => 'required|email:dns',
            'nis_nip' => 'required|integer',
            'alamat' => 'required|string',
            'tlp' => 'required|numeric',
            'jurusan_jabatan' => 'required|string',
            'password' => 'required|string',
            'password_confirm' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'OOPS! <br> An Error Occurred During Registration!');
        }
        $validated = $validator->validate();
        $user_is_created = User::create([
            'name' => $validated['name'],
            'nis_nip' => $validated['nis_nip'],
            'email' => $validated['email'],
            'tlp' => $validated['tlp'],
            'alamat' => $validated['alamat'],
            'jurusan_jabatan' => $validated['jurusan_jabatan'],
            'password' => Hash::make($validated['password']),
        ]);
        if ($user_is_created) {
            if ($request->redirect_login) {
                if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
                    return redirect()->route('auth')->with('success', 'Login Success! <br> Welcome ' . auth()->user()->name);
                }
                return redirect()->route('login')->with('error', 'Otomatic Login Failed! <br> Try Login using Manual Method!');
            }
            return redirect()->route('login')->with('success', 'New Account Created! <br> Please Login Using Your New Account');
        }
        redirect()->route('login')->with('error', 'Register Failed! <br> Please Try Again Later!');
    }
    public function logout()
    {
        Session::flush();
        session()->invalidate();
        Auth::logout();
        return redirect()->route('login')->with('success', 'You Has Been Logged Out!')->withCookie(Cookie::forget('eksklusif_specials_token'));
    }
    public function detailProfile(User $user)
    {
        $data = [
            'title' => 'Update Profile | E-Library SMANDUTA',
            'user' => $user->where('nis_nip', auth()->user()->nis_nip)->first()
        ];
        return view('auth.profile', $data);
    }
    public function updateProfile(User $user)
    {
        $data = [
            'title' => 'Update Profile | E-Library SMANDUTA',
            'user' => $user->where('nis_nip', auth()->user()->nis_nip)->first()
        ];
        return view('auth.profile-update', $data);
    }

    public function patchProfile(Request $request, User $user)
    {
        if ($request->email != $user->email) {
            if (User::where('email', $user->email)->whereNot('nis_nip', $user->nis_nip)->count()) {
                return redirect()->back()->withInput()->with('error', 'This Email Has Been Used, Please Input Another Email');
            } else {
                $email_validator = Validator::make($request->all(), [
                    'email' => 'required|unique:users,email|email:dns',
                ]);

                if ($email_validator->fails()) {
                    return redirect()->back()->withErrors($email_validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
                }

                $validated_email = $email_validator->validate();
                $user->update(['email' => $validated_email['email']]);
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'nis_nip' => 'required|integer',
            'alamat' => 'required|string',
            'tlp' => 'required|numeric',
            'jurusan_jabatan' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
        }
        $validated = $validator->validate();
        $updated_profile = $user->update([
            'name' => $validated['name'],
            'nis_nip' => $validated['nis_nip'],
            'tlp' => $validated['tlp'],
            'alamat' => $validated['alamat'],
            'jurusan_jabatan' => $validated['jurusan_jabatan'],
        ]);
        if ($updated_profile) {
            return redirect()->route('profile.update', ['user' => auth()->user()])->with('success', 'Your Account Successfully Updated');
        }
        redirect()->route('login')->with('error', 'Update Proccess Failed! <br> Please Try Again Later!');
    }
    public function deleteUser(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('manage_student.all')->with('success', 'User @' . $user->name . ' Successfully Deleted');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
}