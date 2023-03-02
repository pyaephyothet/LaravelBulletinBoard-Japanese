@extends('common')

@section('content')
    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-4 mx-auto">
                <div class="card border border-dark rounded-0">
                    <div class="card-body d-flex flex-column align-items-center">
                        <form action="{{ route('user#pwChange') }}" method="POST" class="d-flex flex-column gap-3 mb-3 w-100">
                            @csrf
                            <label class="d-block text-center heading">社内OJT<br><span>Bulletin Board</span></label>
                            <input type="password" class="button" placeholder="現 在 パスワード" name="currentPwd"
                                value="{{ old('currentPwd') }}">
                            @error('currentPwd')
                                <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                            @enderror
                            <input type="password" class="button" placeholder="新しい パスワード" name="newPwd"
                                value="{{ old('newPwd') }}">
                            @error('newPwd')
                                <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                            @enderror
                            <input type="password" class="button" placeholder="確 認 パスワード" name="confirmPwd"
                                value="{{ old('confirmPwd') }}">
                            @error('confirmPwd')
                                <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                            @enderror
                            <button type="submit" class="btn login-btn">更新</button>
                            <a href="{{ route(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()) }}"
                                class="d-block text-primary font-bold link text-center text-decoration-underline small-font-size">戻る</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
