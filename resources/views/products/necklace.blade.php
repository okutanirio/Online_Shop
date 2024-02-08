@extends('layouts.app')
@section('content')

<div class="title1">ネックレス</div><br>

<div class="category_info">
    首元を飾るアクセサリー。ペンダントやチョーカー、ショートネックレスにロングネックレスなど様々な種類があります。<br>
    華奢なプチペンダントは肌身離さずいつも身に付けることができ、彼女や妻の誕生日や記念日のプレゼントとしても人気の高いアイテム。<br>
    セレモニーシーンには上品な印象のパールネックレスが定番です。<br>
    また金属アレルギーの方でも楽しめるように、ニッケルフリー素材の実用的なネックレスに、ちょっぴり贅沢な10金やシルバー925のジュエリーまで幅広く取り揃えています。<br>
    お気に入りのネックレスが見つかりますように。<br>
</div><br><br>

<div class="container">
    <div class="row">
        @foreach ($products as $product)
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
                        <p class="card-text">￥{{ $product['price'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection