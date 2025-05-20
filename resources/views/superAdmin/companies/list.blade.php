@extends('layout.panel.main')

@section('title')
    لیست شرکت‌ها
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="inline-block">{{__('companies list')}}</h3>
                @can('create company')
                    <a href="{{route('super-admin.companies.create')}}" class="btn btn-solid mr-2">
					<span
                        class="flex items-center justify-center gap-2">
                        <span class="text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                        </span>
                        <span>{{__('create new company')}}</span>
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
                                            <td>{{__("number")}} {{__("company")}}</td>
                                            <th>{{__("name")}}</th>
                                            <th>{{__("National Id")}}</th>
                                            <th>{{__("Economic Code")}}</th>
                                            <th>{{__("Registration Number")}}</th>
                                            <th>{{__("Office Phone")}}</th>
                                            <th>{{__("Fax")}}</th>
                                            <th>{{__("state")}}</th>
                                            <th>{{__("zipcode")}}</th>
                                            <th>{{__("logo")}}</th>
                                            <th>{{__("created at")}}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($companies)>0)
                                            @foreach($companies as $company)

                                                <tr class="whitespace-nowrap">
                                                    <td>{{$company->id}}</td>
                                                    <td>
                                                        <div class="flex items-center">
                                                            <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"
                                                               href="#?id=1">{{$company->name}}</a>
                                                        </div>
                                                    </td>
                                                    <td>{{$company->national_id}}</td>
                                                    <td>{{$company->economic_code}}</td>
                                                    <td>{{$company->registration_number}}</td>
                                                    <td>{{$company->office_phone}}</td>
                                                    <td>{{$company->fax??"-"}}</td>
                                                    <td>{{$company->city?$company->city->state->name:"-"}}</td>
                                                    <td>{{$company->zipcode}}</td>
                                                    <td>
                                                        @if($company->logo)
                                                            <img class="avatar-img rounded-full w-[50px]"
                                                                 src="{{asset("assets/img/company-logo/$company->logo")}}"
                                                                 height="50"
                                                                 loading="lazy">
                                                        @else
                                                            -
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <div
                                                            class="flex items-center">{{jdate_from_gregorian($company->created_at)}}</div>
                                                    </td>
                                                    <td>
                                                        @can('edit company')
                                                            <a href="{{route('super-admin.companies.edit',$company->id)}}"
                                                               class="text-primary-600 cursor-pointer select-none font-semibold hover:bg-emerald-100 p-2 rounded-md">
                                                                ویرایش
                                                            </a>
                                                        @endcan
                                                        @can('delete company')
                                                            <button data-company-id="{{$company->id}}"
                                                                    class="delete-btn text-rose-600 cursor-pointer select-none font-semibold mr-3 hover:bg-rose-100 p-2 rounded-md">
                                                                حذف
                                                            </button>
                                                        @endcan
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
    <script>
        $('#data-table').DataTable();

        $('.delete-btn').on('click', function () {
            let company_id = $(this).data('company-id');

            Swal.fire({
                title: 'هشدار!',
                text: 'آیا مطمئن هستید که می‌خواهید این شرکت را حذف کنید؟ تمام سوابق شرکت حذف خواهد شد و قابل بازگردانی نیست.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله',
                cancelButtonText: 'لغو',
                customClass: {
                    confirmButton: 'swal-confirm-button',
                    cancelButton: 'swal-cancel-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `delete-company/${company_id}`,
                        type: 'get',
                        success: function (response) {
                            if (response.status === 200 || response.status === 100) {
                                toastr.success(response.message)
                                setTimeout(function () {
                                    if (response.reload)
                                        location.reload()
                                }, 1500)

                            } else if (response.status == 500) {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان کنید.')
                            setTimeout(function () {
                                // location.reload();
                            }, 1500)
                        }
                    });
                }
            });
        })
    </script>
@endsection
