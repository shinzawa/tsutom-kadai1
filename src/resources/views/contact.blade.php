@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <p>Contact</p>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content-name">
                <div class="form__input--text-family-name">
                    <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                </div>
                <div class="form__error">
                    @error('last_name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__input--text-first-name">
                    <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}" />
                </div>
                <div class="form__error">
                    @error('first_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content-gender">
                <div class="form__input--text-gender">
                    <input type="radio" name="gender" value="1" id="1" @if(1===(int)old('gender', 1)) checked @endif />
                    <label for="1">男性</label>
                    <input type="radio" name="gender" value="2" id="2" @if(2===(int)old('gender')) checked @endif />
                    <label for="2">女性</label>
                    <input type="radio" name="gender" value="3" id="3" @if(3===(int)old('gender')) checked @endif />
                    <label for="3">その他</label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content-tel">
                <div class="form__input--text-tel">
                    <input type="text"
                        name="tel1" placeholder="090"
                        value="{{ old('tel1') }}">
                </div>
                <div class="form__error">
                    @error('tel1')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__input--text-tel">
                    <p>-</p>
                </div>
                <div class="form__input--text-tel">
                    <input type="text"
                        name="tel2" placeholder="1234"
                        value="{{ old('tel2') }}">
                </div>
                <div class="form__error">
                    @error('tel2')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__input--text-tel">
                    <p>-</p>
                </div>
                <div class="form__input--text-tel">
                    <input type="text"
                        name="tel3" placeholder="5678"
                        value="{{ old('tel3') }}">
                </div>
                <div class="form__error">
                    @error('tel3')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content-select">
                <div class="select_wrapper">
                    <select name="category_id">
                        <option value="" hidden><span class="form__input-select">&nbsp;&nbsp;&nbsp;選択して下さい</span></option>

                        <option value="1" @if(1===(int)old('category_id')) selected @endif>商品のお届けについて</option>
                        <option value="2" @if(2===(int)old('category_id')) selected @endif>商品の交換について</option>
                        <option value="3" @if(3===(int)old('category_id')) selected @endif>商品トラブル</option>
                        <option value="4" @if(4===(int)old('category_id')) selected @endif>ショップへのお問い合わせ</option>
                        <option value="5" @if(5===(int)old('category_id')) selected @endif>その他</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
                </div>
            </div>
            <div class="form__error">
                @error('content')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">
                <span>確認画面</span>
            </button>
        </div>

    </form>
</div>
@endsection