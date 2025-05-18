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
                                            <label class="form-label mb-2">{{__('inspection state')}}*</label>
                                            <div>
                                                <select class="input" name="state_id" id="state_id">
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('inspection city')}}*</label>
                                            <div>
                                                <select class="input" name="city_id" id="city_id">
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('inspection location')}}*</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="location" name="location"
                                                       autocomplete="off" value="">
                                                <div class="error error-location text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('coordinator')}}*</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="coordinator" name="coordinator"
                                                       autocomplete="off" value="">
                                                <div class="error error-coordinator text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('coordinator mobile')}}*</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="coordinator_mobile"
                                                       name="coordinator_mobile"
                                                       autocomplete="off" value="">
                                                <div
                                                    class="error error-coordinator_mobile text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('manufacture')}}*</label>
                                            <div class="text-end">
                                                <input class="input" type="text" id="manufacturer" name="manufacturer"
                                                       autocomplete="off" value="">
                                                <div class="error error-manufacturer text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <label class="form-label mb-2">{{__('inspection date')}}</label>
                                        <span class="input-wrapper">
                                            <input class="input datepicker pr-8 pwt-datepicker-input-element"
                                                   type="text" name="inspection_date" placeholder="یک تاریخ انتخاب کنید"
                                                   readonly>
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
                                            <label class="form-label mb-2">{{__('inspection type')}}*</label>
                                            <div>
                                                <select class="input" name="inspection_type" id="inspection_type">
                                                    <option>{{__('choose')}}</option>
                                                    <option value="good">{{__('good inspection')}}</option>
                                                    <option value="technical">{{__('technical inspection')}}</option>
                                                </select>
                                                <div class="error error-inspection_type text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="error error-list font-bold my-3 text-red-600 text-right"></div>
                                <div id="technical-tests" class="w-full text-center hidden">
                                    <div id="product-list-data-table_wrapper" class="dataTables_wrapper no-footer">
                                        <div class="overflow-x-auto">
                                            <table id="product-list-data-table"
                                                   class="table-default table-hover data-table dataTable no-footer"
                                                   role="grid" aria-describedby="product-list-data-table_info">
                                                <thead>
                                                <tr class="text-center">
                                                    <td>{{__('#')}}</td>
                                                    <td>{{__('equipment name')}}</td>
                                                    <td>{{__('serial_no')}}</td>
                                                    <td>{{__('size')}}</td>
                                                    <td>{{__('ITP/Scope')}}</td>
                                                    <td>{{__('tests')}}</td>
                                                    <td>{{__('other tests')}}</td>
                                                    <td>{{__('action')}}</td>
                                                </tr>
                                                </thead>

                                                <tbody class="items">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="button"
                                            class="btn btn-xs btn-solid my-4 show-modal-btn" data-bs-toggle="modal"
                                            data-bs-target="#add-equipment-modal">{{__('add equipment')}}</button>
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
            <div class="modal fade" id="add-equipment-modal" tabindex="-1" aria-hidden="false" aria-modal="true">
                <div class="modal-dialog dialog md:max-w-[700px]">
                    <div class="dialog-content">
            <span class="close-btn absolute z-10 ltr:right-6 rtl:left-6" role="button" data-bs-dismiss="modal">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true"
                     height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </span>
                        <h5 class="mb-4">{{__('add equipment form')}}</h5>
                        <hr>
                        <div class="grid grid-cols-1 mt-4 md:grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <div class="form-item vertical">
                                    <label class="form-label mb-2">{{__('equipment name')}}</label>
                                    <input class="input" type="text" name="name" placeholder="">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-item vertical">
                                    <label class="form-label mb-2">{{__('serial_no')}}</label>
                                    <input class="input" type="text" name="serial_no">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-item vertical">
                                    <label class="form-label mb-2">{{__('size')}}</label>
                                    <input class="input pl-2" type="text" name="size" dir="ltr">
                                </div>
                            </div>
                            <div class="col-span-4">
                                <div class="form-item vertical">
                                    <label class="form-label mb-2">{{__('tests')}}</label>
                                    <select class="input tests-options" name="tests-options[]" id="tests-options"
                                            multiple="multiple"></select>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <div id="other-tests" class="form-item hidden">
                                    <label class="form-label mb-2">{{__('other tests')}}</label>
                                    <select class="input description-options" name="other_tests[]" id="other_tests"
                                            multiple></select>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <div class="form-item vertical">
                                    <label class="form-label mb-2">{{__('ITP/Scope')}}</label>
                                    <label for="file-input" class="btn border w-full text-center cursor-pointer">
                                        {{__('Select Files')}}
                                    </label>
                                    <input class="file-input hidden" type="file" name="itp_scope[]" id="file-input"
                                           multiple>

                                    <div id="drop-zone"
                                         class="border-dashed border-2 border-gray-300 p-4 text-center mt-2 cursor-pointer">
                                        {{__('Or drag and drop files here')}}
                                    </div>

                                    <div class="flex flex-wrap">
                                        <div id="file-names-container" class="flex flex-wrap gap-2 mt-2"></div>

                                        <div id="upload-loader" class="hidden mx-2 mt-2">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                 version="1.1"
                                                 viewBox="0 0 16 16"
                                                 class="animate-spin text-primary-600 h-[30px] w-[35px]" height="1em"
                                                 width="1em"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8 0c-4.355 0-7.898 3.481-7.998 7.812 0.092-3.779 2.966-6.812 6.498-6.812 3.59 0 6.5 3.134 6.5 7 0 0.828 0.672 1.5 1.5 1.5s1.5-0.672 1.5-1.5c0-4.418-3.582-8-8-8zM8 16c4.355 0 7.898-3.481 7.998-7.812-0.092 3.779-2.966 6.812-6.498 6.812-3.59 0-6.5-3.134-6.5-7 0-0.828-0.672-1.5-1.5-1.5s-1.5 0.672-1.5 1.5c0 4.418 3.582 8 8 8z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-4">
                                <label class="checkbox-label">
                                    <input class="checkbox" type="checkbox" name="accept_not_itp" id="accept_not_itp">
                                    <span>{{__("I do not have the ITP/Scope file and accept responsibility for the inspection without uploading the file.")}}</span>
                                </label>
                            </div>
                        </div>
                        <div class="text-right mt-6">
                            <button id="add-equipment-btn" class="btn btn-solid">{{__('Confirm')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let tests = [];
        let cities = [];
        let selectedFiles = [];
        let equipmentList = [];
        let editIndex = null;
        let counter = 0;

        $('#inspection_type').change(function () {
            const type = $(this).find(":selected").val()
            $.ajax({
                url: `{{ url('users/get-tests') }}/${type}`,
                type: 'get',
                processData: false, // Disable processData for FormData
                contentType: false,
                success: function (response) {
                    tests = response.tests
                    tests.push({id: 0, name: "Other"})
                    $('#technical-tests').removeClass('hidden')
                    $("#tests-options").empty()

                    if (type === 'technical') {
                        // نمایش تست‌ها بدون دسته‌بندی برای بازرسی فنی
                        tests.forEach(test => {
                            $("#tests-options").append(`<option value="${test.id}">${test.name}</option>`);
                        });
                    } else if (type === "good") {
                        // دسته‌بندی تست‌ها برای بازرسی کالا
                        let groupedTests = {};

                        // مرتب‌سازی تست‌ها بر اساس parent_id
                        tests.forEach(test => {
                            if (test.parent_id) {
                                // اگر تست زیرمجموعه دارد، آن را به والدش اضافه کن
                                if (!groupedTests[test.parent_id]) {
                                    groupedTests[test.parent_id] = {name: "", children: []};
                                }
                                groupedTests[test.parent_id].children.push(test);
                            } else {
                                // تست‌های والد
                                groupedTests[test.id] = {
                                    name: test.name,
                                    children: groupedTests[test.id]?.children || []
                                };
                            }
                        });

                        // ایجاد گزینه‌های دسته‌بندی‌شده
                        Object.keys(groupedTests).forEach(parentId => {
                            let parent = groupedTests[parentId];
                            if (parent.children.length > 0) {
                                let optgroup = $(`<optgroup label="${parent.name}"></optgroup>`);
                                parent.children.forEach(child => {
                                    optgroup.append(`<option value="${child.id}">${child.name}</option>`);
                                });
                                $("#tests-options").append(optgroup);
                            } else {
                                // اگر والد تست مستقل بود
                                $("#tests-options").append(`<option value="${parentId}">${parent.name}</option>`);
                            }
                        });
                    }
                    $("#tests-options").select2({
                        placeholder: "گزینه‌های موردنظر را انتخاب کنید",
                        allowClear: true,
                        width: "100%"
                    });

                },
                error: function (xhr) {
                    toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان نمایید.')
                }
            });
        })

        $('.items').on('click', '.delete-unit', function () {
            if ($('.delete-unit').length > 1) {
                $(this).closest('tr').remove()
                --counter
                $('#counter').val(counter)
            } else
                return false
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
                    toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان نمایید.')
                }
            });
        })

        $('#file-input').on('change', function (event) {
            handleFiles(event.target.files);
        });

        $('#drop-zone').on('dragover', function (event) {
            event.preventDefault();
            $(this).addClass('bg-gray-200');
        });

        $('#drop-zone').on('dragleave', function () {
            $(this).removeClass('bg-gray-200');
        });

        $('#drop-zone').on('drop', function (event) {
            event.preventDefault();
            $(this).removeClass('bg-gray-200');
            let files = event.originalEvent.dataTransfer.files;
            handleFiles(files);
        });


        function handleFiles(files) {
            let fileList = Array.from(files);
            let totalFileSize = fileList.reduce((sum, file) => sum + file.size, 0) / (1024 * 1024);
            let uploadSpeed = 2; // MB/s
            let estimatedTime = Math.max(1, Math.ceil(totalFileSize / uploadSpeed)) * 1000;

            $("#upload-loader").removeClass("hidden");

            setTimeout(() => {
                fileList.forEach((file) => {
                    if (!selectedFiles.some(f => f.name === file.name)) {
                        selectedFiles.push(file);
                    }
                });
                updateFileList();
                $("#upload-loader").addClass("hidden");
            }, estimatedTime);
        }

        $('#tests-options').on('change', function () {
            if ($(this).val().includes('0')) {
                $('#other-tests').removeClass('hidden')
                $("#other_tests").select2({
                    tags: true,
                    placeholder: "نام تست ها را بنویسید و اینتر بزنید",
                    allowClear: true,
                    tokenSeparators: [], // جلوگیری از افزودن با Space
                    createTag: function (params) {
                        return {
                            id: $.trim(params.term), // حذف فاصله‌های اضافی
                            text: $.trim(params.term),
                            newTag: true
                        };
                    }
                });
            }
        })

        $("#other_tests").on("keypress", function (e) {
            if (e.which === 32) { // 32 = Space
                e.preventDefault();
            }
        });

        $("#add-equipment-btn").on("click", function () {
            let equipmentName = $("input[name='name']").val();
            let serialNo = $("input[name='serial_no']").val();
            let size = $("input[name='size']").val();
            let accept_no_itp = $("input[name='accept_not_itp']").prop('checked')

            // دریافت نام تست‌ها برای نمایش در جدول
            let tests = $("#tests-options").select2("data").map(item => item.text) || [];
            // دریافت آیدی تست‌ها برای ارسال به سرور
            let testIds = $("#tests-options").val() || [];

            let other_tests = $("#other_tests").hasClass("select2-hidden-accessible")
                ? $("#other_tests").select2("data").map(item => item.text)
                : [];

            let files = $("#file-input")[0].files;
            let fileObjects = [];

            for (let file of files) {
                fileObjects.push(file);
            }

            if (!equipmentName || !serialNo || !size || !tests.length) {
                toastr.error("لطفاً پیش از تایید، تمامی فیلدها را تکمیل نمایید.");
                return;
            }

            if (!files.length && !accept_no_itp) {
                toastr.error('در صورتی که فایل ITP/Scope موجود نیست، لطفاً مسئولیت بازرسی بدون فایل را بپذیرید.')
                return;
            }

            let equipment = {
                equipment_name: equipmentName,
                serial_no: serialNo,
                size: size,
                tests: tests.length > 0 ? tests : ["تعیین نشده"], // نمایش نام تست‌ها
                test_ids: testIds, // ارسال آیدی تست‌ها به سرور
                other_tests: other_tests.length > 0 ? other_tests : ["ندارد"],
                files: fileObjects.length > 0 ? fileObjects : ["آپلود نشده"], // نمایش متن در صورت نبودن فایل
            };

            if (editIndex !== null) {
                equipmentList[editIndex] = equipment; // ویرایش تجهیز
                editIndex = null;
            } else {
                equipmentList.push(equipment); // اضافه کردن تجهیز جدید
            }

            $("#add-equipment-modal").on("hidden.bs.modal", function () {
                $("input[name='name']").val('')
                $("input[name='serial_no']").val('')
                $("input[name='size']").val('')
                $("#tests-options").val([]).trigger("change")
                $("#other_tests").val([]).trigger("change")
                $('#other-tests').addClass('hidden')
                $("#itp_scope").val('')
                $("#file-names-container").empty()
                $("#file-input").val("");
                selectedFiles = []
                $("input[name='accept_not_itp").prop('checked', false)
            });
            $('#add-equipment-modal').modal('hide');
            updateTable();
        });

        function updateTable() {
            let tbody = $(".items");
            tbody.empty();

            equipmentList.forEach((item, index) => {
                let row = `<tr class="text-center whitespace-nowrap">
            <td>${index + 1}</td>
            <td>${item.equipment_name}</td>
            <td>${item.serial_no}</td>
            <td>${item.size}</td>
            <td>${Array.isArray(item.files) ? item.files.map(file => `<span class="file-badge">${file.name || file}</span>`).join(" ") : "آپلود نشده"}</td>
            <td>${Array.isArray(item.tests) ? item.tests.map(test => `<span class="test-badge">${test}</span>`).join(" ") : "تعیین نشده"}</td>
            <td>${Array.isArray(item.other_tests) ? item.other_tests.map(other_test => `<span class="test-badge">${other_test}</span>`).join(" ") : "تعیین نشده"}</td>
            <td>
                <button type="button" class="rounded-md p-3 text-xs bg-green-50 text-green-500 hover:bg-green-100 edit-equipment" data-index="${index}">ویرایش</button>
                <button type="button" class="rounded-md p-3 text-xs bg-rose-50 text-rose-500 hover:bg-rose-100 btn-danger remove-equipment" data-index="${index}">حذف</button>
            </td>
        </tr>`;
                tbody.append(row);
            });

            $(".remove-equipment").on("click", function () {
                let index = $(this).data("index");
                equipmentList.splice(index, 1);
                updateTable();
            });

            $(document).on("click", ".edit-equipment", function () {
                let index = $(this).data("index");
                let equipment = equipmentList[index];

                $("#add-equipment-modal [name='name']").val(equipment.equipment_name);
                $("#add-equipment-modal [name='serial_no']").val(equipment.serial_no);
                $("#add-equipment-modal [name='size']").val(equipment.size);
                if (equipment.files[0] == "آپلود نشده")
                    $('#accept_not_itp').prop('checked', true)

                // مقداردهی به select2 برای tests-options (هم نام تست‌ها و هم آیدی آن‌ها)
                let testsData = equipment.tests.map((name, i) => ({id: equipment.test_ids[i], text: name}));
                $("#tests-options").select2({
                    data: testsData,
                    tags: true
                }).val(equipment.test_ids).trigger("change");

                // مقداردهی به select2 برای other_tests
                if (equipment.other_tests[0] != 'ندارد') {
                    let otherTestsData = equipment.other_tests.map(item => ({id: item, text: item}));
                    $("#other_tests").select2({
                        data: otherTestsData,
                        tags: true
                    }).val(equipment.other_tests).trigger("change");
                }

                if (equipment.files[0] != 'آپلود نشده') {
                    selectedFiles = equipment.files
                    updateFileList()
                }

                editIndex = index;
                $("#add-equipment-modal").modal("show");
            });
        }

        $('#submit-btn').click(function (e) {
            e.preventDefault()

            let formData = new FormData();
            formData.append('_token', "{{csrf_token()}}")
            formData.append('unit_id', $('#unit_id').find(":selected").val())
            formData.append('city_id', $('#city_id').find(":selected").val())
            formData.append('inspection_type', $('#inspection_type').find(":selected").val())
            formData.append('location', $('#location').val())
            formData.append('coordinator', $('#coordinator').val())
            formData.append('coordinator_mobile', $('#coordinator_mobile').val())
            formData.append('manufacturer', $('#manufacturer').val())
            formData.append('inspection_date', $(".datepicker").val())
            formData.append('counter', equipmentList.length)
            equipmentList.forEach((item, index) => {
                formData.append(`equipment_name_${index + 1}`, item.equipment_name);
                formData.append(`serial_no_${index + 1}`, item.serial_no);
                formData.append(`size_${index + 1}`, item.size);
                formData.append(`tests_${index + 1}`, JSON.stringify(item.test_ids));
                formData.append(`description_${index + 1}`, item.other_tests);
                if (Array.isArray(item.files)) {
                    item.files.forEach(file => {
                        formData.append(`files_${index + 1}[]`, file);
                    });
                }
            });

            let ajaxData = {
                url: $('#add-inspection').attr("action"),
                method: $('#add-inspection').attr("method"),
                data: formData,
                button: $(this).attr('id'),
                processData: false,
                contentType: false
            };

            ajax(ajaxData)
        })

        function updateFileList() {
            let fileContainer = $("#file-names-container");
            fileContainer.empty();

            selectedFiles.forEach((file, index) => {
                let fileName = $("<span>").addClass("file-item").text(file.name);
                let removeBtn = $("<button>").addClass("remove-file mr-2").html("&times;").on("click", function () {
                    selectedFiles.splice(index, 1);
                    updateFileList();
                });

                let fileBox = $("<div>").addClass("file-box").append(fileName).append(removeBtn);
                fileContainer.append(fileBox);
            });

            let dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            document.getElementById("file-input").files = dataTransfer.files;
        }
    </script>
@endsection
