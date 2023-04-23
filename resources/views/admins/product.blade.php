@extends('layouts.app')

@section('content')

<div class="title1">登録商品一覧</div><br>

<div class="container">
    <div class="row justify-content-center">

    <div>
    <a href="{{ route('create.product') }}">
        <buttton type='button' class='btn btn-secondary'>商品登録</button>
    </a><div><br>
        
        <table border='1' cellpadding="15">
            <tr>
                <th>商品ID</th>  
                <th>商品名</th>
                <th>価格</th>
                <th>カテゴリー</th>
                <th>登録日</th>
                <th>更新日</th>
            </tr>
                @foreach($products as $product)
                <?php $i = 1; ?>
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    @foreach($types as $type)
                        @if($product['type_id'] === $type['id'])
                            @if($i == 1)
                            <td>{{ $type['name'] }}</td>
                            <?php $i++; ?>
                            @endif
                        @endif
                    @endforeach
                    <td>{{ $product['created_at'] }}</td>
                    <td>{{ $product['updated_at'] }}</td>

                    <td><a href="{{ route('edit.product', ['product' => $product['id']]) }}">
                        編集</a>　|　
                        <a href="{{ route('product.delete', ['product' => $product['id']]) }}" onclick="return confirm('削除します。よろしいですか？')">
                        削除</a>
                    </td>
                </tr>
                
                @endforeach
        </table>
    </div>
    <br>
<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
</div>
@endsection
<script src="{{ asset('js/delete.js') }}"></script>