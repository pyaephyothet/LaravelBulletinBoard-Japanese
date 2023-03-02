@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid form-deco">
        <h2 class="page-ttl my-4">新規投稿確認</h2>
        <div class="my-form mb-5">
            <form id="clearCreateForm" action="{{ route('post#store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered border-dark">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center"><label>投稿タイトル</label></th>
                            <td class="p-3">
                                <p><input class="mt-0 border border-dark  p-3" type="text" placeholder="title..."
                                        name="title" value="{{ $postCreateConfirm['title'] }}" readonly></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>投稿内容</label></th>
                            <td class="p-3">
                                <p>
                                    <textarea class="post-area mt-0 border border-dark  p-3" type="text" placeholder="description..." name="description"
                                        value="{{ $postCreateConfirm['description'] }}" rows="7" readonly>{{ $postCreateConfirm['description'] }}</textarea>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>公開ステータス</label></label></label></label></th>
                            <td class="p-3">
                                <input type="hidden" name="status" value="{{ $postCreateConfirm['status'] }}" readonly>
                                <p class="mb-0 ms-3 " style="font-size: 1rem;">
                                    @if ($postCreateConfirm['status'] == '1')
                                        公開
                                    @else
                                        非公開
                                    @endif
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="gp-btn">
                    <a href="{{ route('post#create') }}" class="btn back-btn rounded-0">戻る</a>
                    <button type="submit" class="btn">登録</button>
                </div>
            </form>
        </div>
    </div>
@endsection
