<!DOCTYPE html>
<html>

<head>
    <title>Your OTP Code - Ligaurd</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #dfe3e8;
        }

        .header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 2px solid #2d5fb8;
        }

        .header img {
            width: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            color: #2d5fb8;
            margin: 0;
            font-weight: bold;
        }

        .content {
            padding: 20px 0;
            text-align: center;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        .otp-code {
            font-size: 28px;
            color: #2d5fb8;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #f4f7fa;
            display: inline-block;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #dfe3e8;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #2d5fb8;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co/YDD8Dfq/Li-GAURD-3.png" alt="Ligaurd Logo">
            <h1>Ligaurd</h1>
            <p>A secure meeting with a watchful eye</p>
        </div>

        <div class="content">
            <p>Dear {{ $name }},</p>
            <p>Your OTP code for {{ $purpose }} is:</p>
            <p class="otp-code">{{ $otp }}</p>
            <p>This code will expire in 5 minutes. Please do not share it with anyone.</p>
        </div>

        <div class="footer">
            <p>If you didn’t request this code, please <a href="https://example.com/support">contact support</a>.</p>
            <p>&copy; {{ date('Y') }} Ligaurd. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
