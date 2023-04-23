@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="title1">MY PAGE</div>
            <div class="title2">マイページ</div>
            <div class="users">
                <div class="user">
                    <div class="user_name">{{ $name }}　さん</div>
                    <div class="user_mail">メールアドレス : {{ $email }}</div>
                </div>

                <div class="user_like">
                    <a href="{{ route('like.list') }}"><div class="user_link">お気に入り一覧</div></a> 
                </div>       
                <div class="user_cart">    
                    <a href="{{ route('cart.list') }}"><div class="user_link">カート一覧</div></a>
                </div>
                <div class="user_history">
                    <a href="{{ route('purchase.list') }}"><div class="user_link">購入履歴</div></a>
                </div>
                <div class="user_edit">
                    <a href="{{ route('edit.user', ['id' => $user_id]) }}"><div class="user_link">会員登録変更</div></a>
                </div>
            </div>

        </div>    
    </div>
</div>
@endsection
