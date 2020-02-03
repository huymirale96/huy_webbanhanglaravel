<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AccountAdd;
use App\Jobs\JobAdminAutoReset;
use App\Mail\AdminCreateAccount;
use App\Mail\AdminResetAccount;
use App\Mail\AdminRestoreAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all users
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['accounts'] = $this->user->orderBy('created_at', 'DESC')->get();
        return view('admin.user.list', $data);
    }

    /**
     * get view Create user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createUser()
    {
        return view('admin.user.add');
    }

    /**
     * Create new account
     *
     * @param AccountAdd $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser(AccountAdd $request)
    {
        $this->user->fill($request->all());
        $this->user->token = md5(str_random(50));
        $this->user->token_expire = date('Y-m-d H:i:s', time());
        $this->user->status = config('const.UN_VERIFIED');
        $this->user->save();
        Mail::to($this->user->email)->send(new AdminCreateAccount($this->user));
        return redirect()->route('admin.users')->with('success', 'flash-message.add-account');
    }

    /**
     * Disable an user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableUser(Request $request, User $user)
    {
        $user->status = config('const.OUT');
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Reset password of an user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetUser(Request $request, User $user)
    {
        $user->token = md5(str_random(50));
        $user->token_expire = date('Y-m-d H:i:s', time());
        $user->status = config('const.UN_VERIFIED');
        $user->save();
        Mail::to($user->email)->send(new AdminResetAccount($user));
        return response()->json($user, 200);
    }

    /**
     * Restore an user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreUser(Request $request, User $user)
    {
        $user->token = md5(str_random(50));
        $user->token_expire = date('Y-m-d H:i:s', time());
        $user->status = config('const.UN_VERIFIED');
        $user->save();
        Mail::to($user->email)->send(new AdminRestoreAccount(['user' => $user]));
        return response()->json($user, 200);
    }


}

