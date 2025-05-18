<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>کد ورود به پنل</title>
</head>
<body style="font-family: Arial, sans-serif; direction: rtl; background-color: #f7f7f7; padding: 20px;">

<table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border: 1px solid #ddd;">
    <tr>
        <td style="padding: 20px; text-align: center;">
            <img src="{{asset('assets/img/logo.jpg')}}" alt="لوگو" width="200" style="margin-bottom: 20px;">
        </td>
    </tr>
    <tr>
        <td style="padding: 20px; text-align: center;">
            <h3 style="margin: 20px 0;">برای ورود لطفا کد زیر را وارد کنید:</h3>

            <div style="display: inline-block; background-color: #eeeeee; padding: 10px 20px; font-size: 20px; font-weight: bold; border-radius: 5px; color: #333;">
                {{$data['code']}}
            </div>

            <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">

            <p style="margin-bottom: 15px;">اگر درخواستی برای ورود به پنل کاربری خود ارسال نکرده‌اید، لطفاً این ایمیل را نادیده گرفته و موضوع را به پشتیبانی گزارش دهید.</p>

            <p style="margin: 0;">با تشکر،</p>
            <p style="margin: 0;">شرکت سرزمین ایمن آسیا کیش</p>
        </td>
    </tr>
</table>

</body>
</html>
