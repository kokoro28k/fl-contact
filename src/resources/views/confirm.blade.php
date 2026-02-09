@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('header')
<div class="header__inner">
    <a class="header__logo" href="/">
        FashionablyLate
    </a>
</div>
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form id="confirm-form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">{{ $contact['last_name'] }} {{ $contact['first_name'] }}
                        <input type="hidden" name="last_name" value="{{$contact['last_name']}}" readonly />
                        <input type="hidden" name="first_name" value="{{$contact['first_name']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        {{ $contact['gender_label'] }}
                        @if($contact['gender_label']==1)
                        男性
                        @endif
                        @if($contact['gender_label']==2)
                        女性
                        @endif
                        @if($contact['gender_label']==3)
                        その他
                        @endif
                        <input type="hidden" name="gender" value="{{$contact['gender']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">{{ $contact['email'] }}
                        <input type="hidden" name="email" value="{{$contact['email']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}
                        <input type="hidden" name="tel1" value="{{$contact['tel1']}}" readonly />
                        <input type="hidden" name="tel2" value="{{$contact['tel2']}}" readonly />
                        <input type="hidden" name="tel3" value="{{$contact['tel3']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">{{ $contact['address'] }}
                        <input type="hidden" name="address" value="{{$contact['address']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">@if(!empty($contact['building']))
                        <input type="hidden" name="building" value="{{$contact['building']}}" readonly />
                        @endif
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">{{$contact['content']}}
                        <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        {{ $contact['detail'] }}
                        <input type="hidden" name="detail" value="{{$contact['detail']}}" readonly />
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <div class="form__button-wrapper">
        <div class="form__button"><button form="confirm-form" type="submit" class="form__button-submit">
                送信
            </button>
        </div>
        <form class="form__button-back" action="/confirm" method="post">
            @csrf
            <input type="hidden" name="last_name" value="{{$contact['last_name']}}" readonly />
            <input type="hidden" name="first_name" value="{{$contact['first_name']}}" readonly />
            <input type="hidden" name="gender" value="{{$contact['gender']}}" readonly />
            <input type="hidden" name="email" value="{{$contact['email']}}" readonly />
            <input type="hidden" name="tel1" value="{{$contact['tel1']}}" readonly />
            <input type="hidden" name="tel2" value="{{$contact['tel2']}}" readonly />
            <input type="hidden" name="tel3" value="{{$contact['tel3']}}" readonly />
            <input type="hidden" name="address" value="{{$contact['address']}}" readonly />
            <input type="hidden" name="building" value="{{$contact['building']}}" readonly />
            <input type="hidden" name="category_id" value="{{$contact['category_id']}}" readonly />
            <input type="hidden" name="detail" value="{{$contact['detail']}}" readonly />
            <button type="submit" name="action" value="back">修正</button>
        </form>
    </div>
</div>
@endsection