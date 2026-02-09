@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('nav')

<nav class="header__nav">
    <a class="header__nav-link" href="/login">login</a>
</nav>
@endsection
@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>Register</h2>
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form__inner">
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item">お名前</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="例 山田 太郎" value="{{ old('name') }}" />
                    </div>
                    <div class="form__error">
                        @error('name')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item">メールアドレス</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="例 test@example.com" value="{{ old('email') }}" />
                    </div>
                    <div class="form__error">
                        @error('email')
                        <p> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item">パスワード</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="coachtech1106" />
                    </div>
                    <div class="form__error">
                        @error('password')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection