<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="active">
                <a href="{{ route('backsite.dashboard.index') }}">
                    <i
                        class="{{ request()->is('backsite/dashboard') || request()->is('backsite/dashboard/*') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h"
                    data-toggle="tooltip" data-placement="right" data-original-title="Application"></i></li>

            @if (Auth::user()->detail_user->type_user_id == 1)
                {{-- @can('management_access') --}}
                <li class=" nav-item"><a href="#"><i
                            class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') || request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'bx bx-group bx-flashing' : 'bx bx-group' }}"></i><span
                            class="menu-title" data-i18n="Management Access">Management Access</span></a>
                    <ul class="menu-content">
                        {{-- @can('type_user_access') --}}
                        <li
                            class="{{ request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('backsite.type_user.index') }}">
                                <i></i><span>Type User</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('user_access') --}}
                        <li
                            class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('backsite.user.index') }}">
                                <i></i><span>User</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}
            @endif

            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                {{-- @can('master_data') --}}
                <li class=" nav-item"><a href="#"><i
                            class="{{ request()->is('backsite/divisi') || request()->is('backsite/divisi/*') || request()->is('backsite/*/divisi') || request()->is('backsite/*/divisi/*') || request()->is('backsite/vendor') || request()->is('backsite/vendor/*') || request()->is('backsite/*/vendor') || request()->is('backsite/*/vendor/*') || request()->is('backsite/satuan') || request()->is('backsite/satuan/*') || request()->is('backsite/*/satuan') || request()->is('backsite/*/satuan/*') ? 'bx bx-customize bx-flashing' : 'bx bx-customize' }}"></i><span
                            class="menu-title" data-i18n="Master Data">Master Data</span></a>
                    <ul class="menu-content">
                        {{-- @can('type_user_access') --}}
                        <li
                            class="{{ request()->is('backsite/divisi') || request()->is('backsite/divisi/*') || request()->is('backsite/*/divisi') || request()->is('backsite/*/divisi/*') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('backsite.divisi.index') }}">
                                <i></i><span>Divisi</span>
                            </a>
                        </li>
                        <li
                            class="{{ request()->is('backsite/satuan') || request()->is('backsite/satuan/*') || request()->is('backsite/*/satuan') || request()->is('backsite/*/satuan/*') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('backsite.satuan.index') }}">
                                <i></i><span>Satuan</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('user_access') --}}
                        <li
                            class="{{ request()->is('backsite/vendor') || request()->is('backsite/vendor/*') || request()->is('backsite/*/vendor') || request()->is('backsite/*/vendor/*') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('backsite.vendor.index') }}">
                                <i></i><span>Kontraktor</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}
            @endif

            {{-- @can('transaction') --}}
            <li class=" nav-item"><a href="#"><i
                        class="{{ request()->is('backsite/material_submission') || request()->is('backsite/material_submission/*') || request()->is('backsite/*/material_submission') || request()->is('backsite/*/material_submission/*') || request()->is('backsite/inspection_material') || request()->is('backsite/inspection_material/*') || request()->is('backsite/*/inspection_material') || request()->is('backsite/*/inspection_material/*') ? 'bx bx-hive bx-flashing' : 'bx bx-hive' }}"></i><span
                        class="menu-title" data-i18n="Transaksi">Transaksi</span></a>
                <ul class="menu-content">
                    {{-- @can('type_user_access') --}}
                    <li
                        class="{{ request()->is('backsite/material_submission') || request()->is('backsite/material_submission/*') || request()->is('backsite/*/material_submission') || request()->is('backsite/*/material_submission/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.material_submission.index') }}">
                            <i></i><span>Permohonan QA</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                </ul>
            </li>
            {{-- @endcan --}}

        </ul>
    </div>
</div>

<!-- END: Main Menu-->
