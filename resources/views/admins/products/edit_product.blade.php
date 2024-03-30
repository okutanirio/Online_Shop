@extends('layouts.app')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            {{-- 成功メッセージ --}}
            @if (session('flash_message'))
                <div class="review_complete" style="margin-bottom: 20px">{{ session('flash_message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>編集</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class='panel-body'>
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

                            <label for='price' class='mt-2'>在庫数</label>
                                <input type='number' min="1" class='form-control' name='stock' id='stock' value="{{ old('stock', $result['stock']) }}"/>
                                @error('stock') <div class="alert alert-danger">{{ $message }}</div> @enderror

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
                            <textarea class='form-control' style="height: 100px" name='info'>{{ old('info', $result['info']) }}</textarea>
                            @error('info') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='description' class='mt-2'>商品説明</label>
                            <textarea class='form-control' style="height: 100px" name='description'>{{ old('description', $result['description']) }}</textarea>
                            @error('description') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                            <label for='image' class='mt-2'>画像</label><br>
                            @if (!empty($result['image']))
                            <input type="hidden" name="old_image" value="on">
                            <input type="hidden" name="image" value="{{ $result['image'] }}">
                                <div style="margin-bottom: 20px">
                                    <input type="submit" value="削除" name="image_delete" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                                </div>

                                <img src="{{ asset($result['image']) }}" height="250px" width="250px">
                            @else
                                <input type='file' name='image' id='image' value=""/>
                                @error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            @endif

                            <div class='row justify-content-center'>
                                <a class='btn btn-primary w-25 mt-3' id="product_back" href='{{ route('products.detail', $result['id']) }}'>戻る</a>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>更新</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<script src="{{ asset('js/delete.js') }}"></script>