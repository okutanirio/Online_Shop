<div>新規のお問い合わせ</div>
<br>
<div>■お名前 : {{ $request->name }}</div>
<br>
<div>■メールアドレス : {{ $request->email }}</div>
<br>
<div>■お問い合わせ内容</div>
<div>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</div>
<div>{!! nl2br(e($request->message)) !!}</div>
<div>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</div>