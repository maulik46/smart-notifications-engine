<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $notification->title }}</title>
</head>

<body style="margin:0;padding:30px;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;border:1px solid #e5e7eb;">

                    <!-- Header -->
                    <tr>
                        <td
                            style="background:#2563eb;padding:24px;text-align:center;color:#ffffff;font-size:24px;font-weight:bold;">
                            Smart Notification
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px;">

                            <h2 style="margin:0 0 20px;color:#111827;font-size:24px;">
                                {{ $notification->title }}
                            </h2>

                            <p style="margin:0;color:#4b5563;font-size:16px;line-height:1.8;">
                                {!! nl2br(e($notification->message)) !!}
                            </p>

                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding:0 35px;">
                            <hr style="border:none;border-top:1px solid #e5e7eb;">
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding:20px 35px;text-align:center;color:#6b7280;font-size:13px;line-height:1.6;">

                            This is an automated email from
                            <strong>Smart Notification Engine</strong>.

                            <br><br>

                            Please do not reply to this email.

                        </td>
                    </tr>

                </table>

                <p style="margin-top:20px;color:#9ca3af;font-size:12px;">
                    © {{ now()->year }} Smart Notification Engine
                </p>

            </td>
        </tr>
    </table>

</body>

</html>
