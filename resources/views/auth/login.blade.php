@extends('layout.auth.main')

@section('title')
    ورود
@endsection

@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col">
        <div class="h-full">
            <div
                class="container mx-auto flex flex-col flex-auto items-center justify-center min-w-0 h-full">
                <div class="card min-w-[320px] md:min-w-[450px] card-shadow" role="presentation">
                    <div class="card-body md:p-10">
                        <div class="text-center">
                            <img width="200" class="mx-auto my-3" src="{{asset('assets/img/logo.jpg')}}"
                                 alt="لوگوی Elstar">
                        </div>
                        <div class="text-center">
                            <div class="mb-4">
                                <h3 class="mb-1">خوش آمدید!</h3>
                                <p>برای دریافت کد ورود، لطفاً ایمیل خود را وارد کنید.</p>
                            </div>
                            <form id="login-form" class="needs-validation" action="{{route('send.code')}}"
                                  method="post">
                                @csrf
                                <div class="form-container vertical">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">ایمیل</label>
                                        <div class="text-end">
                                            <input class="input" type="text" id="email" name="email"
                                                   autocomplete="off" placeholder="ادرس ایمیل"
                                                   value="">
                                            <div class="error error-email text-red-600 text-right"></div>
                                        </div>
                                    </div>

                                    <div class="form-item hidden" id="code-area">
                                        <label class="form-label mb-2">کد ورود</label>

                                        <input class="input" type="text"
                                               name="code" autocomplete="off" value="">

                                        <div class="error error-code text-red-600 text-right"></div>
                                    </div>

                                    <button class="btn btn-solid w-full" type="button" id="send-code-btn">دریافت کد
                                        ورود
                                    </button>
                                    <button class="btn btn-solid w-full hidden mb-2" type="button" id="login-btn">ورود
                                    </button>
                                    <button type="button" id="resend-code"
                                            class="text-xs text-blue-500 hover:text-blue-700 hidden">{{__('Resend Code')}}</button>
                                    <span id="timer" class="text-blue-500 hidden"><span class="mx-2" id="second"></span>{{__(' Seconds to resend')}}</span>
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
        $('#send-code-btn').click(function (e) {
            e.preventDefault()
            sendCode($('#login-form'), $(this), showCodeArea)
        })

        $('#login-btn').click(function (e) {
            e.preventDefault()
            loginForm($('#login-form'), $(this))
        })

        function showCodeArea(response) {
            console.log(response);

            let token_time = response.code_time;
            let currentTime = Math.floor(Date.now() / 1000);

            $('#code-area').removeClass('hidden');
            $('#login-btn').removeClass('hidden');
            $('#send-code-btn').addClass('hidden');
            $('#resend-code').addClass('hidden');
            $('#email').attr('readonly', true);
            $('.error').empty();

            let timerInterval;

            function startTimer(remainingTime) {
                $('#timer').removeClass('hidden');

                clearInterval(timerInterval); // Clear any previous interval
                timerInterval = setInterval(function () {
                    if (remainingTime <= 0) {
                        clearInterval(timerInterval);
                        $('#resend-code').removeClass('hidden');
                        $('#resend-code').attr('disabled', false)
                        $('#resend-code').removeClass('bg-blue-600');
                        $('#timer').addClass('hidden');
                    } else {
                        $('#second').text(remainingTime);
                        remainingTime--;
                    }
                }, 1000);
            }

            if (!token_time) {
                $('#resend-code').removeClass('hidden');
                $('#resend-code').attr('disabled', false)
                $('#resend-code').removeClass('bg-blue-600');
                $('#timer').addClass('hidden');
            } else {
                let elapsedTime = currentTime - token_time;
                let remainingTime = 120 - elapsedTime;

                if (remainingTime > 0) {
                    startTimer(remainingTime);
                } else {
                    $('#resend-code').removeClass('hidden');
                    $('#resend-code').attr('disabled', false)
                    $('#resend-code').removeClass('bg-blue-600');
                    $('#timer').addClass('hidden');
                }
            }
        }

        // Handle resend code button click
        $('#resend-code').click(function (e) {
            e.preventDefault();
            sendCode($('#login-form'), $(this), showCodeArea);
        });


        // function showCodeArea(response) {
        //     console.log(response)
        //     let token_time = response.code_time
        //     let currentTime = Math.floor(Date.now() / 1000);
        //     $('#timer').removeClass('hidden')
        //     $('#code-area').removeClass('hidden')
        //     $('#login-btn').removeClass('hidden')
        //     $('#send-code-btn').addClass('hidden')
        //     $('#resend-code').addClass('hidden')
        //     $('#email').attr('readonly', true)
        //     $('.error').empty()
        //
        //     let timer = function (date) {
        //         let timer = date;
        //         setInterval(function () {
        //             if (--timer < 0) {
        //                 timer = 0;
        //                 $('#resend-code').removeClass('hidden')
        //                 $('#timer').addClass('hidden')
        //             }
        //             $('#second').text(timer.toFixed())
        //         }, 1000);
        //     }
        //
        //     if (!token_time) {
        //         $('#resend-code').removeClass('hidden');
        //         $('#timer').addClass('hidden');
        //     } else {
        //         let elapsedTime = currentTime - token_time;
        //         let remainingTime = 30 - elapsedTime;
        //
        //         if (remainingTime > 0) {
        //             $('#timer').removeClass('hidden');
        //             timer(remainingTime);
        //         } else {
        //             $('#resend-code').removeClass('hidden');
        //             $('#timer').addClass('hidden');
        //         }
        //     }
        // }
        //
        // $('#resend-code').click(function (e) {
        //     e.preventDefault()
        //     sendCode($('#login-form'), $(this), showCodeArea)
        // })
    </script>
@endsection
