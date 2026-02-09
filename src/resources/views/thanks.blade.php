@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('header')
@endsection

@section('content')
<div class="watermark-container">
    <div class="watermark-text">Thank you</div>
</div>
<div class="thanks__content">
    <div class="thanks__text">お問い合わせありがとうございました</div>
    <div class="form__button">
        <a class="form__button-submit" href="/">HOME</a>
    </div>
</div>
@endsection