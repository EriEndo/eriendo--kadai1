@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/index.css') }}">
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
                <span class="form__label--item ">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text input form__inputs">
                    <div class="form__input-item">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" />
                        <div class="form__error">
                            @if ($errors->has('last_name') && $errors->has('first_name'))
                            お名前を入力してください。
                            @elseif ($errors->has('last_name'))
                            {{ $errors->first('last_name') }}
                            @endif
                        </div>
                    </div>
                    <div class="form__input-item">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}" />
                        <div class="form__error">
                            @if (!$errors->has('last_name') && $errors->has('first_name'))
                            {{ $errors->first('first_name') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <label class="form__input--radio">
                    <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性
                </label>
                <label class="form__input--radio">
                    <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性
                </label>
                <label class="form__input--radio">
                    <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他
                </label>
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
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
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
            <div class="form__group-content">
                <div class="form__input--number form__inputs">
                    <div class="form__input-item">
                        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}" />
                        @error('tel1')
                        <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <span>-</span>
                    <div class="form__input-item">
                        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                        @error('tel2')
                        <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <span>-</span>
                    <div class="form__input-item">
                        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                        @error('tel3')
                        <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
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
                    <input type="text" name="adress" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('adress')}}" />
                </div>
                <div class="form__error">
                    @error('adress')
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
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building')}}" />
                </div>
                <div class="form__error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <select class="create-form__item-select" name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['content'] }}
                        </option>
                        @endforeach
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
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{ $message }}
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