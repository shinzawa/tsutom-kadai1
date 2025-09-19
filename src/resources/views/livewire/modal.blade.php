<div>
    <form class="search-form" wire:submit.prevent="search" novalidate>
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" wire:model="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください" />
            <select class="search-form__item-gender" wire:model="gender" id="">
                <option class="" value="" hidden>性別</option>
                <option value="0" id="0">全て</option>
                <option value="1" id="1">男性</option>
                <option value="2" id="2">女性</option>
                <option value="3" id="3">その他</option>
            </select>
            <select class="search-form__item-select" wire:model="category_id">
                @foreach($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
            <label for="date"></label>
            <input class="search-form__item-date" id="date" wire:model="date" type="date"></input>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="sumit">検索</button>
        </div>
        <div class="reset-form__button">
            <button class="reset-form__button-submit" wire:click="resetSearch">リセット</button>
        </div>
    </form>
    <div class="buttons">
        <div class="export-btn">
            <button class="export">エクスポート</button>
        </div>
        <div class="paginate">
            {{ $contacts->links() }}
        </div>
    </div>
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th><span class="contact-table__header-span">お名前</span></th>
                <th><span class="contact-table__header-span">性別</span></th>
                <th><span class="contact-table__header-span">メールアドレス</span></th>
                <th colspan="2"><span class="contact-table__header-span">お問い合わせの種類</span></th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">

                    <div class="contact-table__text">
                        <p>{{ $contact['last_name'].'　'.$contact['first_name'] }}</p>
                    </div>
                </td>
                <td>
                    <div class="contact-table__text">
                        @php
                        switch ($contact['gender']) {
                        case 1: $gender='男性';break;
                        case 2: $gender='女性';break;
                        case 3: $gender='その他';break;
                        }
                        @endphp
                        <p>{{ $gender}}</p>
                    </div>
                </td>
                <td>
                    <div class="contact-table__item">
                        <p>{{ $contact['email'] }}</p>

                    </div>
                </td>
                <td>
                    <div class="detail-form__item">
                        <p class="detail-form__item-p">
                            {{ $contact['category']['content']}}
                        </p>
                    </div>
                </td>
                <td> <button wire:click="openModal({{ $contact->id }})" type="button" class="detail">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    @if($showModal)
    <div class="modal-wrapper">
        <div class="modal-window">
            <button wire:click="closeModal()" type="button" class="modal-close">
                <span>&times;</span>
            </button>
            <table class="modal__content" height="485">
                <tr class="modal-inner">
                    <th class="modal-ttl">お名前</th>
                    <td class="modal-data">
                        {{ $selectedContact['last_name'] }}
                        <span class="space"></span>
                        <span class="firstName">{{ $selectedContact['first_name'] }}</span>
                    </td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">性別</th>
                    <td class="modal-data">
                        <input type="hidden" value="{{ $selectedContact['gender'] }}" />
                        <?php
                        if ($selectedContact['gender'] == '1') {
                            echo '男性';
                        } elseif ($selectedContact['gender'] == '2') {
                            echo '女性';
                        } else {
                            echo 'その他';
                        }
                        ?>
                    </td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">メールアドレス</th>
                    <td class="modal-data">{{ $selectedContact['email'] }}</td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">電話番号</th>
                    <td class="modal-data">{{ $selectedContact['tel'] }}</td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">住所</th>
                    <td class="modal-data">{{ $selectedContact['address'] }}</td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">建物名</th>
                    <td class="modal-data">{{ $selectedContact['building'] }}</td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">お問い合わせの種類</th>
                    <td class="modal-data">{{ $selectedContact['category']['content'] }}</td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl--last">お問い合わせ内容</th>
                    <td class="modal-data--last">
                        {{ $selectedContact['detail']}}
                    </td>
                </tr>
            </table>
            <form class="delete-form" action="/delete" method="post" novalidate>
                @method('delete')
                @csrf
                <input type="hidden" name="id" value="{{ $selectedContact['id'] }}" />
                <button class="delete-btn"><span>削除</span></button>
            </form>
        </div>
    </div>
    @endif
</div>