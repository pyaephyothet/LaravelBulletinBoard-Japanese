@extends('common')
@extends('navbar')

@section('content')
    <div class="container-fluid form-deco">
        <h2 class="page-ttl my-4">新規投稿</h2>
        <div class="my_form mb-5">
            <form id="clearCreateForm" action="{{ route('post#createConfirm') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered border-dark">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center"><label>投稿タイトル</label></th>
                            <td class="p-3 d-lg-flex align-items-center">
                                <input class="mt-0 border border-dark  p-3" type="text" placeholder="title..."
                                    name="title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>投稿内容</label></th>
                            <td class="p-3 d-lg-flex align-items-center">
                                <textarea class="mt-0 border border-dark  p-3" type="text" placeholder="description..." name="description"
                                    value="{{ old('description') }}" rows="7">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"><label>公開ステータス</label></label></label></label></th>
                            <td class="p-3 d-lg-flex align-items-center">
                                <select class="form-select rounded-0 border border-dark  p-3"
                                    aria-label="Default select example" name="status" value="{{ old('status') }}">
                                    <option selected="selected" value="{{ old('status') }}">
                                        @if (old('status') == 1)
                                            公開
                                        @elseif (old('status') == null)
                                            ステータス
                                        @else
                                            非公開
                                        @endif
                                    </option>
                                    <option value="0">非公開</option>
                                    <option value="1">公開</option>
                                </select>
                                @error('status')
                                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                                @enderror
                                {{-- <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="mySwitch" name="postStatus"
                                        value="{{ old('postStatus') }}" data-on="1" data-off="0">
                                    <label class="form-check-label" for="mySwitch"></label>
                                </div> --}}
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
