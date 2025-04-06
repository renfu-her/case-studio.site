<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: '微軟正黑體', 'Microsoft JhengHei', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #EA580C;
        }
        .content {
            margin-bottom: 30px;
        }
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .value {
            margin-top: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #EA580C; margin: 0;">新的聯絡表單提交</h1>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">姓名：</div>
                <div class="value">{{ $contact->name }}</div>
            </div>
            
            <div class="field">
                <div class="label">電子郵件：</div>
                <div class="value">{{ $contact->email }}</div>
            </div>
            
            @if($contact->phone)
            <div class="field">
                <div class="label">聯絡電話：</div>
                <div class="value">{{ $contact->phone }}</div>
            </div>
            @endif
            
            <div class="field">
                <div class="label">訊息內容：</div>
                <div class="value">{{ $contact->message }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>此郵件由系統自動發送，請勿直接回覆。</p>
            <p>提交時間：{{ $contact->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</body>
</html> 