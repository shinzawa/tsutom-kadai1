@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@livewireStyles
@endsection

@section('content')
<div class="contact__alert">
    @if(session('message'))
    <div class="contact__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
    <div class="contact__alert--danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="contact__content">
    <div class="section__title">
        <span>Admin</span>
    </div>
    <form class="search-form" action="/search" method='POST'>
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください" />
            <select class="search-form__item-gender" name="gender" id="">
                <option class="" value="" hidden>性別</option>
                <option value="" id="0">全て</option>
                <option value="" id="1">男性</option>
                <option value="" id="2">女性</option>
                <option value="" id="3">その他</option>
            </select>
            <select class="search-form__item-select" name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
            <label for="date"></label>
            <input class="search-form__item-date" id="date" name="date" type="date"></input>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="sumit">検索</button>
        </div>
        <div class="reset-form__button">
            <button class="reset-form__button-submit" type=reset value=reset>リセット</button>
        </div>
    </form>
    @livewire('modal')
</div>



@endsection