<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 管理者登録フォームを表示
     *
     * @param Request $request
     * @return void
     */
    public function adminRegisterForm(Request $request)
    {
        return view('adminRegister');
    }

    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\AdminUser'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'admin_level' => ['required', 'numeric'],
        ]);
    }

    protected function adminRegisterDatabase(array $data)
    {
        return AdminUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'admin_level' => $data['admin_level'],
        ]);
    }

    public function adminRegister(Request $request)
    {
        $this->adminValidator($request->all())->validate();

        $user = $this->adminRegisterDatabase($request->all());

        if ($user) {
            return view('adminRegister', ['registered' => true, 'registered_email' => $user->email]);
        }
    }
}
