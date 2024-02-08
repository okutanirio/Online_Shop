@extends('layouts.app')

@section('content')

    <main>
        <div class="container">
            <div class="jumbotron bg-white">
                <h1 class="text-center">商品情報</h1>
                <div class="item_img">
                    <img width="300px" height="400px" src="{{ asset($product['image']) }}">
                </div>
                <div class="item_name">
                    <h3 class="my-4 text-left">
                        {{ $product['name'] }}
                    </h3>
                </div>
                <div class="item_price">
                    <p class="mt-4 mb-5">￥{{ $product['price'] }}
                    </p>
                </div>

                <div class="item_cart">
                    <a href="{{ route('cart', ['product' => $product['id']]) }}">
                        <button class='btn btn-primary'>カートに入れる</button>
                    </a>
                </div>
                @Auth

                    <div class="item_cart review_btn">
                        {{-- <a href="{{ route('cart', ['product' => $product['id']]) }}"> --}}
                            <button class='btn btn-primary'>レビューを見る</button>
                        {{-- </a> --}}
                    </div>

                    @if($like_model->like_exist(Auth::user()->id,$product->id))
                    <div class="like_position">
                        <p class="favorite-marke">
                        <a class="js-like-toggle loved" href="" data-product_id="{{ $product->id }}"><i class="fas fa-heart"></i></a>
                        </p>
                    </div>
                    @else
                    <div class="like_position">
                        <p class="favorite-marke">
                        <a class="js-like-toggle" href="" data-product_id="{{ $product->id }}"><i class="fas fa-heart"></i></a>
                        </p>
                    </div>
                    @endif
                @endauth

                <div class="item_detail">
                    <p class="item_info">ITEM DETAIL</p>
                        <p class="item_info2">
                            {{ $product['description'] }}
                        </p>
                </div>
            </div>
        </div>
    </main>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(function () {
    var like = $('.js-like-toggle');
    var likeProductId;
    
    like.on('click', function () {
        var $this = $(this);
        likeProductId = $this.data('product_id');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajaxlike',  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                data: {
                    'product_id': likeProductId //コントローラーに渡すパラメーター
                },
        })
    
            // Ajaxリクエストが成功した場合
            .done(function (data) {
    //lovedクラスを追加
                $this.toggleClass('loved'); 
    
    //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                $this.next('.likesCount').html(data.productLikesCount); 
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
    //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
    //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });
        
        return false;
    });
    });
</script>