@extends('layout.panel.main')

@section('title')
    ثبت اطلاعات شرکت
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <h3 class="mb-4">{{__('edit company')}}</h3>
            <div class="form-container vertical">
                <div class="lg:col-span-2">
                    <div
                        class="card adaptable-card !border-b pb-6 py-4 rounded-br-none rounded-bl-none">
                        <div class="card-body">
                            <form id="update-company" method="post"
                                  action="{{route('super-admin.companies.update',$company->id)}}">
                                @csrf
                                <input type="hidden" name="type" value="company">

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('company name')}}*</label>
                                            <div>
                                                <input class="input" type="text" name="name" id="name"
                                                       autocomplete="off"
                                                       value="{{$company->name}}">
                                                <span class="error error-name text-red-600 text-right"></span>
                                                <div id="company-list" class="w-full rounded-md border bg-white hidden"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('National Id')}}*</label>
                                            <div>
                                                <input class="input" type="text" name="national_id" id="national_id"
                                                       autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                       value="{{$company->national_id}}">
                                                <span class="error error-national_id text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('Economic Code')}}*</label>
                                            <div>
                                                <input class="input" type="text" name="economic_code" id="economic_code"
                                                       autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                       value="{{$company->economic_code}}">
                                                <span class="error error-economic_code text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('Registration Number')}}*</label>
                                            <div>
                                                <input class="input" type="text" name="registration_number" id="registration_number"
                                                       autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                       value="{{$company->registration_number}}">
                                                <span class="error error-registration_number text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('Fax')}}</label>
                                            <div>
                                                <input class="input" type="text" name="fax" id="fax"
                                                       autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                       value="{{$company->fax}}">
                                                <span class="error error-fax text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('Office Phone')}}*</label>
                                            <div>
                                                <input class="input" type="text" name="office_phone" id="office_phone"
                                                       autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                       value="{{$company->office_phone}}">
                                                <span class="error error-office_phone text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('state')}}*</label>
                                            <div>
                                                <select class="input" name="state_id" id="state_id">
                                                    @foreach($states as $state)
                                                        <option @if($company->city && $company->city->state->id === $state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('city')}}*</label>
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
                                            <label class="form-label mb-2">{{__('address')}}*</label>
                                            <div>
                                                <input class="input" type="text" name="address" id="address"
                                                       autocomplete="off"
                                                       value="{{$company->address}}">
                                                <span class="error error-address text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('zipcode')}}*</label>
                                            <div>
                                                <input class="input" type="text" name="zipcode" id="zipcode"
                                                       autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                       value="{{$company->zipcode}}">
                                                <span class="error error-zipcode text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="form-item vertical">
                                            <label class="form-label mb-2">{{__('logo')}}*<small class="text-rose-600 text-xs mr-2">{{__('(The logo image format must be PNG, JPG, JPEG, or WEBP, and the file size should not exceed 5 MB.)')}}</small></label>
                                            <div>
                                                <input class="input pl-8" type="file" name="logo" id="logo"
                                                       autocomplete="off" accept=".png, .jpg, .jpeg"
                                                       placeholder="انتخاب لوگو">
                                                <span class="error error-logo text-red-600 text-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="-bottom-1 -mx-8 px-8 flex items-center justify-end py-4">
                                    <div class="md:flex items-center">
                                        <button id="company-btn" class="btn btn-solid btn-sm" type="button">
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
                                                                class="ltr:ml-1 rtl:mr-1">{{__('update company')}}</span>
														</span>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            @if(count($company->companyUnits)>0)
                                <hr>
                                <h5 class="mb-3 mt-3">{{__('company units')}}</h5>
                                @php $i=0; @endphp
                                @foreach($company->companyUnits as $unit)
                                    <form id="update-unit-{{$unit->id}}"
                                          action="{{route('super-admin.companies.update',$company->id)}}"
                                          method="post">
                                        @csrf
                                        <input type="hidden" name="type" value="units">
                                        <input type="hidden" name="id" value="{{$unit->id}}">
                                        <div class="form-container inline">
                                            <div class="form-item inline">
                                                <label
                                                    class="form-label h-11 ltr:pr-2 rtl:pl-2">{{__('unit name')}}</label>
                                                <div>
                                                    <input class="input" type="text" name="unit_name"
                                                           placeholder=" نام بخش/ واحد" value="{{$unit->name}}">
                                                </div>
                                            </div>
                                            <div class="form-item inline">
                                                <label class="form-label"></label>
                                                <div>
                                                    <button
                                                        class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white mb-2 delete-unit"
                                                        type="button" data-id="{{$unit->id}}">
                                                        {{__('delete')}}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-item inline">
                                                <label class="form-label"></label>
                                                <div>
                                                    <button class="btn btn-solid mb-2 update-unit"
                                                            type="button" data-id="{{$unit->id}}">
                                                        {{__('update unit')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                            @endif

                            <hr>
                            <h5 class="mb-3 mt-3">{{__('add units')}}</h5>
                            <form id="add-units-form" method="post" action="{{route('super-admin.companies.units.add')}}">
                                @csrf
                                <input type="hidden" name="company_id" value="{{$company->id}}">
                                <div id="units-area">
                                    <div class="form-container inline">
                                        <div class="form-item inline">
                                            <label
                                                class="form-label h-11 ltr:pr-2 rtl:pl-2">{{__('unit name')}}</label>
                                            <div>
                                                <input class="input" type="text" name="unit_name[]"
                                                       placeholder=" نام بخش/ واحد" value="">
                                            </div>
                                        </div>
                                        <div class="form-item inline">
                                            <label class="form-label"></label>
                                            <div>
                                                <button
                                                    class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white mb-2 delete-unit"
                                                    type="button">
                                                    {{__('delete')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-item inline">
                                            <label class="form-label"></label>
                                            <div>
                                                <button class="btn btn-solid mb-2 add_unit" type="button">
                                                    {{__('add new row')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="-bottom-1 -mx-8 px-8 flex items-center justify-end py-4">
                                    <div class="md:flex items-center">
                                        <button id="add-unit-btn" class="btn btn-solid btn-sm" type="button">
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
                                                                class="ltr:ml-1 rtl:mr-1">{{__('add units')}}</span>
														</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#state_id').on('change', function () {
            let stateId = $(this).find(":selected").val()
            $.ajax({
                url: `{{ url('super-admin/get-cities')}}/${stateId}`,
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

        $('.add_unit').click(function () {
            $('#units-area').append(`<div class="form-container inline">
                                    <div class="form-item inline">
                                        <label class="form-label h-11 ltr:pr-2 rtl:pl-2">{{__('unit name')}}</label>
                                        <div>
                                            <input class="input" type="text" name="unit_name[]" placeholder=" نام بخش/ واحد" value="">
                                        </div>
                                    </div>

    <div class="form-item inline">
        <label class="form-label"></label>
        <div>
            <button class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white mb-2 delete-unit" type="button">
{{__('delete')}}
            </button>
        </div>
    </div>
</div>`)
        })

        $('#units-area').on('click', '.delete-unit', function () {
            if ($('.delete-unit').length > 1)
                $(this).closest('.form-container').remove()
            else
                return false
        })

        $('#company-btn').click(function (e) {
            e.preventDefault()
            ajaxRequests($('#update-company'), $(this))
        })

        $('#units-btn').click(function (e) {
            e.preventDefault()
            ajaxRequests($('#update-units'), $(this))
        })

        $('.update-unit').click(function (e) {
            e.preventDefault()
            ajaxRequests($(`#update-unit-${$(this).data('id')}`), $(this))
        })

        $('.delete-unit').click(function (e) {
            e.preventDefault()
            let unitId = $(this).data('id');
            let url = "{{ route('super-admin.companies.unit.delete', ':id') }}";
            url = url.replace(':id', unitId);
            $.ajax({
                url,
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                type: 'post',
                success: function (response) {
                    if (response.status === 200 || response.status === 100) {
                        toastr.success(response.message)
                        setTimeout(function () {
                            if (response.reload)
                                location.reload()
                            if (response.url) {
                                if (response.url.includes('http'))
                                    window.location.href = response.url
                                else
                                    window.location.href = window.location.origin + response.url
                            }
                        }, 1500)

                    } else if (response.status == 500) {
                        toastr.error(response.message);
                    } else if (response.status === 300)
                        window.location.href = window.location.origin + response.url
                },
                error: function (xhr) {
                    toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان کنید.')
                    setTimeout(function () {
                        // location.reload();
                    }, 1500)
                }
            });
        })

        $('#add-unit-btn').click(function (e) {
            e.preventDefault()
            ajaxRequests($('#add-units-form'),$(this))
        })
    </script>
@endsection
