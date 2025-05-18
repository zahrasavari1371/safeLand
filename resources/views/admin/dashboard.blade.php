@extends('layout.panel.main')

@section('title')
    ادمین | داشبورد
@endsection

@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="lg:flex items-center justify-between mb-4">
                <h3 class="mb-4 lg:mb-0">داشبورد</h3>
            </div>

            <div class="mt-6 h-full flex flex-col">
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="card card-layout-frame">
                        <div class="card-body">
                            <div class="flex items-center gap-4 justify-between">
                                <span
                                    class="avatar avatar-rounded bg-cyan-100 text-cyan-600 dark:bg-cyan-500/20 dark:text-cyan-100 avatar-lg text-3xl"
                                    data-avatar-size="55"
                                    style="width: 55px; height: 55px; min-width: 55px; line-height: 55px;">
														<span class="avatar-icon">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" height="1em" width="1em">
                                                                        <path d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 013.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0121 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 017.5 16.125V3.375z">
                                                                        </path>
                                                                        <path d="M15 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0017.25 7.5h-1.875A.375.375 0 0115 7.125V5.25zM4.875 6H6v10.125A3.375 3.375 0 009.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V7.875C3 6.839 3.84 6 4.875 6z">
                                                                        </path>
                                                                    </svg>
														</span>
													</span>
                                <div>
                                    <div class="flex gap-1.5 items-end mb-2">
                                        <p class="font-bold leading-none">درخواست باز</p>
                                    </div>
                                    <p class="flex items-center gap-1">
                                        <span class="font-semibold">{{$open_requests}} درخواست </span>
                                    </p>
                                </div>
                                <a href="{{route('admin.inspections.list','open')}}"
                                   class="btn bg-cyan-50 hover:bg-cyan-100 active:bg-cyan-200 text-cyan-600 btn-sm">مشاهده</a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-layout-frame">
                        <div class="card-body">
                            <div class="flex items-center gap-4 justify-between">
                                <span
                                    class="avatar avatar-rounded bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-100 avatar-lg text-3xl"
                                    data-avatar-size="55"
                                    style="width: 55px; height: 55px; min-width: 55px; line-height: 55px;">
														<span class="avatar-icon">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" height="1em" width="1em">
                                                                        <path d="M11.625 16.5a1.875 1.875 0 100-3.75 1.875 1.875 0 000 3.75z">
                                                                        </path>
                                                                        <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 001.06-1.06l-1.047-1.048A3.375 3.375 0 1011.625 18z" clip-rule="evenodd"></path>
                                                                        <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z">
                                                                        </path>
                                                                    </svg>
														</span>
													</span>
                                <div>
                                    <div class="flex gap-1.5 items-end mb-2">
                                        <p class="font-bold leading-none">درحال بازرسی</p>
                                    </div>
                                    <p class="flex items-center gap-1">
                                        <span class="font-semibold">{{$processing}} درخواست</span>
                                    </p>
                                </div>
                                <a href="{{route('admin.inspections.list','open')}}"
                                   class="btn bg-emerald-50 hover:bg-emerald-100  text-emerald-600 btn-sm">مشاهده</a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-layout-frame">
                        <div class="card-body">
                            <div class="flex items-center gap-4 justify-between">
                                <span
                                    class="avatar avatar-rounded bg-red-100 text-red-600 dark:bg-emerald-500/20 dark:text-emerald-100 avatar-lg text-3xl"
                                    data-avatar-size="55"
                                    style="width: 55px; height: 55px; min-width: 55px; line-height: 55px;">
														<span class="avatar-icon">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" height="1em" width="1em">
                                                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path>
                                                            </svg>
														</span>
													</span>
                                <div>
                                    <div class="flex gap-1.5 items-end mb-2">
                                        <p class="font-bold leading-none">درخواست رد شده</p>
                                    </div>
                                    <p class="flex items-center gap-1">
                                        <span class="font-semibold">{{$rejected}} درخواست</span>
                                    </p>
                                </div>
                                <a href="{{route('admin.inspections.list','open')}}" class="btn bg-rose-50 hover:bg-rose-100 active:bg-rose-200 text-rose-600 btn-sm">مشاهده</a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-layout-frame">
                        <div class="card-body">
                            <div class="flex items-center gap-4 justify-between">
                                <span
                                    class="avatar avatar-rounded avatar-lg text-3xl"
                                    data-avatar-size="55"
                                    style="width: 55px; height: 55px; min-width: 55px; line-height: 55px;">
														<span class="avatar-icon">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" height="1em" width="1em">
                                                                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd"></path>
                                                                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zm9.586 4.594a.75.75 0 00-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.116-.062l3-3.75z" clip-rule="evenodd"></path>
                                                                    </svg>
														</span>
													</span>
                                <div>
                                    <div class="flex gap-1.5 items-end mb-2">
                                        <p class="font-bold leading-none">درخواست تمام شده</p>
                                    </div>
                                    <p class="flex items-center gap-1">
                                        <span class="font-semibold">{{$closed}} درخواست</span>
                                    </p>
                                </div>
                                <a href="{{route('admin.inspections.list','close')}}" class="btn btn-default btn-sm">مشاهده</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
