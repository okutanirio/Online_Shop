@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="title1">管理者ページ</div>

        <div class="item_list">
            <a href="{{ route('products.index') }}"><div class="item1">管理商品一覧</div></a>
        </div>
        </div>

        <table border='1' cellpadding="15">
            <tr>
                <th>ユーザID</th>  
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>登録日</th>
                <th>更新日</th>
                
            </tr>
                @foreach($users as $user)
                @if($user['role'] == 0)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['created_at'] }}</td>
                    <td>{{ $user['updated_at'] }}</td>
                </tr>
                @endif
                @endforeach
        </table>
        
    </div>
</div><br>
<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection
