@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="title1">ご注文ありがとうございました</div><br><br>
            <p class="order_conp">
                この度はご注文いただきありがとうございます。<br>
                ご注文内容の詳細はマイページからご確認くださいませ。</p><br><br>


            <div class="order_conp_top">
                <a href="{{ route('home') }}">
                        <button class='btn btn-dark'>TOPページへ戻る</button>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection