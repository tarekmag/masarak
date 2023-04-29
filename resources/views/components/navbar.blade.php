<div>
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header" style="background-color: #0870ce">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                            <img class="brand-logo" alt="{{ __('partials.AppName') }}"
                            src="{{ asset('images/Transic_Logo_White.svg') }}" style="width: 170px; margin-top: -6px; margin-left:15px;">
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="fa fa-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>

            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">

                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <div>
                            <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{-- <i class="flag-icon flag-icon-{{ $currentLangauge->symbol }}"></i> --}}
                                    <span>{{ $currentLangauge->name }}</span><span class="selected-language"></span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                    @foreach ($languages as $language)
                                    <a class="dropdown-item"
                                        href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['setLanguage='.$language->symbol]) }}">
                                        {{-- <i class="flag-icon flag-icon-{{ $language->symbol }}"></i> --}}
                                        {{ $language->name }}</a>
                                    @endforeach

                                </div>
                            </li>
                        </div>

                        <x-notification-notification-list />

                        <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label">
                                <i class="fa fa-magic" data-tooltip="tooltip" data-placement="left" title="{{ auth()->user()->role->name }}"></i>
                            </a>
                        </li>
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="avatar">
                                    <img src="{{ auth()->user()->image_url }}" alt="avatar" style="width: 50%;"><i></i></span>
                                <span class="user-name">
                                    {{ Str::limit(auth()->user()->name, 20, '...') }}<br>
                                </span>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('user.profile') }}"
                                    data-method="user.profile"><i class="ft-user"></i>
                                    {{ __('user::language.page.editProfile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="ft-power"></i>
                                    {{ __('user::language.page.logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
