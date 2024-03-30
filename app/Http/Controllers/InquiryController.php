<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InquiryRequest;
use App\Mail\InquirySend;
use App\Mail\InquiryFrom;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    // お問い合わせフォーム
    public function inquiry_form() {
        return view('inquiry.inquiry_form');
    }

    // お問い合わせ送信
    public function inquiry_send(InquiryRequest $request) {
        Mail::send(new InquirySend($request));
        Mail::send(new InquiryFrom($request));

        return redirect()->back()->with('flash_message', 'お問い合わせが完了しました。');
    }

}
