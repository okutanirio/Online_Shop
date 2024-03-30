@extends('layouts.app')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>商品登録</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        {{-- <div class='panel-body'>
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div> --}}

                        <div class='panel-body'>
                        <form action="{{ route('products.store')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <label for='name'>商品名</label>
                                <input type='text' class='form-control' name='name' value="{{ old('name') }}"/>
                            @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='price' class='mt-2'>値段</label>
                                <input type='text' class='form-control' name='price' id='price' value="{{ old('price') }}"/>
                                @error('price') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='price' class='mt-2'>在庫数</label>
                                <input type='number' min="1" class='form-control' name='stock' id='stock' value="{{ old('stock') }}"/>
                                @error('stock') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='type' class='mt-2'>カテゴリ</label>
                            <select name='type_id' class='form-control'>
                                <option value='' hidden>カテゴリ</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}" @if(old('type_id') == $type->id) selected @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            <label for='info' class='mt-2'>商品情報</label>
                                <textarea class='form-control' style="height: 100px" name='info'>{{ old('info') }}</textarea>
                                @error('info') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            <label for='description' class='mt-2'>商品説明</label>
                                <textarea class='form-control' style="height: 100px" name='description'>{{ old('description') }}</textarea>
                                @error('description') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='image' class='mt-2'>画像</label><br>
                                <input type='file' name='image' id='image' value=""/>
                                @error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <div class='row justify-content-center'>
                                <a class='btn btn-primary w-25 mt-3' id="product_back" href='{{ route('products.index') }}'>戻る</a>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection