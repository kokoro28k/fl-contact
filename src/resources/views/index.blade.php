@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}?v=2" />
@endsection

@section('header')
<div class="header__inner">
    <a class="header__logo" href="/">
        FashionablyLate
    </a>
</div>
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--title">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-wrapper">
                    <div class="form__input--text">
                        <div class="name-wrapper">
                            <input type="text" name="last_name" placeholder="例 山田" value="{{old('last_name')}}" />
                            <input type="text" name="first_name" placeholder="例 太郎" value="{{old('first_name')}}" />
                        </div>
                        <div class="form__error">
                            @error('last_name'){{$message}}@enderror
                            @error('first_name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item">性別</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__gender-wrapper">
                    <label class="form__gender--item">
                        <input type="radio" name="gender" value="1" {{ old('gender')=='1' ? 'checked' : '' }} />男性
                    </label>
                    <label class="form__gender--item">
                        <input type="radio" name="gender" value="2" {{ old('gender')=='2' ? 'checked' : '' }} />女性
                    </label>
                    <label class="form__gender--item">
                        <input type="radio" name="gender" value="3" {{ old('gender')=='3' ? 'checked' : '' }} />その他
                    </label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item">メールアドレス</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例 test@example.com" value="{{old('email')}}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item">電話番号</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-wrapper">
                    <div class="form__tel-wrapper">
                        <input type="tel" name="tel1" placeholder="080" value="{{old('tel1')}}" />

                        <span class="form__tel--hypen">-</span>
                        <input type="tel" name="tel2" placeholder="1234" value="{{old('tel2')}}" />

                        <span class="form__tel--hypen">-</span>
                        <input type="tel" name="tel3" placeholder="5678" value="{{old('tel3')}}" />
                    </div>
                    <div class="form__error">
                        @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                        @if ($errors->first('tel1') === '電話番号を入力してください' ||
                        $errors->first('tel2') === '電話番号を入力してください' ||
                        $errors->first('tel3') === '電話番号を入力してください')
                        電話番号を入力してください
                        @elseif ($errors->first('tel1') === '電話番号は半角英数字で入力してください' ||
                        $errors->first('tel2') === '電話番号は半角英数字で入力してください' ||
                        $errors->first('tel3') === '電話番号は半角英数字で入力してください')
                        電話番号は半角英数字で入力してください
                        @else
                        電話番号は5桁までの数字で入力してください
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item">住所</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例 東京都渋谷区千駄ヶ谷1-2-3" value="{{old('address')}}" />
                </div>
                <div class="form__error">
                    @error('address')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item">建物名</label>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例 千駄ヶ谷マンション101" value="{{old('building')}}" />
                </div>
                <div class="form__error">
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item">お問い合わせの種類</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <div class="form__category--item">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                                {{$category->id}}.{{ $category->content }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item">お問い合わせ内容</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{old('detail')}}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection