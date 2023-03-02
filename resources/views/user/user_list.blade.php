@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid user-list">
        <h2 class="page-ttl my-4">ユーザー管理</h2>
        <div class="list_form mb-5">
            <form action="{{ route('user#search') }}" method="GET" class="search-form p-4 text-center">
                <div class="input-gp mb-3">
                    <input type="text" placeholder="氏名" name="searchName">
                    <input type="email" placeholder="メールアドレス" name="searchEmail">
                    <select class="form-select rounded-0 border
                        border-dark"
                        aria-label="Default select example" name="searchRole">
                        <option value="" selected>権限種別</option>
                        <option value="0">アドミン</option>
                        <option value="1">ユーザー</option>
                    </select>
                    <input id="date" type="text" placeholder="作成日FROM" onfocus="(this.type='date')"
                        onblur="(this.type='text')" name="searchFrom">
                    <input id="date" type="text" placeholder="作成日TO" onfocus="(this.type='date')"
                        onblur="(this.type='text')" name="searchTo">
                </div>
                <div class="gp-btn">
                    <a href="{{ route('user#userList') }}" class="btn back-btn rounded-0">クリア</a>
                    <button type="submit" class="btn">検索</button>
                </div>
            </form>
        </div>
        <div class="user-list_table mb-5">
            <div class="user-list_management d-flex justify-content-between">
                <p class="result">検索結果：<span class="ms-2">{{ $userCount }}</span>件</p>
                <div class="add-remove d-flex gap-5">
                    <a href="#" class="d-block text-primary btn-link" data-bs-toggle="modal"
                        data-bs-target="#delete-confirm"><i class="bi bi-person-x-fill me-2"></i>選択したユーザーを削除</a>

                    <a href="/user/user_create" class="d-block text-primary btn-link"><i
                            class="bi bi-person-fill-add me-2"></i>新規作成</a>
                </div>
            </div>
            <form action="{{ route('user#delete') }}" method="POST">
                @csrf
                <table class="table table-bordered border-dark text-center">
                    <thead>
                        <tr>
                            <th scope="col">選択</th>
                            <th scope="col"><span>氏名</span><span>メールアドレス</span></th>
                            <th scope="col"><span>生年月日</span><span>携帯電話</span></th>
                            <th scope="col">住所</th>
                            <th scope="col"><span>権限種別</span><span>生成者</span></th>
                            <th scope="col"><span>生成日</span><span>更新日</span></th>
                            <th scope="col">編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userList as $user)
                            <tr>
                                <th scope="row"><input class="form-check-input mt-0 border border-dark w-25"
                                        type="checkbox" name="ids[{{ $user->id }}]" value="{{ $user->id }}"></th>
                                <td><span>{{ $user->name }}</span><span>{{ $user->email }}</span></td>
                                <td><span>{{ \Carbon\Carbon::create($user->dob)->format('Y/m/d') }}</span><span>{{ $user->phone }}</span>
                                </td>
                                <td class="address-field">{{ $user->address }}</td>
                                <td><span>{{ $user->role == 0 ? 'アドミン' : 'ユーザー' }}</span><span>{{ $user->create_user }}</span>
                                </td>
                                <td><span>{{ \Carbon\Carbon::create($user->created_at)->format('Y/m/d') }}</span><span>{{ \Carbon\Carbon::create($user->updated_at)->format('Y/m/d') }}</span>
                                </td>
                                <td><a href="{{ route('user#edit', $user->id) }}"
                                        class="d-block text-primary btn-link">編集</a></td>
                            </tr>
                        @endforeach
                        <!-- Modal -->
                        <div class="modal fade" id="delete-confirm" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content w-75">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close rounded-pill" data-bs-dismiss="modal"
                                            aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                    </div>
                                    <div class="modal-body text-center font-bold">
                                        選択したユーザーを削除します。
                                    </div>
                                    <div class="modal-footer border-0 d-flex justify-content-center">
                                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">キャンセル</button>
                                        <button type="submit" class="btn delete-btn bg-danger">削除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </form>
            <div class="d-flex justify-content-center">
                {!! $userList->appends(request()->except('page'))->links() !!}
            </div>
        </div>
    </div>
@endsection
