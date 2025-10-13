@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('content')
<h2 class="edit-form__title">商品登録</h2>
<div class="edit-form__inner">
    <form class="edit" action="{{ route('products.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="edit__group">
            <div class="edit__group-title">
                <span class="edit__label--item">商品名</span>
                <span class="edit__label--required">必須</span>
            </div>
            <div class="edit-form__group">
                <input class="edit-form__input-1" type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
                <p class="edit-form__error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="edit__group">
            <div class="edit__group-title">
                <span class="edit__label--item">値段</span>
                <span class="edit__label--required">必須</span>
            </div>
            <div class="edit-form__group">
                <input class="edit-form__input-2" type="text" name="price" placeholder="価格を入力" value="{{ old('price') }}" />
                <p class="edit-form__error-message">
                    @error('price')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="edit__group">
            <div class="edit__group-title">
                <span class="edit__label--item">商品画像</span>
                <span class="edit__label--required">必須</span>
            </div>
            <div class="edit-form__group">
                <input class="edit-form__input-3" type="file" name="image"
                id ="imageInput" placeholder="ファイルを選択" accept="image/*" />
                @if(request()->has('image'))
                    <div id="previewArea">
                        <img id="previewImage" src="#" alt="プレビュー画像">
                    </div>
                @endif
                <p class="edit-form__error-message">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="edit__group">
            <div class="edit__group-title">
                <span class="edit__label--item">季節</span>
                <span class="edit__label--required">必須</span>
                <span class="edit__label--selects">複数選択可</span>
            </div>
            <div class="edit-form__group">
                @foreach($seasons as $season)
                    <div class="form__input-text">
                        <input type="checkbox" name="seasons[]" value= "{{ $season->id }}"
                            {{ in_array($season->id, old('seasons', [])) ? 'checked' : ' '}}>
                        {{ $season->name }}
                    </div>
                @endforeach
                <p class="edit-form__error-message">
                    @error('seasons')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="edit__group">
            <div class="edit__group-title">
                <span class="edit__label--item">商品説明</span>
                <span class="edit__label--required">必須</span>
            </div>
            <div class="edit-form__group">
                <div class="form__input-textarea">
                    <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                </div>
                <p class="edit-form__error-message">
                    @error('description')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="edit__group-button">
            <a class="edit__button-back" href="/products">戻る</a>
            <input class="edit__button-send" type="submit" value="登録" name="send">
        </div>
    </form>
</div>
@endsection