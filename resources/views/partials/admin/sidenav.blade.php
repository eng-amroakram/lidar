<nav id="sidenav-1" class="sidenav ps ps--active-y" data-mdb-color="light" style="background-color: #2d2c2c"
    role="navigation" data-mdb-mode="side" data-mdb-right="false" data-mdb-hidden="false" data-mdb-accordion="true">

    <a class="ripple d-flex justify-content-center py-5" style="padding-top: 5rem !important;"
        href="{{ route('frontend.index') }}" data-ripple-color="primary">

        <img id="MDB-logo" width="200" src="{{ asset('assets/admin/images/ligaurd-logo.png') }}" alt="MDB Logo"
            draggable="false" />
    </a>

    <ul class="sidenav-menu">

        <li class="sidenav-item">
            <a class="sidenav-link" href="{{ route('frontend.index') }}">
                <i class="fas fa-chart-area pr-4 me-2 "></i><span>الصفحة الرئيسية</span></a>
        </li>

        {{-- @can('tenders', auth()->user())
            <li class="sidenav-item">
                <a class="sidenav-link"><i class="fas fa-briefcase pr-3 me-2"></i><span>المناقصات الحكومية</span></a>

                <ul class="sidenav-collapse">

                    @can('tenders', auth()->user())
                        <li class="sidenav-item ">
                            <a class="sidenav-link" href="{{ route('admin.tenders.index') }}">
                                <i class="fas fa-briefcase pr-3 me-2"></i>
                                <span>
                                    إدارة المناقصات
                                </span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('superadmin', auth()->user())
            @can('users', auth()->user())
                <li class="sidenav-item">
                    <a class="sidenav-link">
                        <i class="fas fa-users-gear pr-3 me-2"></i>
                        <span>إدارة العملاء</span>
                    </a>

                    <ul class="sidenav-collapse">
                        <li class="sidenav-item">
                            <a class="sidenav-link" href="{{ route('admin.users.users') }}">
                                <i class="fas fa-users pr-3 me-2"></i>
                                <span>الأعضاء</span>
                            </a>
                        </li>
                        <li class="sidenav-item ">
                            <a class="sidenav-link">
                                <i class="fas fa-comment-dots pr-3 me-2"></i>
                                <span>استفسار العملاء</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
        @endcan --}}

    </ul>

</nav>
