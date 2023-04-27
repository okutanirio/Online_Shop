@extends('layouts.app')
@section('content')

<div class="title1">ブレスレット</div><br>

<div class="category_info">
手元や足首を華やかに見せてくれるブレスレット・アンクレット。<br>
ファッションのアクセントとしても取り入れやすく、手首や足首を華奢に見せてくれる効果も♪<br>
付け外しが簡単で存在感のあるデザインが多いバングルから、細いチェーンの繊細なデザインのブレスレットまで幅広く取り揃えています。<br>
</div><br><br>

<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-xs-1 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card">
                    <a href="{{ route('products.show', ['product' => $product['id']]) }}">
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