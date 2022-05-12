<header>
    <nav class="white">
        {{-- <a href="#" data-target="slide-out" class="sidenav-trigger black-text"><i class="material-icons">menu</i></a> --}}
        <div class="nav-wrapper">
            <a href="{{ route('home') }}" class="brand-logo center black-text p-1"><img
                    src="{{ asset('assets/images/logo.png') }}" alt="Skyline Logo"></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class="black-text mr-3">ISI Standard</li>
                <li class="mt-2">
                    <select name="ddisiStandard" id="ddisiStandard">
                        <option value="0">Select</option>
                        <option value="9079">9079</option>
                        <option value="12225">12225</option>
                        <option value="8472">8472</option>
                        <option value="8034">8034</option>
                        <option value="6595">6595</option>
                        <option value="9283">9283</option>
                        <option value="14220">14220</option>
                    </select>
                </li>
                <li><a class="black-text" href="{{ route('home') }}"><i class="material-icons">home</i></a></li>
            </ul>
        </div>
    </nav>

    <ul id="slide-out" class="sidenav sidenav-fixed collapsible hide-on-med-and-down">
        @guest
            @if (Route::has('login'))
                <li>
                    <div class="user-view">
                        {{-- <div class="background">
                            <img class="circle" src="{{ asset('assets/images/office_image.png') }}">
                        </div> --}}
                        <a href="#user"><img class="circle"
                                src="{{ asset('assets/images/user_image.png') }}"></a>

                        <h5 class=""><a href="{{ url('/') }}">SKYLINE PUMPS</a></h5>
                    </div>
                </li>
            @endif
        @else
            <li>
                <div class="user-view">
                    {{-- <div class="background">
                        <img class="circle" src="{{ asset('assets/images/office_image.png') }}">
                    </div> --}}
                    <a class="waves-effect" href="#user"><img class="circle"
                            src="{{ asset('assets/images/user_image.png') }}"></a>
                    <div>
                        <ul>
                            <li><span class="name">{{ Auth::user()->name }}</span></li>
                            <li><span class="email">{{ Auth::user()->email }}</span></li>
                        </ul>
                    </div>
                </div>
            </li>
        @endguest

        @guest
            @if (Route::has('login'))
                <li id="menu98"><a class="waves-effect" href="{{ route('login') }}"><i
                            class="material-icons">login</i>{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li id="menu99"><a class="waves-effect" href="{{ route('register') }}"><i
                            class="material-icons">personadd</i>{{ __('Register') }}</a></li>
            @endif
        @else
            @if (session('isi') == 9079)
                @include('includes.isi_standard_navs.9079')
            @elseif (session('isi') == 12225)
                @include('includes.isi_standard_navs.12225')
            @elseif (session('isi') == 6595)
                @include('includes.isi_standard_navs.6595')
            @elseif (session('isi') == 8034)
                @include('includes.isi_standard_navs.8034')
            @elseif (session('isi') == 8472)
                @include('includes.isi_standard_navs.8472')
            @elseif (session('isi') == 9283)
                @include('includes.isi_standard_navs.9283')
            @elseif (session('isi') == 14220)
                @include('includes.isi_standard_navs.14220')
            @else
                {{-- @include('includes.isi_standard_navs.9079') --}}
            @endif

            <!-- <li><div class="divider"></div>                                                                                                                                                                                                                                                                                                                                                                                </li> -->

            <li>
                <a class="waves-effect red-text pl-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons red-text">logout</i>{{ __('Logout') }}
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endguest
    </ul>
</header>
