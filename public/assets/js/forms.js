function loginForm(form, button) {
    let data = $(form).serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {})

    let formData = {
        action: form.attr('action'),
        method: form.attr('method'),
        data,
        formId: $(form).attr('id'),
        button: button.attr('id')
    }

    ajax(formData)
}

function sendCode(form, button,func_name) {
    let data = $(form).serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {})

    let formData = {
        url: form.attr('action'),
        method: form.attr('method'),
        data,
        formId: $(form).attr('id'),
        button: button.attr('id')
    }

    ajax(formData,func_name)
}

function ajaxRequests(form, button) {
    // Create a FormData object to handle form data including files
    let data = new FormData(form[0]);

    // Add additional metadata to the FormData object
    data.append('formId', $(form).attr('id'));
    // data.append('buttonId', button.attr('id'));

    // Pass action and method as additional data if needed
    let ajaxData = {
        url: form.attr('action'),
        method: form.attr('method'),
        data: data,
        button: button.attr('id'),
        processData: false,
        contentType: false
    };

    ajax(ajaxData);
}

function ajax(form, func_name = null, params = {}) {
    let action = typeof form === 'object' ? form.url : form.attr('action');
    let method = typeof form === 'object' ? form.method : form.attr('method');
    let data = typeof form === 'object' ? form.data : form.serialize();
    let button = typeof form === 'object' && form.button ? form.button : null;

    let button_text = $(`#${button}`).text();
    if (button) {
        $(`#${button}`).removeClass('bg-blue-600')
        $(`#${button}`).addClass('bg-blue-200')
        $(`#${button}`).attr('disabled', true)
        $(`#${button}`).text('درحال ارسال...')
    }

    $('.help-block').remove();
    $('span[class*="error-"]').text('');

    // Detect if the data is FormData
    let isFormData = data instanceof FormData;

    $.ajax({
        url: action,
        type: method,
        data: data,
        processData: !isFormData, // Disable processData for FormData
        contentType: isFormData ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function (response) {
            if (response.status === 200 || response.status === 100) {
                if (func_name != null)
                    func_name(response, params);

                if (button != null) {
                    $(`#${button}`).removeClass('bg-blue-200')
                    $(`#${button}`).addClass('bg-blue-600')
                    $(`#${button}`).attr('disabled', true)
                    $(`#${button}`).text(button_text)
                }
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

            } else if (response.status === 422) {
                if (button != null) {
                    $(`#${button}`).removeClass('bg-blue-200')
                    $(`#${button}`).addClass('bg-blue-600')
                    $(`#${button}`).attr('disabled', false)
                    $(`#${button}`).text(button_text)
                }
                showValidationErrors(response.errors)
            } else if (response.status == 500) {
                if (button != null) {
                    $(`#${button}`).removeClass('bg-blue-200')
                    $(`#${button}`).addClass('bg-blue-600')
                    $(`#${button}`).attr('disabled', false)
                    $(`#${button}`).text(button_text)
                }
                toastr.error(response.message);
            } else if (response.status === 300)
                window.location.href = window.location.origin + response.url
        },
        error: function (xhr) {
            if (button != null) {
                $(`#${button}`).removeClass('bg-blue-200')
                $(`#${button}`).addClass('bg-blue-600')
                $(`#${button}`).attr('disabled', false)
                $(`#${button}`).text(button_text)
            }
            toastr.error('با پوزش! مشکلی در سرور به وجود آمده است. لطفاً بعداً دوباره امتحان نمایید.')
            setTimeout(function () {
                // location.reload();
            }, 1500)
        }
    });
}

function showValidationErrors(errors, formId) {
    $('.error').html('')
    Object.keys(errors).forEach((key, index) => {
        $(`.error-${key}`).text(errors[key])
    });
}

function statusColor($status){
    switch ($status) {
        case '1':
            return ['text-sky-600','جدید'];
        case '6':
            return ['text-orange-600','درحال بازرسی'];
        case '2':
            return ['text-gray-600','تایید qc'];
        case '4':
            return ['text-gray-600','تایید مدیر عملیاتی'];
        case '8':
            return ['text-emerald-600','بازرسی شده'];
        case '3':
        case '5':
        case '7':
            return ['text-rose-600','رد شده'];
    }
}

function rolesFaName(role)
{
    switch (role) {
        case 'super admin':
            return 'سوپر ادمین';
        case 'admin':
            return 'ادمین';
        case 'inspector':
            return 'بازرس';
        case 'qc':
            return 'کنترل کیفی';
        case 'segment qc':
            return 'کنترل کیفی بخش';
        case 'supervisor':
            return 'مدیر عملیاتی';
    }
}

function validatePersian(input) {
    const formGroup = input.closest('.form-item');
    const errorSpan = formGroup.querySelector('span.error');

    // regex جدید: حروف فارسی، اعداد انگلیسی، فاصله
    const persianRegex = /^[\u0600-\u06FF0-9\s]*$/;

    if (!persianRegex.test(input.value)) {
        input.value = input.value.replace(/[^\u0600-\u06FF0-9\s]/g, '');
        errorSpan.textContent = "لطفاً زبان کیبورد را به فارسی تغییر دهید.";
    } else {
        errorSpan.textContent = "";
    }
}


