@extends('layout.panel.main')

@section('title')
    لیست درخواست‌ها
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="inline-block">{{__('inspections list')}}</h3>
                <a href="{{route('super-admin.inspection.create')}}" class="btn btn-solid mr-2">
					<span
                        class="flex items-center justify-center gap-2">
                        <span class="text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                        </span>
                        <span>{{__('create new inspection')}}</span>
                    </span>
                </a>
            </div>

            <div class="card adaptable-card">
                <div class="card-body">
                    <div id="product-list-data-table_wrapper" class="dataTables_wrapper no-footer">
                        <div class="overflow-x-auto">
                            <table id="product-list-data-table"
                                   class="table-default table-hover data-table dataTable no-footer"
                                   role="grid" aria-describedby="product-list-data-table_info">
                                <thead>
                                <tr>
                                    <td>سریال</td>
                                    <th>درخواست‌کننده</th>
                                    <th>نوع بازرسی</th>
                                    <th>عنوان</th>
                                    <th>تاریخ بازرسی</th>
                                    <th>تأمین‌کننده</th>
                                    <th>وضعیت</th>
                                    <th>بازرس</th>
                                    <th>تاریخ ثبت</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inspections as $inspection)

                                    <tr>
                                        <td>{{$inspection->serial_number}}</td>
                                        <td>
                                            <div class="flex items-center">
                                                {{$inspection->creator->fullName()}}
                                            </div>
                                        </td>
                                        <td>{{$inspection->type}}</td>
                                        <td>{{$inspection->subject}}</td>
                                        <td>{{jdate_from_gregorian($inspection->inspection_date)}}</td>
                                        <td>{{$inspection->supplier}}</td>
                                        <td>
                                            <span
                                                class="{{statusColor($inspection->status)[0]}}">{{statusColor($inspection->status)[1]}}</span>
                                        </td>
                                        <td>{{$inspection->inspector?$inspection->inspector->fullName:'تعیین نشده'}}</td>
                                        <td>
                                            <div
                                                class="flex items-center">{{jdate_from_gregorian($inspection->created_at)}}</div>
                                        </td>
                                        <td>
                                            <a href=""
                                               class="text-primary-600 cursor-pointer select-none font-semibold">
                                                مشاهده
                                            </a>
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
@endsection
