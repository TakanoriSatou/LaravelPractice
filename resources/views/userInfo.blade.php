<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Info') }}
        </h2>
        <title>ユーザー管理</title>
    </head>
    <table>
        <thead>
            <tr>
                <td>名前</td>
                <td>メールアドレス</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="/admin/dashboard/user/edit/{{$user->id}}">編集</a>
                    <form method="POST" action="/admin/dashboard/user/update/{{$user->id}}">
                        <button name="delete">削除</button>
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <li>
        <a href="/admin/dashboard/user/add">
            ユーザーを追加する
        </a>
    </li>
    <li>
        <a href="{{ url('/admin/dashboard') }}" >
            戻る
        </a>
    </li>
</html>
