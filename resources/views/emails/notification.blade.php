<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $notification->title }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f7fb;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
            padding: 30px 15px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }

        .header {
            background: linear-gradient(135deg,#2563eb,#4f46e5);
            color: white;
            text-align: center;
            padding: 30px;
        }

        .header h1 {
            font-size: 28px;
        }

        .content {
            padding: 40px;
        }

        .content h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #111827;
        }

        .content p {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.8;
            white-space: pre-line;
        }

        .footer {
            border-top: 1px solid #e5e7eb;
            padding: 25px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        @media (max-width: 640px) {

            body {
                padding: 10px;
            }

            .content {
                padding: 24px;
            }

            .header {
                padding: 24px;
            }

            .header h1 {
                font-size: 22px;
            }

            .content h2 {
                font-size: 22px;
            }

            .content p {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>📨 Smart Notification Engine</h1>
    </div>

    <div class="content">

        <h2>{{ $notification->title }}</h2>

        <p>{!! nl2br(e($notification->message)) !!}</p>

    </div>

    <div class="footer">
        This is an automated email from <strong>Smart Notification Engine</strong>.<br>
        Please do not reply to this email.
    </div>

</div>

</body>

</html>
