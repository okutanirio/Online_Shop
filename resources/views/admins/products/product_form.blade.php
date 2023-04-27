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

                        <div class='panel-body'>
                        <form action="{{ route('products.store')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <label for='name'>商品名</label>
                                <input type='text' class='form-control' name='name' value="{{ old('name') }}"/>
                            
                            <label for='price' class='mt-2'>値段</label>
                                <input type='text' class='form-control' name='price' id='price' value="{{ old('price') }}"/>
                            
                            <label for='type' class='mt-2'>カテゴリ</label>
                            <select name='type_id' class='form-control'>
                                <option value='' hidden>カテゴリ</option>
                                @foreach($types as $type)
                                <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                @endforeach
                            </select>

                            <label for='description' class='mt-2'>商品説明</label>
                                <textarea class='form-control' name='description'>{{ old('description') }}</textarea>
                            
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