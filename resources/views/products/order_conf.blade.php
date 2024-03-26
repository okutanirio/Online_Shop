@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="title1">ご注文手続き</div><br><br>

            <table class="user_info" width="500vw" border="1">
                <tr>
                <th colspan="2">お客様情報</th>
                </tr>

                <tr>
                    <td>NAME</td>
                    <td>{{ $user['name'] }}</td>
                </tr>
                    <td>MAIL</td>
                    <td>{{ $user['email'] }}</td>                                
                </tr>
            </table><br><br>
            
            <?php $total = 0; ?>
            @foreach($products as $product)
            @foreach($productusers as $productuser)
                @if($user['id'] == $productuser['user_id'])
                    @if($productuser['product_id'] == $product['id'])
                    @if($productuser['status'] == 0)
                    <?php
                        $a = (int)$product['price'];
                        $total += $a; 
                    ?>
                    @endif
                    @endif
                @endif
            @endforeach
            @endforeach
                <table class="order_info" width="500vw" border="1">
                    <tr>
                        <th>商品合計(税込)</th>
                        <td>￥{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <th>送料</th>
                        <td>￥200</td>
                    </tr>
                    <?php $totalprice = $total + 200; ?>
                    <tr>
                        <th>総合計</th>
                        <td>￥{{ number_format($totalprice) }}</td>
                    </tr>
                    <tr><th></th>
                        <td>
                            <a href="{{ route('order.conp') }}">
                            <button class='btn btn-dark' style="white-space: nowrap">注文を確定する</button></a>
                        </td>
                    </tr>
                </table>
        </div>    
    </div>
</div>

@endsection