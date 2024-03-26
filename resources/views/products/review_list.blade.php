@extends('layouts.app')

@section('content')

<main>
  <div class="container">
    <div class="productTable">
      <h2 class="text-center" style="margin-bottom: 30px">REVIEW</h2>

      @if (!$reviews->isEmpty())
        <table class="table table-hover">
          <thead style="background-color: #ffd900">
            <tr>
              <th>投稿日</th>
              <th>投稿者名</th>
              <th>評価</th>
              <th>コメント</th>
            </tr>
          </thead>
          @foreach($reviews as $review)
            <tr>
              <td>{{ date('Y/m/d H:i:s', strtotime($review->created_at)) }}</td>
              <td>{{ $review->name }}</td>
              <td>
                <?php 
                    $star = [1 => '★', 2 => '★★', 3 => '★★★', 4 => '★★★★', 5 => '★★★★★'];
                ?>
                @for ($i = 1; $i <= 5; $i++)
                  @if ($review->evaluation == $i)
                    <span style="color: gold; font-size: 18px">{{ $star[$i] }}</span>
                  @endif
                @endfor
              </td>
              <td>{!! nl2br(e($review->comment)) !!}</td>
            </tr>
          @endforeach   
        </table>
      </div>
      <!--ページネーション-->
      <div class="d-flex justify-content-center">
        {{ $reviews->appends(request()->input())->links() }}
      </div>
      <!--ページネーションここまで-->
      @else
        <div style="text-align: center">投稿がありません。</div>
      @endif
    <button class='btn' style="background: lightgray" onclick="history.back()">戻る</button>
  </div>
</main>

@endsection