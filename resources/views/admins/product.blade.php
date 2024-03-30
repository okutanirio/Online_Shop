@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        {{-- 成功メッセージ --}}
        @if (session('flash_message'))
            <div class="review_complete" style="margin-bottom: 20px">{{ session('flash_message') }}</div>
        @endif

        <fieldset class="info_field">
            <p class="item_info">登録商品一覧</p>
            <button class='btn' style="background: lightgray" onclick="location.href='{{ route('products.create') }}'">商品登録</button>

            @if (!empty($products))
                <!--検索フォーム-->
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm">
                    <form method="GET" action="{{ route('products.index')}}">
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">商品名</label>
                        <!--入力-->
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="searchWord" value="{{ $searchWord }}">
                        </div>
                        <div class="col-sm-auto">
                            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('products.index') }}'">クリア</button>
                            <button type="submit" class="btn btn-primary" style="margin-left: 10px">検索</button>
                        </div>
                        </div>     
                        <!--プルダウンカテゴリ選択-->
                        <div class="form-group row">
                        <label class="col-sm-2">商品カテゴリ</label>
                        <div class="col-sm-3">
                            <select name="category" class="form-control" value="">
                                <option value="">未選択</option>                    

                            @foreach($types as $id => $name)
                                <option value="{{ $id }}" @if($category == $id) selected @endif>
                                    {{ $name }}
                                </option>  
                            @endforeach
                            </select>
                            </div>
                            <div>
                                <label for="">価格</label>
                                <input type="text" name="minprice" placeholder="￥1000" value="{{ $min }}">
                                    <span class="mx-3">~</span>
                                <input type="text" name="maxprice" placeholder="￥1000" value="{{ $max }}">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            
                <div class="productTable" style="margin-top: 30px">
                    <table class="table table-hover">
                        <thead style="background-color: #ffd900">
                        <tr>
                            <th class="nowraps">商品ID</th>
                            <th class="nowraps">画像</th>
                            <th class="nowraps">商品名</th>
                            <th class="nowraps">価格</th>
                            <th class="nowraps">在庫数</th>
                            <th class="nowraps">カテゴリー</th>
                            <th class="nowraps">登録日</th>
                            <th class="nowraps">更新日</th>
                            <th></th><th></th>
                        </tr>
                        </thead>
                        @foreach($products as $product)
                            <?php $i = 1; ?>
                            <tr>
                                <td>{{ $product['id'] }}</td>
                                <td><img src="{{ asset($product['image']) }}" height="60px" width="60px"></td>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ number_format($product['price']) }}</td>
                                <td>{{ $product['stock'] }}</td>
                                <td>
                                    <?php
                                        $types = [1 => 'ピアス', 2 => 'ネックレス', 3 => 'リング', 4 => 'ブレスレット'];
                                    ?>
                                    @for ($i = 1; $i <= 4; $i++)
                                        @if ($product['type_id'] == $i)
                                            {{ $types[$i] }}
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $product['created_at'] }}</td>
                                <td>{{ $product['updated_at'] }}</td>

                                <td><a href="{{route('products.detail', $product['id']) }}">
                                    <button class="btn btn-dark" style="background: blue; white-space: nowrap">詳細</button></a>
                                </td>
                                <td>
                                    <form action="{{route('products.destroy', ['product' => $product['id']]) }}" method="post" class="float-right">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
            <button class='btn' style="background: lightgray" onclick="location.href='{{ route('admin') }}'">戻る</button>
        </fieldset>
    </div>
</main>

<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
</div>
@endsection
<script src="{{ asset('js/delete.js') }}"></script>