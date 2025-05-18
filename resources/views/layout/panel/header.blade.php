<header class="header border-b border-gray-200 dark:border-gray-700">
    <div class="header-wrapper h-16">
        <!-- Header Nav Start start-->
        <div class="header-action header-action-start">
            <div id="side-nav-toggle"
                 class="side-nav-toggle header-action-item header-action-item-hoverable">
                <div class="text-2xl">
                    <svg class="side-nav-toggle-icon-expand" stroke="currentColor" fill="none"
                         stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                    <svg class="side-nav-toggle-icon-collapsed hidden" stroke="currentColor"
                         fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"
                         height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </div>
            </div>
            <div class="side-nav-toggle-mobile header-action-item header-action-item-hoverable"
                 data-bs-toggle="modal" data-bs-target="#mobile-nav-drawer">
                <div class="text-2xl">
                    <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24"
                         height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Header Nav Start end-->
        <!-- Header Nav End start-->
        <div class="header-action header-action-end">
            <!-- Notification-->

            <!-- User Dropdown-->
            <div class="dropdown">
                <div class="dropdown-toggle" id="user-dropdown" data-bs-toggle="dropdown">
                    <div class="header-action-item flex items-center gap-2">
											<span class="avatar avatar-circle" data-avatar-size="32"
                                                  style="width: 32px">
												<img class="avatar-img avatar-circle"
                                                     src="{{asset('assets/img/nouser.webp')}}"
                                                     loading="lazy" alt=""></span>
                        <div class="hidden md:block">
                            <div class="font-bold">{{auth()->user()->name}} {{auth()->user()->surname}}</div>
                            <div class="text-xs capitalize">{{rolesFaName(auth()->user()->getRoleNames()->first())}}</div>
                        </div>
                    </div>
                </div>
                <ul class="dropdown-menu bottom-end min-w-[240px]">
                    <li class="menu-item-header">
                        <div class="py-2 px-3 flex items-center gap-2">
												<span class="avatar avatar-circle avatar-md">
													<img class="avatar-img avatar-circle"
                                                         src="{{asset('assets/img/nouser.webp')}}"
                                                         loading="lazy" alt="">
												</span>
                            <div>
                                <div
                                    class="font-bold text-gray-900 dark:text-gray-100">{{auth()->user()->name}} {{auth()->user()->surname}}</div>
                                <div class="text-xs">{{auth()->user()->email}}</div>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item-divider"></li>
                    <li class="menu-item menu-item-hoverable mb-1 h-[35px]">
                        <a class="flex gap-2 items-center" href="{{route('profile')}}">
												<span class="text-xl opacity-50">
													<svg stroke="currentColor" fill="none" stroke-width="0"
                                                         viewBox="0 0 24 24" height="1em" width="1em"
                                                         xmlns="http://www.w3.org/2000/svg">
														<path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
														</path>
													</svg>
												</span>
                            <span>{{__('profile')}}</span>
                        </a>
                    </li>
                    <li id="menu-item-29-2VewETdxAb" class="menu-item-divider"></li>
                    <li class="menu-item menu-item-hoverable gap-2 h-[35px]">
                        <a class="flex gap-2 items-center" href="{{route('logout')}}">
											<span class="text-xl opacity-50">
												<svg stroke="currentColor" fill="none" stroke-width="0"
                                                     viewBox="0 0 24 24" height="1em" width="1em"
                                                     xmlns="http://www.w3.org/2000/svg">
													<path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
													</path>
												</svg>
											</span>
                            <span>خروج از سیستم</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header Nav End end -->
    </div>
</header>
