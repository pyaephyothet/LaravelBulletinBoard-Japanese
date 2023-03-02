@extends('common')
@extends('navbar')
@section('content')
    <div class="container-fluid">
        <h2 class="page-ttl my-5">ホームページ</h2>
        <div class="wrapper vh-100 pt-3">
            <div class="row row-cols-1 row-cols-md-5 justify-content-center align-items-center mt-5">
                <div class="col mb-4 @if (auth()->user()->role == 1) d-none @endif">
                    <div class="card border border-dark rounded-0">
                        <div class="card-body gap-3 text-center">
                            <h5 class="card-title home-ttl">ユーザー数</h5>
                            <p class="card-text home-count">{{ $userCount }}<small>件</small></p>
                            <a href="{{ route('user#userList') }}" class="d-block text-primary font-bold link">ユーザー管理へ</a>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 @if (auth()->user()->role == 1) d-none @endif">
                    <div class="card border border-dark rounded-0">
                        <div class="card-body gap-3 text-center">
                            <h5 class="card-title home-ttl">投稿数</h5>
                            <p class="card-text home-count">{{ $postCount }}<small>件</small></p>
                            <a href="{{ route('post#postList') }}" class="d-block text-primary font-bold link">投稿管理へ</a>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card border border-dark rounded-0">
                        <div class="card-body gap-3 text-center">
                            <h5 class="card-title home-ttl">自分の投稿数</h5>
                            <p class="card-text home-count">{{ $userPostCount }}<small>件</small></p>
                            <a href="{{ route('post#create') }}" class="d-block text-primary font-bold link">新規投稿</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
