@extends('layouts.app')

@section('content')
<div class="container">
    <div class="productTable">
        <h2 class="text-center" style="margin-bottom: 30px">管理者ページ</h2>
        <button class='btn' style="background: lightgray" onclick="location.href='{{ route('products.index') }}'">管理商品一覧</button>

        @if (!empty($users))
            <div class="productTable" style="margin-top: 30px">
                <p class="item_info">登録ユーザー</p>
                <table class="table table-hover">
                    <thead style="background-color: #ffd900">
                    <tr>
                        <th>ユーザID</th>  
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>登録日</th>
                        <th>更新日</th>
                    </tr>
                    </thead>
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
        @endif
        
    </div>
</div><br>
<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection
