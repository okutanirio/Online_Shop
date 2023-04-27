@extends('layouts.app')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>編集</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class='panel-body'>
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>

                        <form action="{{ route('products.update',['product' => $id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for='name'>商品名</label>
                                <input type='text' class='form-control' name='name' value="{{ $result['name'] }}"/>
                            <label for='price' class='mt-2'>価格</label>
                                <input type='text' class='form-control' name='price' id='price' value="{{ $result['price'] }}"/>
                            <label for='type' class='mt-2'>カテゴリ</label>
                            <select name='type_id' class='form-control'>
                                <option value='' hidden>カテゴリ</option>
                                @foreach($types as $type)
                                    @if($type['id'] == $result['type_id'])
                                        <option value="{{ $type['id'] }}" selected>{{ $type['name'] }}</option>
                                    @else 
                                    <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            
                                <label for='description' class='mt-2'>商品説明</label>
                                <textarea class='form-control' name='description'>{{ $result['description'] }}</textarea>
                            
                            <label for='image' class='mt-2'>画像</label><br>
                                <input type='file' name='image' id='image' value=""/>

                                <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection