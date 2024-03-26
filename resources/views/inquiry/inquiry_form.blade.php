@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        {{-- 成功メッセージ --}}
        @if (session('flash_message'))
            <div class="review_complete" style="margin-bottom: 20px">{{ session('flash_message') }}</div>
        @endif
        <form action="{{ route('inquiry.inquiry_send') }}" name="inquity_send" method="POST">
        @csrf
        {{-- お問い合わせフォーム --}}
        <fieldset class="info_field">
            <p class="item_info">お問い合わせフォーム</p>

            <div class='form-group'>
                <input class='form-control' type='text' name="name" value="{{ old('name') }}" style="padding-left: 10px;" placeholder='お名前'>
                @error('name') <span class="form-error text-red"> {{ $message }} </span> @enderror
            </div>
            <div class='form-group'>
                <input class='form-control' type='email' name="email" value="{{ old('email') }}" style="padding-left: 10px;" placeholder='メールアドレス'>
                @error('email') <span class="form-error text-red"> {{ $message }} </span> @enderror
            </div>
            <div class='form-group'>
                <textarea class='form-control' maxlength="" type='text' name="message" value="{{ old('message') }}" style="padding-left: 10px; height: 100px" placeholder='お問い合わせ内容'></textarea>
                @error('message') <span class="form-error text-red"> {{ $message }} </span> @enderror
            </div>
            <button type="submit" class='btn btn-primary' style="margin-left: 50%">送信</button><br>
        </fieldset>
        </form>
    </div>
</main>

@endsection