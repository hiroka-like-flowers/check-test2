@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection


@section('content')
<!-- 検索結果によって〇〇の商品一覧と表示されるようにする -->
<div class="products-a">
    <div class="left">
        <div class="search-box">
            <form class="search-form" action="{{ route('products.search') }}"  method="GET">
                <input class="search-form__item" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}" />
                <div class="search-form__actions">
                    <button class="search__button" type="submit">
                        <span class="search__button-message">検索</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="select-tag">
            <h3 class="select-tag__title">価格順で表示</h3>
            <div class="select-tag__box">
                <form class="select-form"   action="{{ route('products.search') }}" method="GET">
                    <select class="select-form__item" name="price" value="{{ request('price') }}">
                        <option disabled selected>価格で並べ替え</option>
                        <option value="1" @if( request('price_asc')==1 ) selected @endif>高い順に表示</option>
                        <option value="2" @if(request('price_desc')==2 ) selected @endif>低い順に表示</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="product-form">
            <h2 class="search-title">商品一覧</h2>
            <div class="add-item">
                <a class="add__button" href="{{ route('products.register') }}">
                    <span class="add__button-message"> + 商品を追加</span>
                </a>
            </div>
        </div>
        <div class="item-list">
            @foreach($products as $product)
                <div class="item-card">
                    <a href="{{ url('/products/' . $product->id) }}">
                        <div class="item__img">
                            <img src="{{ asset('storage/' . $product->image ) }}" alt="{{ $product->name ?? '' }}" class="item__img-output" />
                        </div>
                        <div class="item__cont  ent">
                            <h2 class="item__name">{{ $product->name ?? '' }}</h2>
                            <p class="item__price">価格: ￥{{ $product->price ?? '' }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{ $products->links() }}

@endsection