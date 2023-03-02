@extends('common')

@section('content')
    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-4 mx-auto">
                <div class="card border border-dark rounded-0">
                    <div class="card-body d-flex flex-column align-items-center">
                        <form action="{{ route('user#resetUpdate') }}" method="POST"
                            class="d-flex flex-column gap-3 mb-3 w-100">
                            @csrf
                            <label class="d-block text-center heading">社内OJT<br><span>Bulletin Board</span></label>
                            <input type="hidden" name="token" id="" value={{ $token }}>
                            <input type="email" class="button" placeholder="メールアドレス" name="email"
                                value="{{ $email ?? old('email') }}" readonly>
                            <input type="password" class="button" placeholder="パスワード" name="password"
                                value="{{ old('password') }}">
                            @error('password')
                                <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                            @enderror
                            {{-- <input type="password" class="button" placeholder="パスワード" name="confirmPwd"
                                value="{{ old('confirmPwd') }}">
                            @error('confirmPwd')
                                <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                            @enderror --}}
                            <button type="submit" class="btn login-btn">パスワードリセット</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
