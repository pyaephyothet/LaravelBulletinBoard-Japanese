<nav class="navbar sticky-top navbar-expand-lg px-lg-5">
    <div class="container-fluid">
        <a class="navbar-brand me-5" href="{{ route('home') }}">社内OJT Bulletin Board</a>
        <button class="navbar-toggler collapsed d-flex d-lg-none flex-column justify-content-around" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
            {{-- <span class="navbar-toggler-icon"></span> --}}
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon middle-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav w-100 gap-5 p-lg-0 " id="navMenus">
                <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">ホーム</a>
                </li>
                <li
                    class="nav-item {{ request()->is('user/user_list') ? 'active' : '' }} 
                  @if (auth()->user()->role == 1) d-none @endif ">
                    <a class="nav-link " href="{{ route('user#userList') }}">ユーザー管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('post/post_list') ? 'active' : '' }}"
                        href="{{ route('post#postList') }}">投稿管理</a>
                </li>
                <li class="nav-item dropdown ms-lg-auto">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border border-dark rounded-0">
                        <li><a class="dropdown-item" href="{{ route('user#profile', auth()->user()->id) }}">プロファイル</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('user#pwChange') }}">パスワード変更</a></li>
                        <li><a class="dropdown-item border-bottom-0" href="{{ route('user#logout') }}">ログアウト</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
