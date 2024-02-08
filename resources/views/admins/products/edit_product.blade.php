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
                            {{-- @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif --}}
                        </div>

                        <form action="{{ route('products.update',['product' => $id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for='name'>商品名</label>
                                <input type='text' class='form-control' name='name' value="{{ old('name', $result['name']) }}"/>
                                @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            <label for='price' class='mt-2'>価格</label>
                                <input type='text' class='form-control' name='price' id='price' value="{{ old('price', $result['price']) }}"/>
                                @error('price') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            <label for='type' class='mt-2'>カテゴリ</label>
                            <select name='type_id' class='form-control'>
                                <option value='' hidden>カテゴリ</option>
                                @foreach($types as $type)
                                    @if($type['id'] == $result['type_id'])
                                        <option value="{{ $type['id'] }}" selected>{{ $type['name'] }}</option>
                                    @else 
                                    <option value="{{ $type['id'] }}" @if(old('type_id') == $type['id']) selected @endif>{{ $type['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('type_id') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            <label for='info' class='mt-2'>商品情報</label>
                            <textarea class='form-control' style="height: 100px" name='info'>{{ old('info') }}</textarea>
                            @error('info') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='description' class='mt-2'>商品説明</label>
                            <textarea class='form-control' name='description'>{{ $result['description'] }}</textarea>
                            @error('description') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='image' class='mt-2'>画像</label><br>
                            <input type='file' name='image' id='image' value=""/>
                            @error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror

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