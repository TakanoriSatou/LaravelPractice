<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
        <title>ユーザー編集</title>
    </head>

    <form method="POST" action="/admin/dashboard/user/update/{{$user->id}}">
        <label for="name">名前</label>
        <input type="text" name="name" value="{{$user->name}}">
        <br>
        <label for="email">メールアドレス</label>
        <input type="text" name="email" value="{{$user->email}}"/>
        <br>
        <button>更新</button>
        <li>
            <a href="{{ url('/admin/dashboard/user') }}" >
                戻る
            </a>
        </li>
        {{csrf_field()}}
    </form>
</html>
