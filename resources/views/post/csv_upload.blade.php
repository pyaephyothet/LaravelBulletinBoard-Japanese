@extends('common')

@section('content')
    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-4 mx-auto">
                <div class="card border border-dark rounded-0">
                    <div class="card-body d-flex flex-column align-items-center">
                        <form action="{{ route('post#import') }}" method="POST" enctype="multipart/form-data"
                            class="d-flex flex-column gap-3 mb-3 w-100">
                            @csrf
                            <label class="d-block text-center heading">社内OJT<br><span>Bulletin Board</span></label>
                            <input type="file" class="button" placeholder="csv" name="csv_file" value="">
                            <button type="submit" class="btn login-btn">アプロード</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
