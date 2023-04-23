@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="title1">購入履歴</div><br><br>
            
            @if($a == 1)
            <table class="cartlist" width="600vw">
                <tr>
                <th>商品名</th>
                <th>小計</th>
                <th>購入日</th>
                </tr>
            <?php $total = 0; $count = 0; ?>
                @foreach($products as $product)
                @foreach($productusers as $productuser)
                    @if($userid == $productuser['user_id'])
                        @if($productuser['product_id'] == $product['id'])
                        @if($productuser['status'] == 1)
                            <tr>
                                <td><img width="50px" height="50px" src="{{ asset($product['image']) }}">
                                {{ $product['name'] }}</td>
                                <td>￥{{ $product['price'] }}</td>
                                <td>{{ $productuser['created_at'] }}</td>
                        <?php
                            $a = (int)$product['price'];
                            $total += $a; 
                            $count++;
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
                            <th>注文合計金額</th>
                            <td>￥{{ $total }}</td>
                        </tr>
                        <tr>
                            <th>合計注文件数</th>
                            <td>{{ $count }}件</td>
                        </tr>
                    </table>
                </div>

                @else
                <div class="cart_none">購入履歴はございません。</div>
                <div class="cart_info">
                    <a href="{{ route('home') }}">
                        <button class='btn btn-outline-dark'>ショッピングを続ける</button></a>
                </div>
                @endif
        </div>    
    </div>
</div>
@endsection
