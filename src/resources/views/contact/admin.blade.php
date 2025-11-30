@extends('layouts.app')

@section('content')

<h1 class="admin-title">Admin</h1>

<div class="admin-container">

    {{-- エクスポート --}}
    <form action="/export" method="GET" class="export-area">
        <button class="export-btn" type="submit">エクスポート</button>
    </form>

    {{-- 検索フォーム --}}
    <div class="search-box">
       <form action="/search" method="GET" class="search-form">

        {{-- 名前・メール --}}
        <input 
            type="text"
            name="keyword"
            class="search-input"
            placeholder="名前やメールアドレスを入力してください"
            value="{{ request('keyword') }}"
        >

        {{-- 性別 --}}
        <select name="gender" class="search-select">
            <option value="">性別</option>
            <option value="1" {{ request('gender')=='1'?'selected':'' }}>男性</option>
            <option value="2" {{ request('gender')=='2'?'selected':'' }}>女性</option>
            <option value="3" {{ request('gender')=='3'?'selected':'' }}>その他</option>
        </select>

        {{-- カテゴリ --}}
        <select name="category_id" class="search-select">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id')==$category->id?'selected':'' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- 日付 --}}
        <input 
            type="date"
            name="date"
            class="search-date"
            value="{{ request('date') }}"
        >
        <div class="search-buttons">
             <button type="submit" class="search-btn">検索</button>
             <a href="/reset" class="reset-btn">リセット</a>
        </div>
        
       </form>
     </div>


    {{-- 一覧テーブル --}}
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>

                <td>
                    @if($contact->gender == 1) 男性
                    @elseif($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td>

                <td>{{ $contact->email }}</td>

                <td>{{ $contact->category->name }}</td>

                <td>
                    <button 
                        class="detail-btn"
                        data-id="{{ $contact->id }}"
                        data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                        data-gender="{{ $contact->gender }}"
                        data-email="{{ $contact->email }}"
                        data-tel="{{ $contact->tel1 }}-{{ $contact->tel2 }}-{{ $contact->tel3 }}"
                        data-address="{{ $contact->address }}"
                        data-building="{{ $contact->building }}"
                        data-category="{{ $contact->category->name }}"
                        data-detail="{{ $contact->detail }}"
                    >詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $contacts->links() }}
    </div>

</div>


{{-- 詳細モーダル --}}
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span id="closeModal" class="modal-close">×</span>

        <h2>お問い合わせ詳細</h2>

        <p><strong>お名前：</strong> <span id="m_name"></span></p>
        <p><strong>性別：</strong> <span id="m_gender"></span></p>
        <p><strong>メール：</strong> <span id="m_email"></span></p>
        <p><strong>電話番号：</strong> <span id="m_tel"></span></p>
        <p><strong>住所：</strong> <span id="m_address"></span></p>
        <p><strong>建物名：</strong> <span id="m_building"></span></p>
        <p><strong>お問い合わせ種類：</strong> <span id="m_category"></span></p>
        <p><strong>内容：</strong> <span id="m_detail"></span></p>
    </div>
</div>


<script>
document.querySelectorAll('.detail-btn').forEach(button => {
    button.addEventListener('click', function() {

        document.getElementById('m_name').textContent = this.dataset.name;
        document.getElementById('m_gender').textContent =
            this.dataset.gender == 1 ? '男性' :
            this.dataset.gender == 2 ? '女性' : 'その他';

        document.getElementById('m_email').textContent = this.dataset.email;
        document.getElementById('m_tel').textContent = this.dataset.tel;
        document.getElementById('m_address').textContent = this.dataset.address;
        document.getElementById('m_building').textContent = this.dataset.building;
        document.getElementById('m_category').textContent = this.dataset.category;
        document.getElementById('m_detail').textContent = this.dataset.detail;

        document.getElementById('detailModal').style.display = "block";
    });
});

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('detailModal').style.display = "none";
});
</script>

@endsection


