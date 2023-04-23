@extends('layouts.app')
@section('content')

<div class="title1">リング</div><br>

<div class="category_info">
手元を華やかに、繊細に、美しくみせてくれる指を飾るアクセサリー。身に付けている自分からもよく見えるので、気分がアガるアイテムです♪<br>
また指輪は着ける指によって様々な意味を持つとされます。近頃は複数の指に重ねづけすることもトレンド。簡単に手元コーデを楽しめるセットアイテムも登場しています。<br>
また指輪は大切な人からもらうと嬉しいアイテム。彼女や妻への誕生日や記念日のプレゼントとしても人気があります。<br>
</div><br><br>

<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-xs-1 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card">
                    <a href="{{ route('detail.product', ['product' => $product['id']]) }}">
                        <div class="position-relative">
                            @if (!empty($product['image']))
                                <img class="card-img-top" src="{{ asset($product['image']) }}" height="300px" width="300px">
                            @endif
                        </div>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">￥{{ $product['price'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection