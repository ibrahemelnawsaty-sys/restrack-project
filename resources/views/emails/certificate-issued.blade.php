@php($locale = $certificate->user->locale ?? 'ar')
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restrack Certificate</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f7; font-family:'Segoe UI', Tahoma, Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f7; padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(22,38,75,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#16264b; padding:32px 32px 28px; text-align:center;">
                            <div style="font-size:26px; font-weight:700; color:#af9136; letter-spacing:1px;">RESTRACK</div>
                            <div style="font-size:13px; color:#d8d8e0; margin-top:6px;">مؤسسة ريستراك للتدريب &middot; Research Track Platform</div>
                        </td>
                    </tr>

                    <!-- Gold divider -->
                    <tr>
                        <td style="height:4px; background-color:#af9136; line-height:4px; font-size:0;">&nbsp;</td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:36px 40px 8px; text-align:center;" dir="rtl">
                            <h1 style="margin:0 0 12px; font-size:22px; color:#16264b;">تهانينا، {{ $studentName }}!</h1>
                            <p style="margin:0 0 8px; font-size:15px; line-height:1.7; color:#444;">
                                لقد حصلت على <strong style="color:#af9136;">شهادة إكمال</strong> من منصة ريستراك.
                            </p>
                            <p style="margin:0 0 16px; font-size:14px; line-height:1.7; color:#555;">
                                رقم الشهادة: <strong style="color:#16264b;">{{ $certificate->certificate_number }}</strong><br>
                                نسخة PDF من شهادتك مرفقة بهذه الرسالة.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:8px 40px 28px; text-align:center;" dir="ltr">
                            <h1 style="margin:0 0 12px; font-size:22px; color:#16264b;">Congratulations, {{ $studentName }}!</h1>
                            <p style="margin:0 0 8px; font-size:15px; line-height:1.7; color:#444;">
                                You have earned a <strong style="color:#af9136;">Certificate of Completion</strong> from Restrack.
                            </p>
                            <p style="margin:0 0 16px; font-size:14px; line-height:1.7; color:#555;">
                                Certificate No.: <strong style="color:#16264b;">{{ $certificate->certificate_number }}</strong><br>
                                A PDF copy of your certificate is attached to this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Verify button -->
                    <tr>
                        <td style="padding:0 40px 40px; text-align:center;">
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="background-color:#af9136; border-radius:8px;">
                                        <a href="{{ route('certificate.verify', $certificate->certificate_number) }}"
                                           style="display:inline-block; padding:14px 32px; font-size:15px; font-weight:700; color:#16264b; text-decoration:none;">
                                            تحقّق من الشهادة &middot; Verify certificate
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#16264b; padding:22px 32px; text-align:center;">
                            <p style="margin:0; font-size:12px; color:#c8c8d4; line-height:1.6;">
                                مؤسسة ريستراك للتدريب &middot; الرقم الموحّد 7053567603<br>
                                &copy; {{ date('Y') }} Restrack. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
