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
                <div class="productTable" style="margin-top: 30px">
                    <p class="item_info">登録ユーザー</p>
                    <table class="table table-hover">
                        <thead style="background-color: #ffd900">
                        <tr>
                            <th>商品ID</th>
                            <th>画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>カテゴリー</th>
                            <th>登録日</th>
                            <th>更新日</th>
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
        </fieldset>
    </div>
</main>

<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
</div>
@endsection
<script src="{{ asset('js/delete.js') }}"></script>