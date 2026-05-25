<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate of Completion</title>
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; text-align: center; color: #1e293b; background: #f8fafc; margin: 0; padding: 40px; }
        .certificate-container { 
            border: 20px solid #1e293b; 
            padding: 80px; 
            background: white;
            position: relative;
            box-shadow: 0 0 50px rgba(0,0,0,0.1);
        }
        .gold-seal {
            position: absolute;
            top: 40px;
            right: 40px;
            width: 100px;
            height: 100px;
            background: #eab308;
            border-radius: 50%;
            border: 5px double white;
            display: flex;
            items-center: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .header { font-size: 60px; font-weight: 900; color: #1e293b; margin-bottom: 10px; letter-spacing: 5px; }
        .sub-header { font-size: 20px; font-weight: bold; color: #64748b; margin-bottom: 60px; letter-spacing: 10px; text-transform: uppercase; }
        
        .label { font-size: 16px; color: #64748b; margin-bottom: 10px; font-style: italic; }
        .student-name { font-size: 48px; font-weight: 900; color: #2563eb; margin-bottom: 40px; border-bottom: 3px solid #e2e8f0; display: inline-block; padding: 0 60px; }
        
        .course-info { margin-bottom: 60px; }
        .course-title { font-size: 32px; font-weight: bold; color: #1e293b; margin-bottom: 10px; }
        
        .assessment-badge {
            display: inline-block;
            background: #f1f5f9;
            padding: 15px 30px;
            border-radius: 50px;
            margin: 20px 0;
            border: 1px solid #e2e8f0;
        }
        .score-label { font-size: 12px; font-weight: black; color: #64748b; text-transform: uppercase; letter-spacing: 2px; }
        .score-value { font-size: 24px; font-weight: 900; color: #059669; }

        .signature-area { margin-top: 80px; display: table; width: 100%; }
        .signature-box { display: table-cell; width: 50%; text-align: center; vertical-align: bottom; }
        .signature-line { border-top: 2px solid #1e293b; width: 200px; margin: 0 auto 10px auto; }
        .signature-name { font-weight: bold; font-size: 18px; color: #1e293b; }
        .signature-title { font-size: 12px; color: #64748b; text-transform: uppercase; }

        .footer { margin-top: 60px; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="gold-seal">OFFICIAL GRADUATE</div>
        
        <div class="header">CERTIFICATE</div>
        <div class="sub-header">OF ACHIEVEMENT</div>
        
        <div class="label">This prestigious award is presented to</div>
        <div class="student-name">{{ $user->name }}</div>
        
        <div class="course-info">
            <div class="label">for the successful completion of</div>
            <div class="course-title">{{ $course->title }}</div>
        </div>

        <div class="assessment-badge">
            <div class="score-label">Final Assessment Score</div>
            <div class="score-value">{{ number_format($score, 1) }}%</div>
        </div>

        <div class="signature-area">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-name">{{ $course->instructor->name }}</div>
                <div class="signature-title">Lead Instructor</div>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-name">{{ $certificate->issued_at->format('F d, Y') }}</div>
                <div class="signature-title">Date of Completion</div>
            </div>
        </div>

        <div class="footer">
            Verification ID: {{ $certificate->uuid }} • Issued by {{ config('app.name') }} Global Academy
        </div>
    </div>
</body>
</html>
