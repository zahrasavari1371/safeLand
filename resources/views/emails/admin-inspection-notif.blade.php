<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>درخواست بازرسی جدید</title>
</head>
<body style="font-family: Arial, sans-serif; direction: rtl; background-color: #f7f7f7; padding: 20px;">

<table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border: 1px solid #ddd;">
    <tr>
        <td style="padding: 20px; text-align: center;">
            <img src="{{asset('assets/img/logo.jpg')}}" alt="لوگو" width="200" style="margin-bottom: 20px;">
        </td>
    </tr>
    <tr>
        <td style="padding: 20px;">
            <p style="margin: 0 0 20px;">با سلام،</p>
            <p style="margin: 0 0 20px;">
                درخواست بازرسی جدیدی از شرکت
                <strong>{{$data['company']}}</strong>
                بخش
                <strong>{{$data['unit']}}</strong>
                ارسال شده است. لطفاً بررسی کنید.
            </p>
            <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
            <p style="margin: 0 0 5px;">با تشکر،</p>
            <p style="margin: 0;">شرکت سرزمین ایمن آسیا کیش</p>
        </td>
    </tr>
</table>

</body>
</html>
