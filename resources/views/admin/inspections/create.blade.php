@extends('layout.panel.main')

@section('title')
    ثبت درخواست بازرسی
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <h3 class="mb-4">{{__('create new inspection')}}</h3>
            <form id="add-inspection" action="{{route('inspection.store')}}" method="post">
                @csrf
                <input type="hidden" name="counter" id="counter">
                <div class="form-container vertical">
                    <div class="lg:col-span-2">
                        <div
                            class="card adaptable-card !border-b pb-6 py-4 rounded-br-none rounded-bl-none">
                            <div class="card-body">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @if(auth()->user()->getRoleNames()->first() !== 'segment qc')
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('company unit')}}</label>
                                                <div>
                                                    <select class="input" name="unit_id" id="unit_id">
                                                        <option>{{__('choose')}}</option>
                                                        @foreach(auth()->user()->company->companyUnits as $unit)
                                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('inspection location')}}</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="location" name="location"
                                                       autocomplete="off" value="">
                                                <div class="error error-email text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('coordinator')}}</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="coordinator" name="coordinator"
                                                       autocomplete="off" value="">
                                                <div class="error error-email text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <label class="form-label mb-2">{{__('inspection date')}}</label>
                                        <span class="input-wrapper">
																		<input
                                                                            class="input pr-8 pwt-datepicker-input-element"
                                                                            type="text" id="datepicker"
                                                                            name="inspection_date"
                                                                            placeholder="یک تاریخ انتخاب کنید">
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
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('inspection type')}}</label>
                                            <div>
                                                <select class="input" name="inspection_type" id="inspection_type">
                                                    <option>{{__('choose')}}</option>
                                                    <option value="good">{{__('good inspection')}}</option>
                                                    <option value="technical">{{__('technical inspection')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div id="technical-tests" class="w-full hidden">
                                    <table class="table-default table-hover data-table">
                                        <thead>
                                        <tr class="text-center">
                                            <td>{{__('serial_no')}}</td>
                                            <td>{{__('size')}}</td>
                                            <td>{{__('manufacture')}}</td>
                                            <td>{{__('ITP/Scope')}}</td>
                                            <td>{{__('tests')}}</td>
                                            <td>{{__('action')}}</td>
                                        </tr>
                                        </thead>

                                        <tbody class="items">
                                        </tbody>
                                    </table>
                                    <button id="add-new-row" type="button"
                                            class="btn btn-xs btn-solid mb-2 add_unit">{{__('add new row')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="stickyFooter"
                         class="sticky -bottom-1 -mx-8 px-8 flex items-center justify-end py-4">
                        <div class="md:flex items-center">
                            <button id="submit-btn" class="btn btn-solid btn-sm" type="button">
														<span class="flex items-center justify-center">
															<span class="text-lg">
																<svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 24 24" stroke-width="1.5"
                                                                     stroke="currentColor" aria-hidden="true"
                                                                     class="w-6 h-6">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M12 6v12m6-6H6">
                                                                        </path>
                                                                    </svg>
															</span>
															<span
                                                                class="ltr:ml-1 rtl:mr-1">{{__('create inspection')}}</span>
														</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let tests = []
        let counter = 0
        $('#inspection_type').change(function () {
            const type = $(this).find(":selected").val()
            $.ajax({
                url: `{{ url('users/get-tests') }}/${type}`,
                type: 'get',
                processData: false, // Disable processData for FormData
                contentType: false,
                success: function (response) {
                    tests = response.tests
                    if (type === 'technical') {
                        $('#technical-tests').removeClass('hidden')
                        appendItems('items')
                        addSelect2(counter)
                    } else {
                        $('#goods-tests').removeClass('hidden')
                    }
                },
                error: function (xhr) {
                    toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان نمایید.')
                    setTimeout(function () {
                        // location.reload();
                    }, 1500)
                }
            });
        })

        function addSelect2(counter) {
            let $select = $(`.tests-options-${counter}`),
                $parent = $select.parent();

            $select.select2({
                dropdownParent: $parent,
                allowClear: true,
            });
            // Add Tailwind classes to Select2
            $('.select2-container').addClass('w-full');
            $('.select2-selection').addClass('rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm');
            $('.select2-dropdown').addClass('bg-white border border-gray-300 rounded-md shadow-lg text-sm');
            $('.select2-results__option').addClass('p-2 hover:bg-indigo-100');
            $('.select2-results__option--highlighted').addClass('bg-indigo-500 text-white');
        }

        function appendItems(elm_class) {
            ++counter
            $('#counter').val(counter);
            $(`.${elm_class}`).append(`<tr>
                                            <td><input class="input" type="text" name="serial_no_${counter}[]"></td>
                                            <td><input class="input" type="text" name="size_${counter}[]"></td>
                                            <td><input class="input" type="text" name="manufacture_${counter}[]"></td>
                                            <td><input class="input" type="file" accept=".pdf" name="file_${counter}[]"></td>
                                            <td>
                                                <select class="input tests-options-${counter}" name="tests_${counter}[]" multiple>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white mb-2 delete-unit">{{__('delete')}}</button>
                                            </td>
                                        </tr>`)
            tests.forEach(test => {
                $(`.tests-options-${counter}`).append(`<option value="${test.id}">${test.name}</option>`)
            })
        }

        $('#add-new-row').click(function (e) {
            e.preventDefault()
            appendItems('items')
            addSelect2(counter)
        })

        $('.items').on('click', '.delete-unit', function () {
            if ($('.delete-unit').length > 1){
                $(this).closest('tr').remove()
                --counter
                $('#counter').val(counter)
            } else
                return false
        })

        $('#submit-btn').click(function (e) {
            e.preventDefault()
            ajaxRequests($('#add-inspection'), $(this))
        })
    </script>
@endsection
