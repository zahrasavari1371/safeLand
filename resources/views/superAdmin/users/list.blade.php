@extends('layout.panel.main')

@section('title')
    لیست کاربران
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="mb-4 flex items-center justify-between">
                @if($type == 'other')
                    <h3 class="inline-block">{{__('users list')}}</h3>
                @elseif($type == 'safeLand')
                    <h3 class="inline-block">{{__('safeLand users list')}}</h3>
                @endif
                @can('create user')
                    <a href="{{route('super-admin.users.create',$type)}}" class="btn btn-solid mr-2">
					<span
                        class="flex items-center justify-center gap-2">
                        <span class="text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                        </span>
                        <span>{{__('create new user')}}</span>
                    </span>
                    </a>
                @endcan
            </div>

            <div class="card adaptable-card">
                <div class="card-body">
                    <div id="DataTable">
                        <div class="demo-card">
                            <div class="card mb-9 card-border">
                                <div class="card-body">
                                    <table id="data-table"
                                           class="table-default table-hover data-table">
                                        <thead>
                                        <tr class="whitespace-nowrap">
                                            <td>#</td>
                                            <th>نام و نام خانوادگی</th>
                                            <th>ایمیل</th>
                                            <th>موبایل</th>
                                            <th>وضعیت</th>
                                            @if($type === 'other')
                                                <th>نام شرکت</th>
                                                <th>نام بخش</th>
                                            @endif
                                            <th>سمت</th>
                                            <th>تاریخ ثبت</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1 @endphp
                                        @foreach($users as $user)
                                            <tr class="whitespace-nowrap">
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"
                                                           href="#?id=1">{{$user->fullName()}}</a>
                                                    </div>
                                                </td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->mobile}}</td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <span class="badge-dot ml-2 @if($user->is_active)bg-emerald-500 @else bg-red-500 @endif"></span>
                                                        <span>{{$user->is_active?__('active'):__('inactive')}}</span>
                                                    </div>
                                                </td>
                                                @if($type === 'other')
                                                    @if($user->companyUnit)
                                                        <td>{{$user->companyUnit->company->name}}</td>
                                                    @elseif($user->company)
                                                        <td>{{$user->company->name}}</td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    @if($user->companyUnit)
                                                        <td>{{$user->companyUnit->name}}</td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @endif
                                                <td>{{rolesFaName($user->getRoleNames()->first())}}</td>
                                                <td>
                                                    <div
                                                        class="flex items-center">{{jdate_from_gregorian($user->created_at)}}</div>
                                                </td>
                                                <td>
                                                    @can('edit user')
                                                        <a href="{{route('super-admin.users.edit',['id' => $user->id, 'type' => $type])}}"
                                                           class="text-primary-600 cursor-pointer select-none font-semibold">
                                                            ویرایش
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>$('#data-table').DataTable();</script>
@endsection
