@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('nav')
<nav class="header__nav">
    <a class="header__nav-link" href="/register
    ">register</a>
</nav>
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-form__heading">
        <h2>Login</h2>
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__inner">
            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item">メールアドレス</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" value="{{ old('email') }}" />
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
                        <input type="password" name="password" />
                    </div>
                    <div class="form__error">
                        @error('password')
                        <p> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection