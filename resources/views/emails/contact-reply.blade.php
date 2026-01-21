<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to your contact message - Furni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #6c757d;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #6c757d;
            margin: 0;
            font-size: 28px;
        }
        .content {
            margin-bottom: 30px;
        }
        .original-message {
            background-color: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #6c757d;
            margin-bottom: 20px;
        }
        .original-message h3 {
            margin-top: 0;
            color: #6c757d;
        }
        .reply {
            background-color: #e9ecef;
            padding: 20px;
            border-left: 4px solid #28a745;
        }
        .reply h3 {
            margin-top: 0;
            color: #28a745;
        }
        .footer {
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 30px;
            color: #6c757d;
        }
        .signature {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Furni</h1>
            <p>Modern Interior Design Studio</p>
        </div>

        <div class="content">
            <h2>Reply to Your Contact Message</h2>
            <p>Dear {{ $contactMessage->full_name }},</p>
            <p>Thank you for reaching out to us. We have received your message and our team has reviewed it. Please find our response below.</p>

            <div class="original-message">
                <h3>Your Original Message:</h3>
                <p><strong>Date:</strong> {{ $contactMessage->created_at->format('F j, Y, g:i a') }}</p>
                <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
                @if($contactMessage->subject)
                    <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
                @endif
                <p><strong>Message:</strong></p>
                <p>{{ $contactMessage->message }}</p>
            </div>

            <div class="reply">
                <h3>Our Response:</h3>
                <p>{{ $reply }}</p>
            </div>

            <p>If you have any further questions or need additional assistance, please don't hesitate to contact us again.</p>

            <p>Best regards,<br>
            The Furni Team</p>
        </div>

        <div class="footer">
            <p class="signature">Furni - Modern Interior Design Studio</p>
            <p>Visit our website: <a href="{{ url('/') }}">{{ url('/') }}</a></p>
            <p>&copy; {{ date('Y') }} Furni. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
