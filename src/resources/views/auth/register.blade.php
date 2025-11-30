@extends('layouts.app')

@section('content')

<div class="auth-container">

    <h1 class="auth-title">Register</h1>

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

    <form action="/register" method="POST" class="auth-form">
        @csrf

        {{-- 名前 --}}
        <div class="auth-group">
            <label>お名前 <span class="req">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="例：Yamada Taro">
        </div>

        {{-- メール --}}
        <div class="auth-group">
            <label>メールアドレス <span class="req">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com">
        </div>

        {{-- パスワード --}}
        <div class="auth-group">
            <label>パスワード <span class="req">*</span></label>
            <input type="password" name="password" placeholder="8文字以上">
        </div>

        {{-- ボタン --}}
        <div class="auth-buttons">
            <button type="submit" class="auth-btn">登録</button>
        </div>

        <p class="auth-link">
            すでにアカウントがありますか？
            <a href="/login">ログインはこちら</a>
        </p>
    </form>

</div>

@endsection
