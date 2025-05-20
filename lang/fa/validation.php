<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute باید پذیرفته شود.',
    'accepted_if' => ':attribute باید پذیرفته شود زمانی که :other برابر با :value باشد.',
    'active_url' => ':attribute یک URL معتبر نیست.',
    'after' => ':attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal' => ':attribute باید تاریخی برابر یا بعد از :date باشد.',
    'alpha' => ':attribute باید فقط شامل حروف باشد.',
    'alpha_dash' => ':attribute باید فقط شامل حروف، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num' => ':attribute باید فقط شامل حروف و اعداد باشد.',
    'array' => ':attribute باید یک آرایه باشد.',
    'ascii' => ':attribute باید فقط شامل کاراکترهای الفبایی عددی تک بایتی و نمادها باشد.',
    'before' => ':attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal' => ':attribute باید تاریخی برابر یا قبل از :date باشد.',
    'between' => [
        'array' => ':attribute باید بین :min و :max آیتم داشته باشد.',
        'file' => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'string' => ':attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean' => 'مقدار :attribute باید صحیح یا غلط باشد.',
    'can' => ':attribute شامل یک مقدار غیرمجاز است.',
    'confirmed' => 'تاییدیه :attribute مطابقت ندارد.',
    'current_password' => 'رمز عبور اشتباه است.',
    'date' => ':attribute یک تاریخ معتبر نیست.',
    'date_equals' => ':attribute باید تاریخی برابر با :date باشد.',
    'date_format' => ':attribute باید با فرمت :format مطابقت داشته باشد.',
    'decimal' => ':attribute باید دارای :decimal رقم اعشار باشد.',
    'declined' => ':attribute باید رد شود.',
    'declined_if' => ':attribute باید رد شود زمانی که :other برابر با :value باشد.',
    'different' => ':attribute و :other باید متفاوت باشند.',
    'digits' => ':attribute باید :digits رقم باشد.',
    'digits_between' => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions' => 'ابعاد تصویر :attribute معتبر نیست.',
    'distinct' => ':attribute شامل مقدار تکراری است.',
    'doesnt_end_with' => ':attribute نباید با یکی از موارد زیر خاتمه یابد: :values.',
    'doesnt_start_with' => ':attribute نباید با یکی از موارد زیر شروع شود: :values.',
    'email' => ':attribute باید یک آدرس ایمیل معتبر باشد.',
    'ends_with' => ':attribute باید با یکی از موارد زیر خاتمه یابد: :values.',
    'enum' => ':attribute انتخاب‌شده معتبر نیست.',
    'exists' => ':attribute اشتباه وارد شده است.',
    'extensions' => ':attribute باید یکی از پسوندهای زیر را داشته باشد: :values.',
    'file' => ':attribute باید یک فایل باشد.',
    'filled' => ':attribute باید دارای مقدار باشد.',
    'gt' => [
        'array' => ':attribute باید بیشتر از :value آیتم داشته باشد.',
        'file' => ':attribute باید بزرگ‌تر از :value کیلوبایت باشد.',
        'numeric' => ':attribute باید بزرگ‌تر از :value باشد.',
        'string' => ':attribute باید بیشتر از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => ':attribute باید حداقل :value آیتم یا بیشتر داشته باشد.',
        'file' => ':attribute باید بزرگ‌تر یا برابر با :value کیلوبایت باشد.',
        'numeric' => ':attribute باید بزرگ‌تر یا برابر با :value باشد.',
        'string' => ':attribute باید حداقل :value کاراکتر یا بیشتر باشد.',
    ],
    'hex_color' => ':attribute باید یک رنگ معتبر هگزادسیمال باشد.',
    'image' => ':attribute باید یک تصویر باشد.',
    'in' => ':attribute انتخاب‌شده معتبر نیست.',
    'in_array' => ':attribute باید در :other موجود باشد.',
    'integer' => ':attribute باید یک عدد صحیح باشد.',
    'ip' => ':attribute باید یک آدرس IP معتبر باشد.',
    'ipv4' => ':attribute باید یک آدرس IPv4 معتبر باشد.',
    'ipv6' => ':attribute باید یک آدرس IPv6 معتبر باشد.',
    'json' => ':attribute باید یک رشته JSON معتبر باشد.',
    'lowercase' => ':attribute باید با حروف کوچک نوشته شود.',
    'lt' => [
        'array' => ':attribute باید کمتر از :value آیتم داشته باشد.',
        'file' => ':attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => ':attribute باید کمتر از :value باشد.',
        'string' => ':attribute باید کمتر از :value کاراکتر باشد.',
    ],
    'lte' => [
        'array' => ':attribute نباید بیشتر از :value آیتم داشته باشد.',
        'file' => ':attribute باید کمتر یا برابر با :value کیلوبایت باشد.',
        'numeric' => ':attribute باید کمتر یا برابر با :value باشد.',
        'string' => ':attribute باید کمتر یا برابر با :value کاراکتر باشد.',
    ],
    'mac_address' => ':attribute باید یک آدرس MAC معتبر باشد.',
    'max' => [
        'array' => ':attribute نباید بیشتر از :max آیتم داشته باشد.',
        'file' => ':attribute نباید بزرگ‌تر از :max کیلوبایت باشد.',
        'numeric' => ':attribute نباید بزرگ‌تر از :max باشد.',
        'string' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
    ],
    'max_digits' => ':attribute نباید بیشتر از :max رقم باشد.',
    'mimes' => ':attribute باید یک فایل از نوع: :values باشد.',
    'mimetypes' => ':attribute باید یک فایل از نوع: :values باشد.',
    'min' => [
        'array' => ':attribute باید حداقل :min آیتم داشته باشد.',
        'file' => ':attribute باید حداقل :min کیلوبایت باشد.',
        'numeric' => ':attribute باید حداقل :min باشد.',
        'string' => ':attribute باید حداقل :min کاراکتر باشد.',
    ],
    'min_digits' => ':attribute باید حداقل :min رقم داشته باشد.',
    'missing' => ':attribute باید وجود نداشته باشد.',
    'missing_if' => ':attribute باید وجود نداشته باشد وقتی :other برابر با :value باشد.',
    'missing_unless' => ':attribute باید وجود نداشته باشد مگر اینکه :other برابر با :value باشد.',
    'missing_with' => ':attribute باید وجود نداشته باشد وقتی :values موجود است.',
    'missing_with_all' => ':attribute باید وجود نداشته باشد وقتی :values موجود هستند.',
    'multiple_of' => ':attribute باید مضربی از :value باشد.',
    'not_in' => ':attribute انتخاب‌شده معتبر نیست.',
    'not_regex' => 'فرمت :attribute معتبر نیست.',
    'numeric' => ':attribute باید یک عدد باشد.',
    'password' => [
        'letters' => ':attribute باید حداقل شامل یک حرف باشد.',
        'mixed' => ':attribute باید حداقل شامل یک حرف بزرگ و یک حرف کوچک باشد.',
        'numbers' => ':attribute باید حداقل شامل یک عدد باشد.',
        'symbols' => ':attribute باید حداقل شامل یک نماد باشد.',
        'uncompromised' => ':attribute واردشده در یک افشای داده پیدا شده است. لطفاً :attribute دیگری انتخاب کنید.',
    ],
    'present' => ':attribute باید موجود باشد.',
    'present_if' => ':attribute باید موجود باشد وقتی :other برابر با :value است.',
    'present_unless' => ':attribute باید موجود باشد مگر اینکه :other برابر با :value باشد.',
    'present_with' => ':attribute باید موجود باشد وقتی :values موجود است.',
    'present_with_all' => ':attribute باید موجود باشد وقتی :values موجود هستند.',
    'prohibited' => ':attribute مجاز نیست.',
    'prohibited_if' => ':attribute مجاز نیست وقتی :other برابر با :value است.',
    'prohibited_unless' => ':attribute مجاز نیست مگر اینکه :other در :values باشد.',
    'prohibits' => ':attribute وجود :other را ممنوع می‌کند.',
    'regex' => 'فرمت :attribute درست نیست.',
    'required' => ':attribute الزامی است.',
    'required_array_keys' => ':attribute باید شامل مقادیر زیر باشد: :values.',
    'required_if' => ':attribute الزامی است وقتی :other برابر با :value باشد.',
    'required_if_accepted' => ':attribute الزامی است وقتی :other پذیرفته شده باشد.',
    'required_unless' => ':attribute الزامی است مگر اینکه :other در :values باشد.',
    'required_with' => ':attribute الزامی است وقتی :values موجود باشد.',
    'required_with_all' => ':attribute الزامی است وقتی :values موجود هستند.',
    'required_without' => ':attribute الزامی است وقتی :values موجود نباشد.',
    'required_without_all' => ':attribute الزامی است وقتی هیچ‌یک از :values موجود نباشند.',
    'same' => ':attribute باید با :other مطابقت داشته باشد.',
    'size' => [
        'array' => ':attribute باید  :size رقمی باشد.',
        'file' => ':attribute باید :size کیلوبایت باشد.',
        'numeric' => ':attribute باید برابر با :size باشد.',
        'string' => ':attribute باید :size کاراکتر باشد.',
    ],
    'starts_with' => ':attribute باید با یکی از مقادیر زیر شروع شود: :values.',
    'string' => ':attribute باید یک رشته باشد.',
    'timezone' => ':attribute باید یک منطقه زمانی معتبر باشد.',
    'unique' => ':attribute قبلاً ثبت شده است.',
    'uploaded' => ':attribute بارگذاری نشد.',
    'uppercase' => ':attribute باید با حروف بزرگ نوشته شود.',
    'url' => ':attribute باید یک URL معتبر باشد.',
    'ulid' => ':attribute باید یک ULID معتبر باشد.',
    'uuid' => ':attribute باید یک UUID معتبر باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'نام',
        'surname' => 'نام خانوادگی',
        'logo' => 'لوگو',
        'email' => 'ایمیل',
        'mobile' => 'موبایل',
        'password' => 'رمز عبور',
        'location' => 'آدرس',
        'coordinator' => 'نام هماهنگ کننده',
        'manufacturer' => 'تامین کننده',
        'coordinator_mobile' => 'موبایل هماهنگ کننده',
        'company_id' => 'نام شرکت',
        'company_unit' => 'نام بخش',
        'national_id' => 'شناسه ملی',
        'economic_code' => 'کد اقتصادی',
        'registration_number' => 'شماره ثبت',
        'office_phone' => 'شماره تماس',
        'zipcode' => 'کدپستی',
        'address' => 'آدرس',
        'state' => 'استان',
        'city_id' => 'شهر',
    ],

];
