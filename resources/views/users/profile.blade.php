@extends('layout.panel.main')

@section('title')
    اطلاعات کاربر
@endsection

@section('content')
    <div
        class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <h3 class="mb-4">{{__('user information')}}</h3>
            <div class="form-container vertical">
                <div class="lg:col-span-2">
                    <div
                        class="card adaptable-card !border-b pb-6 py-4 rounded-br-none rounded-bl-none">
                        <div class="card-body">
                            <h4 class="my-5">{{__('personal information')}}</h4>
                            <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('name')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{auth()->user()->fullName()}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('email')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{auth()->user()->email}}">
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('company name')}}</label>
                                        @if(in_array(auth()->user()->getRoleNames()->first(),['super admin','admin','inspector']))
                                            <input class="input" type="text" disabled
                                                   value="-">
                                        @else
                                            <input class="input" type="text" disabled
                                                   value="{{auth()->user()->company_id?auth()->user()->company->name:auth()->user()->companyUnit->company->name}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">{{__('role')}}</label>
                                        <input class="input" type="text" disabled
                                               value="{{rolesFaName(auth()->user()->getRoleNames()->first())}}">

                                    </div>
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
        $('#change-password-btn').click(function (e){
            e.preventDefault()
            ajaxRequests($('#change-password'),$(this))
        })
    </script>
@endsection
