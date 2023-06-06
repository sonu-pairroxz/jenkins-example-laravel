@php
$user = auth()->guard('admin')->user();
@endphp
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('admin.dashboard')}}" class="logo">
            <span class="logo-sm">
                <img src="{{asset('assets/images/web-logo.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets/images/web-logo.png')}}" alt="" height="30">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <img src="{{asset('assets/images/icons/rulling-master.png')}}" height=30 width="30" />
                        <span>Rulling Master</span>
                    </a>
                </li>

                <li>
                    <a href="#!">
                        <img src="{{asset('assets/images/icons/find-hs.png')}}" height=30 width="30" />
                        <span>Find HS</span>
                    </a>
                </li>

                <li>
                    <a href="#!">
                        <img src="{{asset('assets/images/icons/doq-lib.png')}}" height=30 width="30" />
                        <span>Doc lib</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('query.index')}}">
                        <img src="{{asset('assets/images/icons/ask-query.jpg')}}" height=30 width="30" />
                        <span>Ask Query</span>
                    </a>
                </li>

                <li>
                    <a href="#!">
                        <img src="{{asset('assets/images/icons/world-trade.png')}}" height=30 width="30" />
                        <span>World Trade News</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <img src="{{asset('assets/images/icons/abce.png')}}" height=30 width="30" />
                        <span>ABCE</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <img src="{{asset('assets/images/icons/kymp.png')}}" height=30 width="30" />
                        <span>KYMP</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('jit-learning.index')}}">
                        <img src="{{asset('assets/images/icons/quiz.png')}}" height=30 width="30" />
                        <span>Quiz/JIT Learning</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <img src="{{asset('assets/images/icons/dumping.png')}}" height=30 width="30" />
                        <span>Dumping Data</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <img src="{{asset('assets/images/icons/knowledge.png')}}" height=30 width="30" />
                        <span>Knowledge Bite</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
