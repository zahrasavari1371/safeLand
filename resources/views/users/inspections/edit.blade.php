@extends('layout.panel.main')

@section('title')
    ویرایش درخواست بازرسی
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
                            <form id="update-inspection" action="{{route('inspection.update',$inspection->id)}}"
                                  method="post">
                                @csrf
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
                                            <input class="input" type="text" id="equipment_name" name="equipment_name"
                                                   value="{{$inspection->equipment_name}}">
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('serial_no')}}</label>
                                            <input class="input" type="text" id="serial_no" name="serial_no"
                                                   value="{{$inspection->serial_no}}">
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('size')}}</label>
                                            <input class="input pl-2" dir="ltr" type="text" id="size" name="size"
                                                   value="{{$inspection->size}}">
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('inspection state')}}</label>
                                            <div class="text-end">
                                                <select class="input" name="state_id" id="state_id">
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}"
                                                                @if($inspection->city->state->id === $state->id) selected @endif>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('inspection city')}}</label>
                                            <div class="text-end">
                                                <select class="input" name="city_id" id="city_id">
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}"
                                                                @if($inspection->city_id === $city->id) selected @endif>{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('inspection location')}}</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="location" name="location"
                                                       value="{{$inspection->location}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('manufacture')}}</label>
                                            <input class="input" type="text" id="manufacture" name="manufacture"
                                                   value="{{$inspection->manufacturer}}">
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('coordinator')}}</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="coordinator" name="coordinator"
                                                       value="{{$inspection->coordinator}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('coordinator mobile')}}</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="coordinator_mobile"
                                                       name="coordinator_mobile"
                                                       value="{{$inspection->coordinator_mobile}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <label class="form-label mb-2">{{__('inspection date')}}</label>
                                        <span class="input-wrapper">
																		<input
                                                                            class="input pr-8 pwt-datepicker-input-element datepicker"
                                                                            type="text"
                                                                            name="start_date"
                                                                            value="{{$inspection->start_date??"-"}}">
																		<div class="input-suffix-start">
																			<svg stroke="currentColor" fill="none"
                                                                                 stroke-width="2" viewBox="0 0 24 24"
                                                                                 aria-hidden="true" class="text-lg"
                                                                                 height="1em" width="1em"
                                                                                 xmlns="http://www.w3.org/2000/svg">
																				<path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
																				</path>
																			</svg>
																		</div>
																	</span>
                                    </div>
                                    <br>
                                    <div class="col-span-2">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('tests')}}</label>
                                            <select name="tests[]" id="tests_options" class="input tests-options"
                                                    multiple>
                                                @foreach($tests as $test)
                                                    <option value="{{$test->id}}"
                                                            @if(in_array($test->id,$inspection->tests)) selected @endif>{{testName($test->id)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('extra tests')}}</label>
                                            <select class="input description-options" name="other_tests[]" id="other_tests"
                                                    multiple>
                                            </select>
                                        </div>
                                    </div>

                                    @if(auth()->user()->hasRole('qc') || auth()->user()->hasRole('supervisor'))
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('inspection request status')}}</label>
                                                <select name="status" class="input" id="status">
                                                    <option value="0">انتخاب کنید</option>
                                                    <option value="2" @if($inspection->status == 2) selected @endif>
                                                        تایید
                                                        کردن
                                                    </option>
                                                    <option value="3" @if($inspection->status == 3) selected @endif>رد
                                                        کردن
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="my-3" style="text-align: end">
                                    <button type="button" id="update-inspection-btn"
                                            class="btn btn-solid">{{__('submit')}}</button>
                                </div>
                            </form>

                            <hr>

                            <h4 class="my-5">فایل های پیوست : </h4>
                            <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-5">
                                @if(count($inspection->files)>0)
                                    @foreach($inspection->files as $file)
                                        <div class="col-span-1">
                                            <div class="input-group mb-4 vertical">
                                                <input class="input pl-2" dir="ltr" type="text"
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
                            @if($inspection->status != 8)
                                <hr>
                                <h4 class="my-5">آپلود فایل جدید</h4>
                                <form id="upload-files" action="{{route('upload-files')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="inspection_id" value="{{$inspection->id}}">
                                    <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
                                        <div class="col-span-1">
                                            <label for="">{{__('upload new file')}}</label>
                                            <div class="input-group mb-4 vertical">
                                                <input class="input" type="file" name="file" accept=".pdf">
                                                <button type="button" id="btn-upload"
                                                        class="btn bg-primary-600 hover:bg-primary-500 active:bg-primary-700 text-white radius-round px-3 py-2">
                                                    {{__('upload')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif

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

                                <form id="comment-form" action="{{route('comment.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="inspection_id" value="{{$inspection->id}}">
                                    <div class="mt-6 mb-3 flex flex-auto">
															<span class="avatar avatar-circle" data-avatar-size="30"
                                                                  style="width: 30px; height: 30px; min-width: 30px; line-height: 30px;">
																<img class="avatar-img avatar-circle"
                                                                     src="{{asset('assets/img/nouser.webp')}}"
                                                                     loading="lazy">
															</span>
                                        <div class="ml-4 rtl:mr-4 w-full">
                                            <textarea class="input input-textarea" name="comment" id="comment"
                                                      type="text"
                                                      placeholder="یک نظر بنویسید"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" id="comment-btn"
                                                class="btn btn-solid">{{__('submit comment')}}</button>
                                    </div>
                                </form>
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


            $('#comment-btn').click(function (e) {
                e.preventDefault()
                ajaxRequests($('#comment-form'), $(this))
            })

            $('#update-inspection-btn').click(function (e) {
                e.preventDefault()
                ajaxRequests($('#update-inspection'), $(this))
            })

            $('#btn-upload').click(function (e) {
                e.preventDefault()
                ajaxRequests($('#upload-files'), $(this))
            })

            $('#state_id').on('change', function () {
                let stateId = $(this).find(":selected").val()
                $.ajax({
                    url: `{{ url('users/get-cities')}}/${stateId}`,
                    type: 'get',
                    processData: false, // Disable processData for FormData
                    contentType: false,
                    success: function (response) {
                        cities = response.cities
                        $('#city_id').empty()
                        cities.forEach(city => {
                            $('#city_id').append(`<option value="${city.id}">${city.name}</option>`)
                        })
                    },
                    error: function (xhr) {
                        toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان کنید.')
                    }
                });
            })

            let selectedValues = {!! json_encode($inspection->description ? json_decode($inspection->description, true) : []) !!};

            selectedValues.forEach(value => {
                $("#other_tests").append(new Option(value, value, true, true));
            });

            $("#other_tests").select2({
                tags: true, // اجازه‌ی اضافه کردن مقدار جدید
                placeholder: "تست های درخواستی خود را اضافه کنید.",
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

            $("#other_tests").on("keydown", function (e) {
                if (e.which === 32) { // 32 = Space
                    e.preventDefault();
                }
            });
        })
    </script>
@endsection
