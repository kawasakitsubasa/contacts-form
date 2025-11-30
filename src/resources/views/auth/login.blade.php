@extends('layouts.app')

@section('content')

<div class="auth-container">

    <h1 class="auth-title">Login</h1>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="auth-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/login" method="POST" class="auth-form">
        @csrf

        {{-- メールアドレス --}}
        <div class="auth-group">
            <label>メールアドレス <span class="req">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com">
        </div>

        {{-- パスワード --}}
        <div class="auth-group">
            <label>パスワード <span class="req">*</span></label>
            <input type="password" name="password" placeholder="●●●●●●●●">
        </div>

        {{-- ログインボタン --}}
        <div class="auth-buttons">
            <button type="submit" class="auth-btn">ログイン</button>
        </div>

        <p class="auth-link">
            アカウントがありませんか？
            <a href="/register">ユーザー登録はこちら</a>
        </p>
    </form>

</div>

@endsection

