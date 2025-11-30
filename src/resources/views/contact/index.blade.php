@extends('layouts.app')

@section('content')

<div class="form-container">

    <h1 class="form-title">Contact</h1>

    <form action="/confirm" method="post">
        @csrf

        {{-- お名前 --}}
        <div class="form-group">
            <label>お名前 <span class="req">※</span></label>
            <div class="name-inputs">
                <input type="text" name="lastname" placeholder="例：山田" value="{{ old('lastname') }}">
                <input type="text" name="firstname" placeholder="例：太郎" value="{{ old('firstname') }}">
            </div>
            @error('lastname')
                <p class="error">{{ $message }}</p>
            @enderror
            @error('firstname')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 性別 --}}
        <div class="form-group">
            <label>性別 <span class="req">※</span></label>
            <div class="gender-box">
                <label><input type="radio" name="gender" value="1" {{ old('gender')=='1'?'checked':'' }}> 男性</label>
                <label><input type="radio" name="gender" value="2" {{ old('gender')=='2'?'checked':'' }}> 女性</label>
                <label><input type="radio" name="gender" value="3" {{ old('gender')=='3'?'checked':'' }}> その他</label>
            </div>
            @error('gender')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label>メールアドレス <span class="req">※</span></label>
            <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 電話番号 --}}
        <div class="form-group">
            <label>電話番号 <span class="req">※</span></label>
            <div class="tel-inputs">
                <input type="text" name="tel1" maxlength="5" value="{{ old('tel1') }}">
                <span class="hyphen">-</span>
                <input type="text" name="tel2" maxlength="5" value="{{ old('tel2') }}">
                <span class="hyphen">-</span>
                <input type="text" name="tel3" maxlength="5" value="{{ old('tel3') }}">
            </div>
            @error('tel1')
                <p class="error">{{ $message }}</p>
            @enderror
            @error('tel2')
                <p class="error">{{ $message }}</p>
            @enderror
            @error('tel3')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <label>住所 <span class="req">※</span></label>
            <input type="text" name="address" value="{{ old('address') }}">
            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名（任意） --}}
        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building') }}">
        </div>

        {{-- カテゴリー --}}
        <div class="form-group">
            <label>お問い合わせの種類 <span class="req">※</span></label>
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':'' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 内容 --}}
        <div class="form-group">
            <label>お問い合わせ内容 <span class="req">※</span></label>
            <textarea name="detail">{{ old('detail') }}</textarea>
            @error('detail')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="submit-area">
            <button class="confirm-button" type="submit">確認画面</button>
        </div>

    </form>
</div>

@endsection
