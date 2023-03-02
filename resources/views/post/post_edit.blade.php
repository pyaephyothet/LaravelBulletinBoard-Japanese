@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid form-deco">
        <h2 class="page-ttl my-4">投稿情報更新</h2>
        <div class="my-form mb-5">
            <form id="clearCreateForm" action="{{ route('post#editConfirm', $edit['id']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered border-dark">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center"><label>投稿タイトル</label></th>
                            <td class="p-3"><input class="mt-0 border border-dark  p-3" type="text"
                                    placeholder="title..." name="title" id="title" value="{{ $edit['title'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>投稿内容</label></th>
                            <td class="p-3">
                                <textarea class="mt-0 border border-dark  p-3" type="text" placeholder="description..." name="description"
                                    id="description" value="{{ old('postDescription') }}" rows="7">{{ $edit['description'] }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>公開ステータス</label></label></label></label></th>
                            <td class="p-3">
                                <select class="form-select rounded-0 border border-dark  p-3"
                                    aria-label="Default select example" name="status">
                                    <option value="{{ $edit['status'] }}" id="status">
                                        @if ($edit['status'] == '1')
                                            公開
                                        @else
                                            非公開
                                        @endif
                                    </option>
                                    <option value="0">非公開</option>
                                    <option value="1">公開</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="gp-btn">
                    <a class="btn clear-btn" onclick="clearPostEditForm(); return false;">クリア</a>
                    <button type="submit" class="btn">確認</button>
                </div>
            </form>
        </div>
    </div>
@endsection
