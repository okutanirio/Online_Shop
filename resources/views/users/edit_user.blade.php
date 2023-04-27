@extends('layouts.app')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>会員登録変更</h1>
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

                        <form action="{{ route('edit.user',['id' => $user['id']])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for='name'>名前</label>
                                <input type='text' class='form-control' name='name' value="{{ $user['name'] }}"/>
                            <label for='email' class='mt-2'>メールアドレス</label>
                                <input type='email' class='form-control' name='email' id='email' value="{{ $user['email'] }}"/>

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