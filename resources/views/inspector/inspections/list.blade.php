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
                                            <th>{{__('company unit')}}</th>
                                            <th>{{__('manufacture')}}</th>
                                            <th>{{__('work order')}}</th>
                                            <td>{{__('size')}}</td>
                                            <td>{{__('serial_no')}}</td>
                                            <td>{{__('equipment name')}}</td>
                                            <th>{{__('location')}}</th>
                                            <th>{{__('inspection type')}}</th>
                                            <th>{{__('start date')}}</th>
                                            <th>{{__('end date')}}</th>
                                            <th>{{__('next inspection date')}}</th>
                                            <th>{{__('inspection status')}}</th>
                                            <th>{{__('inspector')}}</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($inspections)>0)
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach($inspections as $inspection)
                                                @php
                                                    if ($inspection->end_date){
                                                        $start=\Carbon\Carbon::parse($inspection->start_date);
                                                        $end=\Carbon\Carbon::parse($inspection->end_date);
                                                        $man_day=(int)$start->diffInDays($end);
                                                    }else
                                                        $man_day='-'
                                                @endphp
                                                <tr class="whitespace-nowrap">
                                                    <td>{{++$i}}</td>
                                                    <td>{{$inspection->unit->name}}</td>
                                                    <td>{{$inspection->manufacturer}}</td>
                                                    <td>{{$inspection->work_order}}</td>
                                                    <td dir="ltr">{{$inspection->size}}</td>
                                                    <td>{{$inspection->serial_no}}</td>
                                                    <td>{{$inspection->equipment_name}}</td>
                                                    <td>{{$inspection->city->state->name}}</td>
                                                    <td>{{$inspection->inspection_type === 'technical'?"فنی":"کالا"}}</td>
                                                    <td>{{jdate_from_gregorian($inspection->start_date)}}</td>
                                                    <td>{{$inspection->end_date?jdate_from_gregorian($inspection->end_date):'-'}}</td>
                                                    <td>{{$inspection->next_inspection_date?jdate_from_gregorian($inspection->next_inspection_date):'-'}}</td>
                                                    <td><span
                                                            class="{{statusColor($inspection->status)[0]}}">{{statusColor($inspection->status)[1]}}</span>
                                                    </td>
                                                    <td>{{$inspection->inspector?$inspection->inspectorr->fullName():'تعیین نشده'}}</td>
                                                    <td>
                                                        <a href="{{route('inspector.inspection.view',$inspection->id)}}"
                                                           class="text-primary-600 cursor-pointer select-none font-semibold">
                                                            مشاهده
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
