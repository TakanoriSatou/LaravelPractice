<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * ユーザー情報を全件取得し、
     * 管理画面を表示
     *
     * @return void
     */
    public function index() {
        $users = User::all();
        return view('userInfo', compact('users'));
    }

    /**
     * ユーザー追加画面を表示
     *
     * @return void
     */
    public function add() {
        return view('userAdd');
    }

    /**
     * ユーザー追加を実施
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        \Log::info('added user '.$user->name.' by '.auth()->user()->name);

        return redirect('/admin/dashboard/user');
    }

    /**
     * ユーザー編集画面を表示
     *
     * @param User $user
     * @return void
     */
    public function edit(User $user) {
        return view('userEdit', compact('user'));
    }

    /**
     * ユーザー編集/削除を実施
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user) {

        // 削除ボタンが押下された場合
        if (isset($_POST['delete'])) {
            $user->delete();
            \Log::info('deleted '.$user->name.' by '.auth()->user()->name);
            return redirect('/admin/dashboard/user');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        \Log::info('updated '.$user->name.' by '.auth()->user()->name);

        return redirect('/admin/dashboard/user');
    }
}
