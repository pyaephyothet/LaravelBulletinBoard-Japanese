@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid post-list">
        <h2 class="page-ttl my-4">投稿管理</h2>
        <div class="list_form mb-5">
            <form action="{{ route('post#postList') }}" method="GET"
                class="search-form p-4 d-flex justify-content-center align-items-center">
                <div class="input-gp me-4 w-25">
                    <input type="text" placeholder="検索 。。。" class="w-50" name="searchText">
                    <select class="form-select rounded-0 border border-dark w-50" aria-label="Default select example"
                        name="searchStatus">
                        <option value="" selected>ステータス</option>
                        <option value="0">非公開</option>
                        <option value="1">公開</option>
                    </select>
                </div>
                <div class="gp-btn w-25">
                    <a href="{{ route('post#postList') }}" class="btn back-btn rounded-0 w-50">クリア</a>
                    <button type="submit" class="btn w-50">検索</button>
                </div>
            </form>
        </div>
        <div class="post-list_table mb-5">
            <div class="post-list_management d-flex justify-content-between">
                <p class="result">検索結果：<span class="ms-2">{{ $postCount }}</span>件</p>
                <div class="add-remove d-flex gap-5">
                    <a href="{{ route('post#csv') }}" class="d-block text-primary btn-link"><i
                            class="bi bi-arrow-up-circle-fill me-2"></i>アップロード</a>
                    <a href="{{ route('post#export') }}" class="d-block text-primary btn-link"><i
                            class="bi bi-arrow-down-circle-fill me-2"></i>ダウンロード</a>
                    <a href="{{ route('post#create') }}" class="d-block text-primary btn-link"><i
                            class="bi bi-person-fill-add me-2"></i>新規作成</a>
                </div>
            </div>
            <form action="" method="POST">
                @csrf
                <table class="table table-bordered border-dark text-center">
                    <thead>
                        <tr>
                            <th scope="col">タイトル</th>
                            <th scope="col" class="post-column">投稿内容</th>
                            <th scope="col"><span>投稿ユーザ</span><span>投稿日</span></th>
                            <th scope="col"><span>更新ユーザ</span><span>更新日</span></th>
                            <th scope="col">ステータス</th>
                            <th scope="col">編集／削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postList as $post)
                            <tr>
                                <th scope="row">{{ $post->title }}</th>
                                <td>{{ $post->description }}</td>
                                <td><span>{{ $post->create_user }}</span><span>{{ \Carbon\Carbon::create($post->created_at)->format('Y/m/d') }}</span>
                                </td>
                                <td><span>{{ $post->updated_user }}</span><span>{{ \Carbon\Carbon::create($post->updated_at)->format('Y/m/d') }}</span>
                                </td>
                                <td class="address-field">
                                    @if ($post->status == '1')
                                        公開
                                    @else
                                        非公開
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('post#edit', $post->id) }}"
                                        class="d-inline text-primary btn-link me-2">編集</a>
                                    <a href="" class="d-inlinetext-primary btn-link" data-bs-toggle="modal"
                                        data-bs-target="#delete-confirm">削除</a>
                                </td>
                            </tr>
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
                                            選択した投稿を削除します。
                                        </div>
                                        <div class="modal-footer border-0 d-flex justify-content-center">
                                            <button type="button" class="btn cancel-btn"
                                                data-bs-dismiss="modal">キャンセル</button>
                                            <a href="{{ route('post#delete', $post->id) }}"
                                                class="btn delete-btn rounded-0 bg-danger">削除</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
            </form>
            <div class="d-flex justify-content-center">
                {!! $postList->appends(request()->except('page'))->links() !!}
            </div>
        </div>
    </div>
@endsection
