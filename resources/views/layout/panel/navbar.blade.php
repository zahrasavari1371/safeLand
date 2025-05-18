<div class="side-nav side-nav-light side-nav-expand">
    <div class="side-nav-header">
        <div class="px-6 py-4">
            <img width="150" src="{{asset('assets/img/logo.jpg')}}" alt="Company logo">
        </div>
    </div>
    <div class="side-nav-content relative side-nav-scroll">
        <nav class="menu menu-transparent px-4 pb-4">
            <div class="menu-group">
                <ul>
                    @can('view super admin dashboard')
                        <li data-menu-item="classic-project-dashboard"
                            class="menu-item @if(request()->url() === route('super-admin.dashboard')) menu-item-active @endif">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                 viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <a class="h-full w-full flex items-center"
                               href="{{route('super-admin.dashboard')}}">
                                <span>{{__('dashboard')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('view admin dashboard')
                        <li data-menu-item="classic-project-dashboard"
                            class="menu-item @if(request()->url() === route('admin.dashboard')) menu-item-active @endif">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                 viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <a class="h-full w-full flex items-center"
                               href="{{route('admin.dashboard')}}">
                                <span>{{__('dashboard')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('view dashboard')
                        <li data-menu-item="classic-project-dashboard"
                            class="menu-item @if(request()->url() === route('dashboard')) menu-item-active @endif">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                 viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <a class="h-full w-full flex items-center"
                               href="{{route('dashboard')}}">
                                <span>{{__('dashboard')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('view companies')
                        <li data-menu-item="classic-project-dashboard"
                            class="menu-item @if(request()->url() === route('super-admin.companies.list')) menu-item-active @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="1em" width="1em"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                 class="menu-item-icon">--}}
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21">
                                </path>
                            </svg>
                            <a class="h-full w-full flex items-center"
                               href="{{route('super-admin.companies.list')}}">
                                <span>{{__('companies list')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('view users')
                        <li data-menu-item="classic-project-dashboard"
                            class="menu-item @if(request()->url() === route('super-admin.users.list','other')) menu-item-active @endif">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                 viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <a class="h-full w-full flex items-center"
                               href="{{route('super-admin.users.list','other')}}">
                                <span>{{__('users list')}}</span>
                            </a>
                        </li>
                        <li data-menu-item="classic-project-dashboard"
                            class="menu-item @if(request()->url() === route('super-admin.users.list','safeLand')) menu-item-active @endif">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                 viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <a class="h-full w-full flex items-center"
                               href="{{route('super-admin.users.list','safeLand')}}">
                                <span>{{__('safeLand users list')}}</span>
                            </a>
                        </li>
                    @endcan
                    <li class="menu-collapse">
                        <div class="menu-collapse-item">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                 viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <span class="menu-item-text">{{__('inspection requests')}}</span>
                        </div>
                        <ul>
                            @can('view inspections')
                                <li data-menu-item="classic-crm-dashboard"
                                    class="menu-item @if(request()->url() === route('inspections.list','open')) menu-item-active @endif">
                                    <a class="h-full w-full flex items-center"
                                       href="{{route('inspections.list','open')}}">
                                        <span>{{__('open inspections list')}}</span>
                                        <span class="badge bg-danger mr-2">{{ $openRequestsCount }}</span>
                                    </a>
                                </li>
                                <li data-menu-item="classic-crm-dashboard"
                                    class="menu-item @if(request()->url() === route('inspections.list','close')) menu-item-active @endif">
                                    <a class="h-full w-full flex items-center"
                                       href="{{route('inspections.list','close')}}">
                                        <span>{{__('close inspections list')}}</span>
                                    </a>
                                </li>
                                <li data-menu-item="classic-crm-dashboard"
                                    class="menu-item @if(request()->url() === route('inspection.create')) menu-item-active @endif">
                                    <a class="h-full w-full flex items-center"
                                       href="{{route('inspection.create')}}">
                                        <span>{{__('create new inspection')}}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('view all inspections')
                                <li data-menu-item="classic-crm-dashboard"
                                    class="menu-item @if(request()->url() === route('inspections.list','open')) menu-item-active @endif">
                                    <a class="h-full w-full flex items-center"
                                       href="{{route('admin.inspections.list','open')}}">
                                        <span>{{__('open inspections list')}}</span>
                                        <span class="badge bg-danger mr-2">{{ $openRequestsCount }}</span>
                                    </a>
                                </li>
                                <li data-menu-item="classic-crm-dashboard"
                                    class="menu-item @if(request()->url() === route('admin.inspections.list','close')) menu-item-active @endif">
                                    <a class="h-full w-full flex items-center"
                                       href="{{route('admin.inspections.list','close')}}">
                                        <span>{{__('close inspections list')}}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('inspector view inspections')
                                <li data-menu-item="classic-crm-dashboard"
                                    class="menu-item @if(request()->url() === route('inspector.inspections.list','open')) menu-item-active @endif">
                                    <a class="h-full w-full flex items-center"
                                       href="{{route('inspector.inspections.list','open')}}">
                                        <span>{{__('open inspections list')}}</span>
                                        <span class="badge bg-danger mr-2">{{ $openRequestsCount }}</span>
                                    </a>
                                </li>
                                <li data-menu-item="classic-crm-dashboard"
                                    class="menu-item @if(request()->url() === route('inspector.inspections.list','close')) menu-item-active @endif">
                                    <a class="h-full w-full flex items-center"
                                       href="{{route('inspector.inspections.list','close')}}">
                                        <span>{{__('close inspections list')}}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
