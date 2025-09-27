<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8b739;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .detail {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
    </div>
    
    <div class="content">
        <div class="detail">
            <span class="label">Name:</span> {{ $contact->name }}
        </div>
        
        <div class="detail">
            <span class="label">Email:</span> {{ $contact->email }}
        </div>
        
        <div class="detail">
            <span class="label">Subject:</span> {{ $contact->subject }}
        </div>
        
        <div class="detail">
            <span class="label">Message:</span>
            <p>{{ $contact->message }}</p>
        </div>
        
        <div class="detail">
            <span class="label">Submitted:</span> {{ $contact->created_at->format('F j, Y \a\t g:i a') }}
        </div>
        
        <div class="detail">
            <span class="label">IP Address:</span> {{ $contact->ip_address }}
        </div>
    </div>
    
    <div class="footer">
        <p>This email was sent automatically from the contact form on your website.</p>
    </div>
</body>
</html>