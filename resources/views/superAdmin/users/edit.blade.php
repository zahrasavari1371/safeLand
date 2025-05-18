@extends('layout.panel.main')

@section('title')
    ثبت اطلاعات کاربر
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <h3 class="mb-4">{{__('update user')}}</h3>
            <form id="update-user-form" action="{{route('super-admin.users.update',$user->id,$type)}}" method="post">
                @csrf
                <div class="form-container vertical">
                    <div class="lg:col-span-2">
                        <div
                            class="card adaptable-card !border-b pb-6 py-4 rounded-br-none rounded-bl-none">
                            <div class="card-body">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('name')}}</label>
                                            <div>
                                                <input class="input" type="text" name="name" id="name"
                                                       autocomplete="off" value="{{$user->name}}"
                                                       placeholder="نام" oninput="validatePersian(this)">
                                                <span class="error error-name text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('surname')}}</label>
                                            <div>
                                                <input class="input pl-8" type="text" name="surname" id="surname"
                                                       autocomplete="off" value="{{$user->surname}}"
                                                       placeholder="نام خانوادگی" oninput="validatePersian(this)">
                                                <span class="error error-surname text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('email')}}</label>
                                            <div>
                                                <input class="input pl-8" type="email" name="email" autocomplete="off"
                                                       value="{{$user->email}}" placeholder="ایمیل">
                                                <span class="error error-email text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('mobile')}}</label>
                                            <div>
                                                <input class="input" type="text" name="mobile" autocomplete="off"
                                                       value="{{$user->mobile}}" placeholder="موبایل">
                                                <span class="error error-mobile text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('user status')}}</label>
                                            <div>
                                                <select class="input" name="is_active" id="is_active">
                                                    <option @if($user->is_active) selected
                                                            @endif value="1">{{__('active')}}</option>
                                                    <option @if(!$user->is_active) selected
                                                            @endif value="0">{{__('inactive')}}</option>
                                                </select>
                                                <span class="error error-is_active text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($type === 'safeLand')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('user company role')}}</label>
                                                <div>
                                                    <select class="input" name="role" id="role">
                                                        <option selected>انتخاب کنید...</option>
                                                        @foreach($roles as $role)
                                                            <option
                                                                @if($user->roles->first()->id === $role->id) selected
                                                                @endif value="{{$role->id}}">{{rolesFaName($role->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error error-role text-red-600 text-right"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($type === 'other')
                            <div class="card adaptable-card pb-6 py-4">
                                <div class="card-body">
                                    <h5 class="mb-3">{{__('company information')}}</h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('company name')}}</label>
                                                <div>
                                                    <select class="input" name="company_id" id="company_id">
                                                        <option selected>انتخاب کنید...</option>
                                                        @foreach($companies as $company)
                                                            @php
                                                                $company_id=$user->companyUnit?$user->companyUnit->company->id:$user->company->id;
                                                            @endphp
                                                            <option @if($company_id === $company->id)selected
                                                                    @endif value="{{$company->id}}">{{$company->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error error-company_id text-red-600 text-right"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('company unit')}}</label>
                                                <div>
                                                    <select class="input" name="company_unit" id="company_unit">
                                                        @if($user->companyUnit)
                                                            @foreach($user->companyUnit->company->companyUnits as $unit)
                                                                <option
                                                                    @if($user->company_unit_id == $unit->id) selected
                                                                    @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="">انتخاب کنید</option>
                                                            @foreach($user->company->companyUnits as $unit)
                                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                    <span
                                                        class="error error-company_unit text-red-600 text-right"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="col-span-1">
                                            <div class="form-item vertical">
                                                <label class="form-label mb-2">{{__('user company role')}}</label>
                                                <div>
                                                    <select class="input" name="role" id="role">
                                                        <option selected>انتخاب کنید...</option>
                                                        @foreach($roles as $role)
                                                            <option
                                                                @if($user->roles->first()->id === $role->id) selected
                                                                @endif value="{{$role->id}}">{{rolesFaName($role->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error error-role text-red-600 text-right"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div id="stickyFooter"
                         class="sticky -bottom-1 -mx-8 px-8 flex items-center justify-end py-4">
                        <div class="md:flex items-center">
                            <button class="btn btn-solid btn-sm" type="button" id="update-user">
                                <span class="flex items-center justify-center">
                                    <span class="text-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                             class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="ltr:ml-1 rtl:mr-1">{{__('update user')}}</span>
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
                },
                error: function (xhr) {
                    toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان کنید.')
                }
            });
        })

        $('#update-user').click(function (e) {
            e.preventDefault()
            ajaxRequests($('#update-user-form'), $(this))
        })
    </script>
@endsection
