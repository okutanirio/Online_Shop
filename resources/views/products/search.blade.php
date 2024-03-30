@extends('layouts.app')

@section('content')

<main>
  <div class="container">
    <div class="mx-auto">
      <br>
      <h2 class="text-center">商品検索画面</h2>
      <br>
      <!--検索フォーム-->
      <div class="row">
        <div class="col-sm">
          <form method="GET" action="{{ route('search')}}">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">商品名</label>
              <!--入力-->
              <div class="col-sm-5">
                <input type="text" class="form-control" name="searchWord" value="{{ $searchWord }}">
              </div>
              <div class="col-sm-auto">
                <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('search') }}'">クリア</button>
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
    </div>

    <!--検索結果テーブル 検索された時のみ表示する-->
    @if (!empty($products))
    <div class="productTable">

      <table class="table table-hover">
        <thead style="background-color: #ffd900">
          <tr>
            <th style="width:5%"></th>
            <th>商品名</th>
            <th>商品カテゴリ</th>
            <th>価格</th>
            <th></th>
          </tr>
        </thead>
        @foreach($products as $product)
        <tr>
          <td><img src="{{ asset($product['image']) }}" height="50px" width="50px"></td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->type->name }}</td>
          <td>{{ number_format($product->price) }}円</td>
          <td><a href="{{ route('products.show', ['product' => $product['id']]) }}" class="btn btn-primary btn-sm">商品詳細</a></td>
        </tr>
        @endforeach   
      </table>
    </div>
    <!--テーブルここまで-->
    <!--ページネーション-->
    <div class="d-flex justify-content-center">
      {{-- appendsでカテゴリを選択したまま遷移 --}}
      {{ $products->appends(request()->input())->links() }}
    </div>
    <!--ページネーションここまで-->
    @endif
  </div>
</main>

@endsection