@extends('layout.panel.main')

@section('title')
    جزئیات درخواست بازرسی
@endsection

@section('content')
    <div
            class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <h3 class="mb-4">{{__('inspection details')}}</h3>
            <div class="form-container vertical">
                <div class="lg:col-span-2">
                    <div
                            class="card adaptable-card !border-b pb-6 py-4 rounded-br-none rounded-bl-none">
                        <div class="card-body">
                            <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('creator')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->creator->fullName()}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('company unit')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->unit->name}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('inspection type')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->inspection_type === 'technical'?'فنی':'کالا'}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('work order')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->work_order}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('equipment name')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->equipment_name}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('serial_no')}}</label>
                                        <input class="input" type="text" disabled value="{{$inspection->serial_no}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('size')}}</label>
                                        <input class="input pl-2" dir="ltr" type="text" disabled
                                               value="{{$inspection->size}}">
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('inspection state')}}</label>
                                        <div class="text-end">
                                            <input class="input" type="text" disabled
                                                   value="{{$inspection->city->state->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('inspection city')}}</label>
                                        <div class="text-end">
                                            <input class="input" type="text" disabled
                                                   value="{{$inspection->city->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('inspection location')}}</label>
                                        <div class="text-end">
                                            <input class="input" type="text" disabled value="{{$inspection->location}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('manufacture')}}</label>
                                        <input class="input" type="text" disabled value="{{$inspection->manufacturer}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('coordinator')}}</label>
                                        <div class="text-end">
                                            <input class="input" type="text" disabled
                                                   value="{{$inspection->coordinator}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('coordinator mobile')}}</label>
                                        <div class="text-end">
                                            <input class="input" type="text" disabled
                                                   value="{{$inspection->coordinator_mobile}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <label class="form-label mb-2">{{__('inspection date')}}</label>
                                    <input
                                            class="input pr-8 pwt-datepicker-input-element"
                                            type="text" disabled
                                            value="{{jdate_from_gregorian($inspection->start_date,'%Y/%m/%d H:i:s')}}">
                                </div>
                                <br>
                                <div class="col-span-2">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('tests')}}</label>
                                        @if(count($inspection->tests)>0)
                                            <select class="input tests-options"
                                                    disabled multiple>
                                                @foreach($tests as $test)
                                                    <option value="{{$test->id}}"
                                                            @if(in_array($test->id,$inspection->tests)) selected @endif>{{testName($test->id)}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="text" class="input" value="تستی انتخاب نشده است" disabled>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <div class="form-item vertical">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('extra tests')}}</label>
                                            <select class="input description-options" name="other_tests[]"
                                                    id="other_tests"
                                                    multiple disabled>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('inspection request status')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{statusColor($inspection->status)[1]}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('inspector')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->inspector?$inspection->inspectorr->fullName():'تعیین نشده'}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('inspection end date')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->end_date?jdate_from_gregorian($inspection->end_date,'%Y/%m/%d H:i:s'):'-'}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('next inspection date')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{$inspection->next_inspection_date?jdate_from_gregorian($inspection->next_inspection_date,'%Y/%m/%d H:i:s'):'-'}}">
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <h4 class="my-5">فایل های پیوست : </h4>
                            <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-5">
                                @if(count($inspection->files)>0)
                                    @foreach($inspection->files as $file)
                                        <div class="col-span-1">
                                            <div class="input-group mb-4 vertical">
                                                <input class="input pl-2" dir="ltr" type="text" disabled
                                                       value="{{$file->file_name}}">
                                                <a href="{{ route('download', \Illuminate\Support\Str::replace('inspection_files/','',$file->file_path)) }}"
                                                   class="btn bg-primary-600 hover:bg-primary-500 active:bg-primary-700 text-white radius-round px-3 py-2">
                                                    {{__('download')}}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-slate-600 text-center">فایلی پیوست نشده است.</p>
                                @endif

                            </div>
                            <hr>
                            <div class="mt-12">
                                <h4>{{__('comments')}}</h4>
                                <hr class="my-6">
                                <ul class="timeline">
                                    @if(count($inspection->comments)>0)
                                        @php
                                            $comments=$inspection->comments()->orderBy('created_at','desc')->get();
                                        @endphp
                                        @foreach($comments as $comment)
                                            <li class="timeline-item">
                                                <div class="timeline-item-wrapper">
                                                    <div class="timeline-item-media">
                                                        <div class="timeline-item-media-content">
                                                                <span class="avatar avatar-circle"
                                                                      data-avatar-size="30"
                                                                      style="width: 30px; height: 30px; min-width: 30px; line-height: 30px;">
                                                                    <img class="avatar-img avatar-circle"
                                                                         src="{{asset('assets/img/nouser.webp')}}"
                                                                         loading="lazy" alt="">
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item-content timeline-item-content-last">
                                                        <p class="my-1 flex items-center">
                                                                <span
                                                                        class="font-semibold text-gray-900 dark:text-gray-100">{{$comment->user->fullName()}}</span>
                                                            <span class="mx-2">نظر اضافه کرد. </span>
                                                            <span
                                                                    class="ml-3 rtl:mr-3">{{$comment->created_at->diffForHumans()}}</span>
                                                        </p>
                                                        <div class="card mt-4 card-border">
                                                            <div class="card-body">
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <p class="text-center my-5">نظری ثبت نشده است.</p>
                                    @endcanany
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Initialize the Select2 dropdown
            $('.tests-options').select2({
                placeholder: 'Select a test', // Optional placeholder
                allowClear: true, // Optional clear button
            });

            $('.select2-container').addClass('w-full');
            $('.select2-selection').addClass('rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm');
            $('.select2-dropdown').addClass('bg-white border border-gray-300 rounded-md shadow-lg text-sm');
            $('.select2-results__option').addClass('p-2 hover:bg-indigo-100');
            $('.select2-results__option--highlighted').addClass('bg-indigo-500 text-white');
        })

        let selectedValues = {!! json_encode($inspection->description ? json_decode($inspection->description, true) : []) !!};

        selectedValues.forEach(value => {
            $("#other_tests").append(new Option(value, value, true, true));
        });

        $("#other_tests").select2({
            tags: true, // اجازه‌ی اضافه کردن مقدار جدید
            placeholder: "ندارد",
            allowClear: true, // دکمه حذف مقدار
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term, // مقدار جدید همان ورودی کاربر است
                    text: term,
                    newTag: true // مشخص می‌کند که مقدار جدید است
                };
            }
        });
    </script>
@endsection
