@extends('common')

@section('content')
    <table class="table table-bordered border-dark">
        <tbody>
            <tr>
                <th scope="row" class="text-center"><label>タイトル</label></th>
                <td class="p-3">
                    <p>【リセットパスワード】アカウント情報</p>
                </td>
            </tr>
            <tr>
                <th scope="row" class="text-center"><label>本文</label></th>
                <td class="p-3">
                    <p>{!! $body !!}<a href="{{ $action_link }}">Click the link</a></p>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
