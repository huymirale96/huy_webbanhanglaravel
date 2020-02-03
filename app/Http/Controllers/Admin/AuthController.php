<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\ResetPassword;
use App\Http\Requests\UserChangePassword;
use App\Http\Requests\UserChangeProfile;
use App\Mail\AdminForgotPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => config('const.ACTIVE'),
        ];
        $remember = false;
        if ($request->has('remember')) {
            $remember = true;
        }
        if (Auth::attempt($arr, $remember)) {
            return redirect()->route('admin.home');
        }
        return back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('admin.get_login');
    }

    /**
     * Send request forgot password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendRequestForgotPassword(Request $request)
    {
        $user = $this->user->where('email', $request->email)->first();
        if ($user) {
            return DB::transaction(function () use ($user, $request) {
                try {
                    $user->fill($request->only('token', 'token_expire'));
                    $user->token = md5(time() . str_random(30));
                    $user->token_expire = date('Y-m-d H:i:s', time());
                    Mail::to($user->email)->send(new AdminForgotPassword($user));
                    $user->save();
                    $message[] = trans('flash-message.forgot-password-success');
                    return response()->json(true, 200);
                } catch (\Exception $e) {
                    return response()->json();
                }
            });
        } else {
            $message[] = trans('flash-message.non-exist-email');
            return response()->json(false, 500);
        }
    }

    /**
     * Check token
     *
     * @param null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkToken($token = null)
    {
        $user = $this->user->where('token', $token)->first();
        if (empty($user)) {
            return redirect()->route('admin.get_login')->with('error', trans('flash-message.invalid-token'));
        }
        $expired = Carbon::now()->subHours(24);
        if ($user->token_expire >= $expired) {
            return view('admin.auth.reset_password', ['user' => $user]);
        }
        return redirect()->route('admin.get_login')->with('error', trans('flash-message.invalid-token'));
    }

    /**
     * Reset Password
     *
     * @param ResetPassword $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(ResetPassword $request)
    {
        $user = $this->user->where('token', $request->token)->first();
        if (empty($user)) {
            return redirect()->route('admin.get_login')->with('error', trans('flash-message.invalid-token'));
        }
        $user->password = bcrypt($request->password);
        $user->status = config('const.ACTIVE');
        $user->token = null;
        $user->token_expire = null;
        $user->save();
        return redirect()->route('admin.get_login')->with('success', trans('flash-message.reset_password-success'));
    }

    /**
     * Get user's information
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        $profile = Auth::user();
        return view('admin.auth.profile', $profile);
    }

    /**
     * Change profile
     *
     * @param UserChangeProfile $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(UserChangeProfile $request)
    {
        $user = $this->user->find(Auth::user()->id);
        $cur_avatar = $user->avatar;
        $user->fill($request->only('name', 'avatar'));
        if ($request->has('avatar')) {
            $fileName = md5(time() . $request->avatar->getClientOriginalName()) . '.' . $request->avatar->getClientOriginalExtension();
            $user->avatar = $fileName;
            $request->avatar->storeAs('users', $fileName);
            if ($cur_avatar != null) {
                unlink(storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . $cur_avatar);
            }
        }
        $user->save();
        return back()->with('success', trans('flash-message.change-profile'));
    }

    public function changePassword(UserChangePassword $request)
    {
        $user = $this->user->find(Auth::user()->id);
        if(Hash::check($request->cur_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('admin.get_login')->with('success', trans('flash-message.change-password-success'));
        }
        return back()->with('error', trans('flash-message.change-password-error'));
    }
}
