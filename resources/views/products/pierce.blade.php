@extends('layouts.app')
@section('content')

<div class="title1">ピアス</div><br>

<div class="category_info">
    耳元おしゃれの代表“ピアス”。子どもの頃、大人になったらピアスを楽しみたい！と憧れた方は多いはず。<br>
    身につければ顔周りが華やぎ、コーディネートのポイントになるピアスは、男女問わず幅広い世代に人気のアクセサリーです。<br>
    ピアッシングをして初めてする“ファーストピアス”。<br>
    ピアスホールを安全に安定させることが目的なので、金属アレルギーリスクの低い素材で太くて長いポストということが優先され、<br>
    デザインはほとんど選ぶことができません。<br>
    ピアスホールが安定したらセカンドピアスを経て、ようやく好みのデザインピアスを楽しめるようになります。<br>
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