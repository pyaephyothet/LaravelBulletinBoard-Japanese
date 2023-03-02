@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid form-deco">
        <h2 class="page-ttl my-4">ユーザープロフェイル</h2>
        <div class="my-form mb-5">
            <form action="" method="" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered border-dark">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center"><label>氏名</label></th>
                            <td class="p-3">
                                <p class="mb-0"><input type="text" name="name" value="{{ $profile['name'] }}"
                                        readonly>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>メールアドレス</label></th>
                            <td class="p-3">
                                <p class="mb-0"><input type="text" name="email" value="{{ $profile['email'] }}"
                                        readonly></p>
                            </td>
                        </tr>
                        <tr class="@if (auth()->user()->role == 1) d-none @endif">
                            <th scope="row" class="text-center"><label>権限種別</label></label></label></label></th>
                            <td class="p-3">
                                <input type="hidden" name="role" value="{{ $profile['role'] }}" readonly>
                                <p class="mb-0 ms-3">
                                    @if ($profile['role'] == '1')
                                        ユーザー
                                    @else
                                        アドミン
                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>生年月日</label></th>
                            <td class="p-3">
                                <p class="mb-0"><input type="text" name="dob" value="{{ $profile['dob'] }}"
                                        readonly>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>携帯電話番号</label></th>
                            <td class="p-3">
                                <p class="mb-0"><input type="text" name="phone" value="{{ $profile['phone'] }}"
                                        readonly></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>住所</label></th>
                            <td class="p-3">
                                <p class="mb-0"><input type="text" name="address" value="{{ $profile['address'] }}"
                                        readonly></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>プロファイル</label></th>
                            <td class="p-3">
                                <input type="hidden" name="profile" value="{{ $profile['profile'] }}" readonly>
                                <div class="preview ms-3">
                                    <img src="{{ asset('storage/' . $id . '/' . $profile['profile']) }}">
                                </div>
                            </td>
                        </tr>
                        {{-- <tr>
                            <th scope="row" class="text-center"><label>パスワード</label></th>
                            <td class="p-3">
                                <p class="mb-0"><input type="password" name="password" value="{{ $profile['password'] }}"
                                        readonly></p>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="gp-btn">
                    <a href="{{ route(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()) }}"
                        class="btn back-btn rounded-0">戻る</a>
                </div>
            </form>
        </div>
    </div>
@endsection
