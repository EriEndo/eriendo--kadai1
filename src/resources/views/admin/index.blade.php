@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('header-nav__auth-action')
<form action="/logout" method="POST">
    @csrf
    <button class="header__button" type="submit">Logout</button>
</form>
@endsection

@section('content')
<div class="contact__content">
    <div class="contact-form__heading">
        <p>Admin</p>
    </div>


    <form class="search-form" action="/search" method="get">
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="name" placeholder="名前やメールアドレスを入力してください" value="{{ request('name') }}">

            <select class="search-form__item-select" name="gender">
                <option value="" selected>性別</option>
                <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id">
                <option value="" selected>お問い合わせの種類</option>
                <option value="1" {{ request('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{ request('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
                <option value="3" {{ request('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{ request('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{ request('category_id') == 5 ? 'selected' : '' }}>その他</option>
            </select>

            <input type="date" name="date" value="{{ request('date') }}" class="form__input--date">

            <button class="search-form__button-submit" type="submit">検索</button>
            <button type="button" class="search-form__button-reset" onclick="window.location.href='/admin'">リセット</button>
        </div>
    </form>

    <div class="contact-toolbar">
        <a href="{{ url('/export?' . http_build_query(request()->query())) }}" class="export-button">
            エクスポート
        </a>
        <div class="pagination">
            {{ $contacts->links() }}
        </div>
    </div>

    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
                <th class="contact-table__header">詳細</th>
            </tr>

            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td class="contact-table__item">
                    @if ($contact->gender == 1)
                    男性
                    @elseif ($contact->gender == 2)
                    女性
                    @else
                    その他
                    @endif
                </td>
                <td class="contact-table__item">{{ $contact->email }}</td>
                <td class="contact-table__item">{{ $contact->category ? $contact->category->content : '未分類' }}</td>
                <td class="contact-table__item">
                    <a href="#modal-{{ $contact->id }}" class="detail-button">詳細</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @foreach ($contacts as $contact)
    <div id="modal-{{ $contact->id }}" class="modal-container">
        <div class="modal-body">
            <a href="#" class="modal-close">&times;</a>
            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @if ($contact->gender == 1)
                        男性
                        @elseif ($contact->gender == 2)
                        女性
                        @else
                        その他
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $contact->tel }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $contact->adress }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $contact->building }}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{ $contact->category ? $contact->category->content : '未分類' }}</td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{{ $contact->detail }}</td>
                </tr>
            </table>
            <form action="/delete/{{ $contact->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">削除</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection