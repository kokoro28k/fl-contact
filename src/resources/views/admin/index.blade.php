@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-index.css') }}" />
@endsection

@section('nav')
<nav class="header__nav">
    <form class="header__nav-form" method="POST" action="/logout">
        @csrf
        <button class="logout-button" type="submit">logout</button>
    </form>
</nav>
@endsection

@section('content')
<div class="admin__content">

    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <div class="admin-search">
        <form class="admin-search__form" action="/search" method="GET">
            <input class="admin-search__input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
            <div class="select-wrap">
                <select name="gender" class="admin-search__select--gender">
                    <option value="">性別</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <div class="select-wrap">
                <select name="category_id" class="admin-search__select--category">
                    <option value="">お問い合わせ種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->id }}.{{ $category->content }}
                    </option>
                    @endforeach
                </select>
            </div>
            <input type="date" name="date" class="admin-search__date">
            <button type="submit" class="admin-search__button">検索</button>
            <a class="admin-search__reset" href="/admin">リセット</a>
        </form>
    </div>
    <div class="admin-controls">
        <div class="admin-controls__export">
            <form action="/export" method="get">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button class="admin-controls__button" type="submit" name="export" value="csv">エクスポート</button>
            </form>
        </div>
        <div class="admin-controls__pagination">
            {{ $contacts->links() }}
        </div>
    </div>
    <div class="admin-table">
        <table class="admin-table__inner">
            <tr class="admin-table__row">
                <th class="admin-table__header">名前</th>
                <th class="admin-table__header">性別</th>
                <th class="admin-table__header">メールアドレス</th>
                <th class="admin-table__header">お問い合わせの種類</th>
                <th class="admin-table__header">詳細</th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="admin-table__row">
                <td class="admin-table__text">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td class="admin-table__text">{{ $genders[$contact->gender] }}</td>
                <td class="admin-table__text">{{ $contact->email }}</td>
                <td class="admin-table__text">{{ $contact->category->content }}</td>
                <td class="admin-table__text">
                    <a href="{{ request()->fullUrlWithQuery(['detail' => $contact->id]) }}" class="admin-table__button">
                        詳細
                    </a>
                </td>
            </tr>
            <div id="modal-{{ $contact->id }}"
                class="admin-modal {{ request('detail') == $contact->id ? 'is-active' : '' }}">
                <div class="admin-modal__content">

                    <a href="/admin" class="admin-modal__close">×</a>
                    <div class="info-grid">
                        <div class="admin-modal__label">名前</div>
                        <div class="admin-modal__text">{{ $contact->last_name }} {{ $contact->first_name }}</div>
                        <div class="admin-modal__label">性別</div>
                        <div class="admin-modal__text">
                            {{ $genders[$contact->gender] }}</div>
                        <div class="admin-modal__label">
                            メールアドレス</div>
                        <div class="admin-modal__text">{{ $contact->email }}</div>
                        <div class="admin-modal__label">電話番号</div>
                        <div class="admin-modal__text">{{ $contact->tel }}
                        </div>
                        <div class="admin-modal__label">住所</div>
                        <div class="admin-modal__text">{{ $contact->address }}</div>
                        <div class="admin-modal__label">建物</div>
                        <div class="admin-modal__text">{{ $contact->building }}</div>
                        <div class="admin-modal__label">お問い合わせ種類</div>
                        <div class="admin-modal__text">{{ $contact->category->content }}</div>
                        <div class="admin-modal__label">お問い合わせ内容</div>
                        <div class="admin-modal__text">{{ $contact->detail }}
                        </div>
                    </div>
                    <form action="/delete" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <button type="submit" class="admin-modal__delete">
                            削除
                        </button>
                    </form>
                </div>
                @endforeach
        </table>
    </div>
</div>
@endsection