<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งเตือนข้อความติดต่อใหม่จากเว็บไซต์ GIS GROUP</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif, 'Prompt', sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 20px 10px;
            color: #334155;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: linear-gradient(135deg, #1a365d 0%, #0f172a 100%);
            padding: 25px 30px;
            text-align: center;
            border-bottom: 4px solid #f69420;
        }
        .email-header img {
            max-height: 48px;
            margin-bottom: 10px;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 20px;
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .email-body {
            padding: 30px;
        }
        .badge-alert {
            display: inline-block;
            background-color: #fff7ed;
            color: #ea580c;
            border: 1px solid #ffedd5;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .info-table th {
            width: 32%;
            text-align: left;
            padding: 12px 14px;
            background-color: #f8fafc;
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .info-table td {
            padding: 12px 14px;
            color: #1e293b;
            font-size: 14.5px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .message-box {
            background-color: #f8fafc;
            border-left: 4px solid #f69420;
            padding: 16px 20px;
            border-radius: 0 8px 8px 0;
            font-size: 14.5px;
            line-height: 1.6;
            color: #334155;
            white-space: pre-line;
            margin-top: 5px;
        }
        .btn-reply {
            display: inline-block;
            background-color: #f69420;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14.5px;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(246, 148, 32, 0.35);
        }
        .email-footer {
            background-color: #f8fafc;
            padding: 20px 30px;
            text-align: center;
            font-size: 12.5px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <img src="http://127.0.0.1:8000/assets/frontend/img/logo.png" alt="GIS GROUP Logo">
            <h1>📩 มีข้อความติดต่อใหม่จากเว็บไซต์</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="badge-alert">
                🔔 การแจ้งเตือน: แบบฟอร์มติดต่อเรา (Contact Us)
            </div>

            <table class="info-table">
                <tr>
                    <th>👤 ชื่อผู้ติดต่อ</th>
                    <td><strong>{{ $contactData['full_name'] ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <th>📧 อีเมล</th>
                    <td>
                        <a href="mailto:{{ $contactData['email'] ?? '' }}" style="color: #2563eb; text-decoration: none;">
                            {{ $contactData['email'] ?? '-' }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>📞 เบอร์โทรศัพท์</th>
                    <td>
                        <a href="tel:{{ $contactData['telephone'] ?? '' }}" style="color: #1e293b; text-decoration: none;">
                            {{ $contactData['telephone'] ?? '-' }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>📌 หัวข้อติดต่อ</th>
                    <td><strong style="color: #0f172a;">{{ $contactData['topic'] ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <th>📅 วันที่ส่งข้อมูล</th>
                    <td>{{ $contactData['created_at'] ?? date('d/m/Y H:i น.') }}</td>
                </tr>
                <tr>
                    <th>📝 ข้อความรายละเอียด</th>
                    <td>
                        <div class="message-box">
                            {{ $contactData['details'] ?? '-' }}
                        </div>
                    </td>
                </tr>
            </table>

            <div style="text-align: center; margin-top: 25px;">
                <a href="mailto:{{ $contactData['email'] ?? '' }}?subject=Re: {{ $contactData['topic'] ?? 'ติดต่อจาก GIS GROUP' }}" class="btn-reply">
                    ตอบกลับอีเมลผู้ติดต่อทันที
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="margin: 0 0 5px 0;">อีเมลนี้เป็นการแจ้งเตือนอัตโนมัติจากระบบเว็บไซต์ <strong>GIS GROUP CO., LTD.</strong></p>
            <p style="margin: 0;">© {{ date('Y') }} GIS Group. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
