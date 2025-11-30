@extends('layouts.app')

@section('content')
<div class="confirm-container">

    <h1 class="confirm-title">Confirm</h1>

    <form action="/thanks" method="post">
        @csrf

        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $inputs['lastname'] }}　{{ $inputs['firstname'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if($inputs['gender'] == 1) 男性
                    @elseif($inputs['gender'] == 2) 女性
                    @else その他
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $inputs['email'] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $inputs['tel1'] }}{{ $inputs['tel2'] }}{{ $inputs['tel3'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $inputs['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $inputs['building'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $inputs['category_name'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{{ $inputs['detail'] }}</td>
            </tr>
        </table>

        {{-- hidden --}}
         <input type="hidden" name="lastname" value="{{ $inputs['lastname'] }}">
         <input type="hidden" name="firstname" value="{{ $inputs['firstname'] }}">
         <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
         <input type="hidden" name="email" value="{{ $inputs['email'] }}">
         <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
         <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
         <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
         <input type="hidden" name="address" value="{{ $inputs['address'] }}">
         <input type="hidden" name="building" value="{{ $inputs['building'] ?? '' }}">
         <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
         <input type="hidden" name="detail" value="{{ $inputs['detail'] }}">
        
        <div class="confirm-buttons">
             <button class="send-button" type="submit">送信</button>
            <button class="edit-button" type="submit" name="back" formaction="/">修正</button>
         </div>

    </form>
</div>
@endsection

