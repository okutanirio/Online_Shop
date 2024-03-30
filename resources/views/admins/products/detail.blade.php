@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="productTable" style="">
            <p class="item_info">商品詳細</p>
            <table class="table table-hover" style="width: 50%; margin-left: 25%">
                <thead>
                    <tr>
                        <th class="review_th">画像</th>
                        <td>
                            <img src="{{ asset($product->image) }}" height="150px" width="150px">
                        </td>
                    </tr>
                    <tr>
                        <th class="review_th">商品名</th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="review_th">価格</th>
                        <td>
                            {{ number_format($product->price) }}
                        </td>
                    </tr>
                    <tr>
                        <th class="review_th">在庫数</th>
                        <td>
                            {{ $product->stock }}
                        </td>
                    </tr>
                    <tr>
                        <th class="review_th">商品情報</th>
                        <td>
                            {!! nl2br(e($product->info)) !!}
                        </td>
                    </tr>
                    <tr>
                        <th class="review_th">商品説明</th>
                        <td>
                            {!! nl2br(e($product->description)) !!}
                        </td>
                    </tr>
                    <tr>
                        <th class="review_th">売上件数</th>
                        <td>
                            {{ $purchase ?? 0 }}件
                        </td>
                    </tr>
                    <tr>
                        <th class="review_th">売上金額</th>
                        <td>
                            <?php
                                if (!empty($purchase)) {
                                    $purchase_price = $product->price * $purchase;
                                } else {
                                    $purchase_price = 0;
                                }
                            ?>
                            {{ number_format($purchase_price) }}円
                        </td>
                    </tr>
                    <tr>
                        <td><button class="btn btn-primary" style="color: black; background: lightgray; border: lightgray; white-space: nowrap;" onclick="location.href='{{ route('products.index') }}'">戻る</button></td>
                        <td style="text-align: right"><button class="btn btn-primary" style="background: blue; white-space: nowrap;" onclick="location.href='{{ route('products.edit', ['product' => $product->id]) }}'">編集</button></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>
@endsection