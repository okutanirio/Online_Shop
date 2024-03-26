@extends('layouts.app')

@section('content')
<div class="title1">お気に入り一覧</div><br>

<div class="container">
    <div class="row">
    @if($a == 1)
        @foreach($products as $product)
        @foreach($likes as $like)
            @if($userid == $like['user_id'])
                @if($like['product_id'] == $product['id'])
                <div class="col-xs-1 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card card_height">
                        <a href="{{ route('products.show', ['product' => $product['id']]) }}">
                            <div class="position-relative">
                                @if (!empty($product['image']))
                                    <img class="card-img-top" src="{{ asset($product['image']) }}" height="300px" width="300px">
                                @endif
                            </div>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">￥{{ number_format($product['price']) }}</p>
                            
                        </div>
                    </div>
                </div>
                @endif
            @endif
        @endforeach
        @endforeach

    @else
        <div class="like_none">お気に入り商品が登録されていません。</div>
        <div class="like_bottom"></div>
    @endif 
    </div>
</div>

@endsection