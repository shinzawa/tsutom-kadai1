@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <p>Confirm</p>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="name" value="{{ $contact['last_name'].'  '.$contact['first_name'] }}" readonly />
                        <input type="hidden" name="last_name" value="{{ $contact['last_name']}}" readonly />
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        @php
                        switch ($contact['gender']) {
                        case 1: $gender='男性';break;
                        case 2: $gender='女性';break;
                        case 3: $gender='その他';break;
                        }
                        @endphp
                        <span>{{$gender}}</span>
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        @php
                        $tel=$contact['tel1'].'-'.$contact['tel2'].'-'.$contact['tel3'];
                        @endphp
                        <input type="text" name="tel" value="{{ $tel }}" readonly />
                        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}" />
                        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}" />
                        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}" />

                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                        <input type="text" name="content" value="{{ $categories[$contact['category_id'] - 1]['content'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="content" value="{{ $contact['content'] }}" readonly />
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit-store" type="submit">
                <span class="form__button-submit-text">送信</span>
            </button>
            <button class="form__button-submit-modify" type="submit" name="action" value="back">
                <span class="form__button-submit-text">修正</span>
            </button>
        </div>
    </form>
</div>
@endsection