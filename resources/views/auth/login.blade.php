@extends('common')

@section('content')
    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-4 mx-auto">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible alert-msg fade show py-2" role="alert">
                        <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close py-2 alert-btn" data-bs-dismiss="alert" aria-label="Close"> <i
                                class="bi bi-file-excel-fill"></i></button>
                    </div>
                @endif
                <div class="card border border-dark rounded-0">
                    <div class="card-body d-flex flex-column align-items-center">
                        <form action="{{ route('user#login') }}" method="POST" class="d-flex flex-column gap-3 mb-3 w-100">
                            @csrf
                            <label class="d-block text-center heading">社内OJT<br><span>Bulletin Board</span></label>
                            <input type="email" class="button" placeholder="メールアドレス" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                            @enderror
                            <input type="password" class="button" placeholder="パスワード" name="password"
                                value="{{ old('password') }}">
                            @error('password')
                                <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                            @enderror
                            @if (session('error'))
                                <div class="text-danger text-sm" style="font-size: 0.8rem;">
                                    <b>{{ session('error') }}</b>
                                </div>
                            @endif
                            <button type="submit" class="btn login-btn">ログイン</button>
                        </form>
                        <a href="{{ route('user#forgetPwd') }}"
                            class="d-block text-primary font-bold link">パスワードをお忘れの方はこちら</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
