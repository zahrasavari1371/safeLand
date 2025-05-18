<!DOCTYPE html>
<html lang="en" dir="rtl" class="light">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.jpg')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/persian-date/persian-datepicker.min.css')}}">
    @yield('style')
</head>

<body>
<!-- App Start-->
<div id="root">
    <!-- App Layout-->
    <div class="app-layout-classic flex flex-auto flex-col">
        <div class="flex flex-auto min-w-0">
            <!-- Side Nav start-->
            @include('layout.panel.navbar')
            <!-- Side Nav end-->

            <!-- Header Nav start-->
            <div class="flex flex-col flex-auto min-h-screen min-w-0 relative w-full">
                @include('layout.panel.header')
                <!-- Popup start-->
                <div class="modal fade" id="nav-config" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog drawer drawer-end">
                        <div class="drawer-content">
                            <div class="drawer-header">
                                <h4>پیکربندی تم</h4>
                                <span class="close-btn close-btn-default" role="button" data-bs-dismiss="modal">
										<svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                             viewBox="0 0 20 20" height="1em" width="1em"
                                             xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"></path>
										</svg>
									</span>
                            </div>
                            <div class="drawer-body">
                                <div class="flex flex-col h-full justify-between">
                                    <div class="flex flex-col gap-y-10 mb-6">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h6>حالت تاریک</h6>
                                                <span>تم را به حالت تاریک تغییر دهید</span>
                                            </div>
                                            <div>
                                                <label class="switcher">
                                                    <input name="dark-mode-toggle" type="checkbox" value="">
                                                    <span class="switcher-toggle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h6>جهت</h6>
                                                <span>جهت را انتخاب کنید</span>
                                            </div>
                                            <div class="input-group">
                                                <button id="dir-ltr-button"
                                                        class="btn  dark:bg-gray-500 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 active:bg-gray-100 dark:active:bg-gray-500 dark:active:border-gray-500 dark:text-gray-100 radius-round h-9 px-3 py-2 text-sm">
                                                    LTR
                                                </button>
                                                <button id="dir-rtl-button"
                                                        class="btn bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 active:bg-gray-100 dark:active:bg-gray-500 dark:active:border-gray-500 dark:text-gray-100 radius-round h-9 px-3 py-2 text-sm">
                                                    RTL
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-3">حالت ناوبری
                                            </h6>
                                            <div class="inline-flex">
                                                <label class="radio-label inline-flex mr-3"
                                                       for="nav-mode-radio-default">
                                                    <input id="nav-mode-radio-default" type="radio" value="default"
                                                           name="nav-mode-radio-group" class="radio text-primary-600"
                                                           checked>
                                                    <span>پیش فرض</span>
                                                </label>
                                                <label class="radio-label inline-flex mr-3"
                                                       for="nav-mode-radio-themed">
                                                    <input id="nav-mode-radio-themed" type="radio" value="themed"
                                                           name="nav-mode-radio-group" class="radio text-primary-600">
                                                    <span>خاص</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-3">قالب</h6>
                                            <select id="theme-select"
                                                    class="input input-sm focus:ring-primary-600 focus-within:ring-primary-600 focus-within:border-primary-600 focus:border-primary-600">
                                                <option value="primary" selected>نیلی</option>
                                                <option value="red">قرمز</option>
                                                <option value="orange">نارنجی</option>
                                                <option value="amber">زردآلویی</option>
                                                <option value="yellow">زرد</option>
                                                <option value="lime">سبز لیمویی</option>
                                                <option value="green">سبز</option>
                                                <option value="emerald">زمردی</option>
                                                <option value="teal">فیروزه‌ای</option>
                                                <option value="cyan">فیروزه‌ای روشن</option>
                                                <option value="sky">آسمانی</option>
                                                <option value="blue">آبی</option>
                                                <option value="violet">بنفش</option>
                                                <option value="purple">بنفش تیره</option>
                                                <option value="fuchsia">فوچیا</option>
                                                <option value="pink">صورتی</option>
                                                <option value="rose">گل رز</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="mobile-nav-drawer" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog drawer drawer-start !w-[330px]">
                        <div class="drawer-content">
                            <div class="drawer-body p-0">
                                <div class="side-nav-mobile">
                                    <div class="side-nav-content relative side-nav-scroll">
                                        <div class="px-6 py-4">
                                            <img width="150" src="{{asset('assets/img/logo.jpg')}}" alt="Company logo">
                                        </div>
                                        <nav class="menu menu-transparent px-4 pb-4">
                                            <div class="menu-group">
                                                <ul>
                                                    @can('view companies')
                                                        <li data-menu-item="classic-project-dashboard" class="menu-item">
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
                                                            <li data-menu-item="classic-project-dashboard" class="menu-item">
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
                                                            <li data-menu-item="classic-project-dashboard" class="menu-item">
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
                                                                <li data-menu-item="classic-crm-dashboard" class="menu-item">
                                                                    <a class="h-full w-full flex items-center"
                                                                       href="{{route('inspections.list','open')}}">
                                                                        <span>{{__('open inspections list')}}</span>
                                                                    </a>
                                                                </li>
                                                                <li data-menu-item="classic-crm-dashboard" class="menu-item">
                                                                    <a class="h-full w-full flex items-center"
                                                                       href="{{route('inspections.list','close')}}">
                                                                        <span>{{__('close inspections list')}}</span>
                                                                    </a>
                                                                </li>
                                                            @endcan
                                                            @can('view all inspections')
                                                                <li data-menu-item="classic-crm-dashboard" class="menu-item">
                                                                    <a class="h-full w-full flex items-center"
                                                                       href="{{route('admin.inspections.list','open')}}">
                                                                        <span>{{__('open inspections list')}}</span>
                                                                    </a>
                                                                </li>
                                                                    <li data-menu-item="classic-crm-dashboard" class="menu-item">
                                                                        <a class="h-full w-full flex items-center"
                                                                           href="{{route('admin.inspections.list','close')}}">
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Popup end-->
                <div class="h-full flex flex-auto flex-col justify-between">
                    <!-- محتوا شروع می‌شود -->
                    <main class="h-full">
                        @yield('content')
                    </main>
                    <!-- محتوا پایان می‌یابد -->
                    <footer class="footer flex flex-auto items-center h-16 px-4 sm:px-6 md:px-8">
                        <div class="flex items-center justify-between flex-auto w-full">
								<span>طراحی شده توسط تیم  <span class="font-semibold">طراحان.</span> تمامی حقوق محفوظ
									است.</span>
                        </div>
                    </footer>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Core Vendors JS -->
<script src="{{asset('assets/js/vendors.min.js')}}"></script>

<!-- Other Vendors JS -->

<!-- Page js -->

<!-- Core JS -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/dataTables.custom-ui.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/forms.js')}}"></script>
<script src="{{asset('assets/js/persian-date/persian-date.min.js')}}"></script>
<script src="{{asset('assets/js/persian-date/persian-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/persian-date/persian-main.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.js')}}"></script>
@yield('scripts')

</body>

</html>
