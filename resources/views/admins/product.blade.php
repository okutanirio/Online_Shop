@extends('layouts.app')

@section('content')

<div class="title1">登録商品一覧</div><br>

<div class="container">
    <div class="row justify-content-center">

    <div>
    <a href="{{ route('products.create') }}">
        <buttton type='button' class='btn btn-secondary'>商品登録</button>
    </a><div><br>
        
        <table border='1' cellpadding="15">
            <tr>
                <th>商品ID</th>
                <th>画像</th>
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
                    <td><img src="{{ asset($product['image']) }}" height="60px" width="60px"></td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ number_format($product['price']) }}</td>
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

                    <td><a href="{{route('products.edit', ['product' => $product['id']]) }}">
                            <button class="btn btn-dark" style="background: blue">編集</button></a>　|　
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
    <br>
<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
</div>
@endsection
<script src="{{ asset('js/delete.js') }}"></script>