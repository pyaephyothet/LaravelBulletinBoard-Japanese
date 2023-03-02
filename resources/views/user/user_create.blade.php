@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid form-deco">
        <h2 class="page-ttl my-4">ユーザー情報新規作成</h2>
        <div class="my-form mb-5">
            <form id="clearCreateForm" action="{{ route('user#createConfirm') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered border-dark">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center"><label>氏名</label></th>
                            <td class="p-3 d-flex align-items-center">
                                <input class="mt-0 border border-dark  p-3" type="text" placeholder="Pyae Phyo Thet"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>メールアドレス</label></th>
                            <td class="p-3 d-flex align-items-center">
                                <input class="mt-0 border border-dark  p-3" type="email"
                                    placeholder="pyaephyothet@gmail.com" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>権限種別</label></label></label></label></th>
                            <td class="p-3 d-flex align-items-center">
                                <select class="form-select rounded-0 border border-dark  p-3"
                                    aria-label="Default select example" name="role">
                                    <option selected="selected" value="{{ old('role') }}">
                                        @if (old('role') == 1)
                                            ユーザー
                                        @elseif (old('role') == null)
                                            権限種別
                                        @else
                                            アドミン
                                        @endif
                                    </option>
                                    <option value="0">アドミン</option>
                                    <option value="1">ユーザー</option>
                                </select>
                                @error('role')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>生年月日</label></th>
                            <td class="p-3 d-flex align-items-center">
                                <input class="mt-0 border border-dark  p-3" type="text" placeholder="1996-11-08"
                                    name="dob" value="{{ old('dob') }}" onfocus="(this.type='date')"
                                    onblur="(this.type='text')">
                                @error('dob')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>携帯電話番号</label></th>
                            <td class="p-3 d-flex align-items-center">
                                <input class="mt-0 border border-dark  p-3" type="text" placeholder="0912345678"
                                    name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>住所</label></th>
                            <td class="p-3 d-flex align-items-center">
                                <textarea class="mt-0 border border-dark  p-3" cols="30" rows="3"
                                    placeholder="Botahtaung Pagoda Road, Between MahaBandula & Merchant Road" name="address">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>プロファイル</label></th>
                            <td class="p-3">
                                <div class=" profile-img d-flex justify-content-between align-items-start">
                                    <div class="image-path">
                                        <input type="text" id="image-path" placeholder="選択されていません" value=""
                                            class="mt-0 border border-dark  p-3" readonly>
                                        <span>【アップロード可能なファイルの拡張子】jpg、jpeg、png</span>
                                    </div>
                                    <label for="image-file">参照</label>
                                    <input type="file" id="image-file" name="profile" onchange="showPreview(event);">
                                    <div class="preview">
                                        <img id="image-file-preview">
                                    </div>
                                </div>
                                @error('profile')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>パスワード</label></th>
                            <td class="p-3 d-flex align-items-center">
                                <input type="password" name="password" class="mt-0 border border-dark  p-3"
                                    placeholder="abc@123" id="id_password" value="{{ old('password') }}">
                                <i class="bi bi-eye-slash-fill" id="togglePassword"
                                    style="margin-left: -30px; cursor: pointer; font-size: 1rem;"></i>

                                @error('password')
                                    <span class="text-danger text-sm ms-3"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>確認パスワード</label></th>
                            <td class="p-3 d-flex align-items-center">

                                <input type="password" name="confirmPwd" class="mt-0 border border-dark  p-3"
                                    placeholder="abc@123" id="id_password02" value="{{ old('confirmPwd') }}">
                                <i class="bi bi-eye-slash-fill" id="togglePassword02"
                                    style="margin-left: -30px; cursor: pointer; font-size: 1rem;"></i>

                                @error('confirmPwd')
                                    <span class="text-danger text-sm ms-3"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="gp-btn">
                    <button class="btn clear-btn"
                        onclick="document.getElementById('clearCreateForm').reset(); return false;">クリア</button>

                    <button type="submit" class="btn">確認</button>
                </div>
            </form>
        </div>
    </div>
@endsection
