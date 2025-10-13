@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}">
@endsection


@section('content')
<div class="update">
    <form class="edit" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
        <div class="edit__group-left">
            <p class="item-list">
                <a href="/products" class="item-list__title">商品一覧 &gt;</a>  {{ $product->name ?? '' }}
            </p>
            <div class="edit-form__group">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product__img-output" />
                @endif
            </div>
            <div class="edit-form__group-bottom">
                <input class="edit-form__input-3" type="file" name="image" placeholder="ファイルを選択" />
                <p class="edit-form__error-message">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="edit__group-right">
            <div class="edit__group-title">
                <span class="edit__label--item">商品名</span>
            </div>
            <div class="edit-form__group">
                <input class="edit-form__input-1" type="text" name="name" placeholder="商品名を入力" value="{{ $product['name'] }}" />
                <p class="edit-form__error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="edit__group-right">
            <div class="edit__group-title">
                <span class="edit__label--item">値段</span>
            </div>
            <div class="edit-form__group">
                <input class="edit-form__input-2" type="text" name="price" placeholder="価格を入力" value="{{ $product['price'] }}" />
                <p class="edit-form__error-message">
                    @error('price')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="edit__group-select">
            <div class="edit__group-right">
                <div class="edit__group-title">
                    <span class="edit__label--item__season">季節</span>
                </div>
                <div class="edit-form__group-season">
                    @foreach($seasons as $season)
                        <div class="form__input-text">
                            <input type="checkbox" name="season_id[]" value= "{{ $season->id }}"
                                @if(
                                    (isset($product) && $product->seasons && $product->seasons->pluck('id')->contains($season->id)) || in_array($season->id, old('season_id', []))
                                )
                                    checked
                                @endif
                            >
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
        </div>
        <div class="edit__group-center">
            <div class="edit__group-title">
                <span class="edit__label--item">商品説明</span>
            </div>
            <div class="edit-form__group">
                <div class="form__input-textarea">
                    <textarea name="description" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
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
            <input class="edit__button-send" type="submit" value="変更を保存" name="send">
        </div>
    </form>
    <form class="form-delete" action="/products/{productId}/delete" method="POST">
        @method('DELETE')
        @csrf
        <input type="hidden" name="id" value="{{ $product['id'] }}">
        <input class="delete__button" type="submit" value="🗑️" />
    </form>

</div>
@endsection