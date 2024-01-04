<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
        <title>ユーザー追加</title>
    </head>

    <form method="POST" action="/admin/dashboard/user/create">
        <label for="name">名前</label>
        <input type="text" name="name">
        <span class="text-danger">{{ $errors->first('name') }}</span>
        <br>
        <label for="email">メールアドレス</label>
        <input name="email"/>
        <span class="text-danger">{{ $errors->first('email') }}</span>
        <br>
        <label for="password">パスワード</label>
        <input type="password" name="password"/>
        <span class="text-danger">{{ $errors->first('password') }}</span>
        <br>
        <label for="password_comfirmation">パスワード(確認)</label>
        <input type="password" name="password_confirmation"/>
        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
        <br>
        <button>登録</button>
        <li>
            <a href="{{ url('/admin/dashboard/user') }}" >
                戻る
            </a>
        </li>
        {{csrf_field()}}
    </form>
</html>
