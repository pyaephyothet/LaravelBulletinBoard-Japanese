@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid form-deco">
        <h2 class="page-ttl my-4">ユーザー情報編集</h2>
        <div class="my-form mb-5">
            <form id="clearEditForm"
                action="{{ route('user#editConfirm', ['id' => $edit['id'], 'profile' => $edit['profile']]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered border-dark">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center"><label>氏名</label></th>
                            <td class="p-3"><input class="mt-0 border border-dark  p-3" type="text"
                                    placeholder="Pyae Phyo Thet" id="name" name="name" value="{{ $edit['name'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>メールアドレス</label></th>
                            <td class="p-3"><input class="mt-0 border border-dark  p-3" type="email"
                                    placeholder="pyaephyothet@gmail.com" id="email" name="email"
                                    value="{{ $edit['email'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>権限種別</label></label></label></label></th>
                            <td class="p-3">
                                <select class="form-select rounded-0 border border-dark  p-3"
                                    aria-label="Default select example" id="role" name="role">
                                    <option value="{{ $edit['role'] }}">
                                        @if ($edit['role'] == '1')
                                            ユーザー
                                        @else
                                            アドミン
                                        @endif
                                    </option>
                                    <option value="0">アドミン</option>
                                    <option value="1">ユーザー</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>生年月日</label></th>
                            <td class="p-3"><input class="mt-0 border border-dark  p-3" type="text"
                                    placeholder="1996-11-08" id="dob" name="dob" value="{{ $edit['dob'] }}"
                                    onfocus="(this.type='date')" onblur="(this.type='text')">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>携帯電話番号</label></th>
                            <td class="p-3"><input class="mt-0 border border-dark  p-3" type="text"
                                    placeholder="0912345678" id="phone" name="phone" value="{{ $edit['phone'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>住所</label></th>
                            <td class="p-3">
                                <textarea class="mt-0 border border-dark  p-3" cols="30" rows="3"
                                    placeholder="Botahtaung Pagoda Road, Between MahaBandula & Merchant Road" name="address" id="address"
                                    value="{{ $edit['address'] }}">{{ $edit['address'] }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>プロファイル</label></th>
                            <td class="p-3">
                                <div class=" profile-img d-flex justify-content-between align-items-start">
                                    <div class="image-path">
                                        <input type="text" id="profile" placeholder="選択されていません"
                                            class="mt-0 border border-dark  p-3" value="{{ $edit['profile'] }}" readonly>
                                        <span>【アップロード可能なファイルの拡張子】jpg、jpeg、png</span>
                                    </div>
                                    <label for="image-file">参照</label>
                                    <input type="file" id="image-file" name="profile" value="{{ $edit['profile'] }}"
                                        accept="image/*" onchange="showPreview(event);">
                                    <div class="preview">
                                        <img src="{{ asset('storage/' . $edit->id . '/' . $edit->profile) }}"
                                            id="image-file-preview">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- <tr>
                            <th scope="row" class="text-center"><label>パスワード</label></th>
                            <td class="p-3">
                                <input type="password" name="password" value="{{ $edit['password'] }}"
                                    class="mt-0 border border-dark  p-3" autocomplete="current-password"
                                    placeholder="abc@123" id="id_password">
                                <i class="bi bi-eye-slash-fill" id="togglePassword"
                                    style="margin-left: -30px; cursor: pointer; font-size: 1rem;"></i>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>確認パスワード</label></th>
                            <td class="p-3">
                                <input type="password" name="editPwConfirm" value="{{ $edit['password'] }}"
                                    class="mt-0 border border-dark  p-3" autocomplete="current-password"
                                    placeholder="abc@123" id="id_password02">
                                <i class="bi bi-eye-slash-fill" id="togglePassword02"
                                    style="margin-left: -30px; cursor: pointer; font-size: 1rem;"></i>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="gp-btn">
                    <a class="btn clear-btn" onclick="clearEditForm(); return false;">クリア</a>
                    <button type="submit" class="btn">確認</button>
                </div>
            </form>
        </div>
    </div>
@endsection
