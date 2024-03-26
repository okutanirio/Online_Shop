@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="title1">ショッピングカート</div><br>
            
            @if($a == 1)
            <table class="cartlist" width="600vw">
                <tr>
                <th>商品名</th>
                <th>小計</th>
                </tr>
            <?php $total = 0; ?>
                @foreach($products as $product)
                @foreach($productusers as $productuser)
                    @if($userid == $productuser['user_id'])
                        @if($productuser['product_id'] == $product['id'])
                        @if($productuser['status'] == 0)
                            <tr>
                                <td><img width="50px" height="50px" src="{{ asset($product['image']) }}">
                                {{ $product['name'] }}</td>
                                <td>￥{{ number_format($product['price']) }}</td>
                                <td>
                                    <a href="{{ route('cart.delete', ['id' => $productuser['id']]) }}">
                                    <button class='btn btn-secondary'>削除</button></a>
                                </td>
                        <?php
                            $a = (int)$product['price'];
                            $total += $a; 
                        ?>
                        @else
                        @endif
                        @endif
                    @endif
                @endforeach
                @endforeach
                    </tr>
                </table>

                <div class="cart_info">
                    <a href="{{ route('home') }}">
                        <button class='btn btn-outline-dark'>ショッピングを続ける</button></a>

                    <table class="cart_order" width="300vw" border="1">
                        <tr>
                            <th>商品合計</th>
                            <td>￥{{ number_format($total) }}</td>
                        </tr>
                        <th></th>
                        <td><a href="{{ route('order.conf') }}">
                                <button class='btn btn-dark'>ご注文手続きへ進む</button></a>
                            </td>
                    </table>
                </div>

                @else
                <div class="cart_none">現在、カートには商品がございません。商品をお選びください。</div>
                <div class="cart_info">
                    <a href="{{ route('home') }}">
                        <button class='btn btn-outline-dark'>ショッピングを続ける</button></a>
                </div>
                @endif
        </div>    
    </div>
</div>

@endsection