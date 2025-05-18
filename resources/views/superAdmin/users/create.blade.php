@extends('layout.panel.main')

@section('title')
    ثبت اطلاعات کاربر
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <h3 class="mb-4">{{__('create new user')}}</h3>
            <form id="add-user-form" action="{{route('super-admin.users.store')}}" method="post">
                @csrf
                <input type="hidden" name="type" value="{{$type}}">
                <div class="form-container vertical">
                    <div class="lg:col-span-2">
                        @if($type === 'other')
                            <div class="card adaptable-card pb-6 py-4">
                                <div class="card-body">

                                    <h5 class="mb-3 inline-block">{{__('company information')}}</h5>
                                    <span
                                        class="text-red-600">(لطفا برای سمت‌های کنترل کیفی و ناظر، بخش مشخص نکنید.)</span>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('company name')}}</label>
                                                <div>
                                                    <select class="input" name="company_id" id="company_id">
                                                        <option selected value="">انتخاب کنید...</option>
                                                        @foreach($companies as $company)
                                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="error error-company_id font-bold my-3 text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('company unit')}}</label>
                                                <div>
                                                    <select class="input" name="company_unit" id="company_unit">
                                                        <option selected value="">انتخاب کنید...</option>
                                                    </select>
                                                </div>
                                                <div class="error error-company_unit font-bold my-3 text-red-600 text-right"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="users-table" class="card adaptable-card hidden">
                                <div class="card-body">
                                    <div class="overflow-x-auto">
                                        <div id="product-list-data-table_wrapper" class="dataTables_wrapper no-footer">
                                            <div class="overflow-x-auto">
                                                <table id="product-list-data-table"
                                                       class="table-default table-hover data-table dataTable no-footer"
                                                       role="grid" aria-describedby="product-list-data-table_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0"
                                                            aria-controls="product-list-data-table" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="نام: activate to sort column descending"
                                                            style="width: 343.9px;">نام
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="product-list-data-table" rowspan="1" colspan="1"
                                                            aria-label="دسته&zwnj;بندی: activate to sort column ascending"
                                                            style="width: 100.137px;">ایمیل
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="product-list-data-table" rowspan="1" colspan="1"
                                                            aria-label="تعداد: activate to sort column ascending"
                                                            style="width: 64.613px;">موبایل
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="product-list-data-table" rowspan="1" colspan="1"
                                                            aria-label="وضعیت: activate to sort column ascending"
                                                            style="width: 111.375px;">بخش
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="product-list-data-table" rowspan="1" colspan="1"
                                                            aria-label="قیمت: activate to sort column ascending"
                                                            style="width: 94.675px;">سمت
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="product-list-data-table" rowspan="1" colspan="1"
                                                            aria-label=": activate to sort column ascending"
                                                            style="width: 122.5px;"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="users">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div
                            class="card adaptable-card !border-b pb-6 py-4 rounded-br-none rounded-bl-none">
                            <div class="card-body">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('name')}}</label>
                                            <div>
                                                <input class="input" type="text" name="name" id="name"
                                                       autocomplete="off" placeholder="نام" oninput="validatePersian(this)">
                                                <span class="error error-name text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('surname')}}</label>
                                            <div>
                                                <input class="input pl-8" type="text" name="surname" id="surname"
                                                       autocomplete="off" placeholder="نام خانوادگی" oninput="validatePersian(this)">
                                                <span class="error error-surname text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('email')}}</label>
                                            <div>
                                                <input class="input pl-8" type="email" name="email" autocomplete="off"
                                                       placeholder="ایمیل">
                                                <span class="error error-email text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('mobile')}}</label>
                                            <div>
                                                <input class="input" type="text" name="mobile" autocomplete="off"
                                                       placeholder="موبایل">
                                                <span class="error error-mobile text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('user company role')}}</label>
                                            <div>
                                                <select class="input" name="role" id="role">
                                                    <option selected value="">انتخاب کنید...</option>
                                                    @foreach($roles as $role)
                                                        <option
                                                            value="{{$role->id}}">{{rolesFaName($role->name)}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error error-role text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="stickyFooter"
                         class="sticky -bottom-1 -mx-8 px-8 flex items-center justify-end py-4">
                        <div class="md:flex items-center">
                            <button class="btn btn-solid btn-sm" type="button" id="add-user">
                                <span class="flex items-center justify-center">
                                    <span class="text-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                             class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="ltr:ml-1 rtl:mr-1">{{__('create user')}}</span>
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
        $('#company_id').change(function () {
            const id = $(this).find(":selected").val()
            $.ajax({
                url: `{{ url('super-admin/get-information') }}/${id}`,
                type: 'get',
                processData: false, // Disable processData for FormData
                contentType: false,
                success: function (response) {
                    $('#company_unit').empty()
                    $('#company_unit').append(`<option value="">انتخاب کنید...</option>`)
                    response.units.forEach(unit => {
                        $('#company_unit').append(`<option value="${unit.id}">${unit.name}</option>`)
                    })
                    if (response.users.length > 0) {
                        $('#users-table').removeClass('hidden')
                        $('#users').empty()
                        response.users.forEach(user => {
                            $('#users').append(`<tr role="row" class="odd whitespace-nowrap">
                                                    <td class="sorting_1">
                                                        <div class="flex items-center">
                                                            <span class="ml-2 rtl:mr-2 font-semibold">${user.name} ${user.surname}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="capitalize">${user.email}</span>
                                                    </td>
                                                    <td>${user.mobile}</td>
                                                    <td>${user.company_unit ? user.company_unit.name : '-'}</td>
                                                    <td>${rolesFaName(user.roles[0].name)}</td>

                                                </tr>`)
                        })
                    }else {
                        $('#users-table').addClass('hidden')
                        $('#users').empty()
                    }
                },
                error: function (xhr) {
                    toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان کنید.')
                }
            });
        })

        $('#add-user').click(function (e) {
            e.preventDefault()
            ajaxRequests($('#add-user-form'), $(this))
        })
    </script>
@endsection
