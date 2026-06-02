<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: ui-sans-serif, system-ui, sans-serif; background: #f8fafc; margin: 0; padding: 32px 16px; }
        .card { background: #ffffff; border-radius: 12px; max-width: 560px; margin: 0 auto; padding: 40px; border: 1px solid #e2e8f0; }
        .logo { font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 32px; }
        .label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 4px; }
        .value { font-size: 15px; color: #1e293b; margin-bottom: 20px; }
        .message-box { background: #f1f5f9; border-radius: 8px; padding: 16px; font-size: 15px; color: #334155; line-height: 1.6; white-space: pre-wrap; }
        .divider { border: none; border-top: 1px solid #e2e8f0; margin: 28px 0; }
        .footer { font-size: 12px; color: #94a3b8; text-align: center; margin-top: 32px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">SkillNest</div>

        <div class="label">Nama</div>
        <div class="value">{{ $senderName }}</div>

        <div class="label">Email</div>
        <div class="value">{{ $senderEmail }}</div>

        <div class="label">Kategori</div>
        <div class="value">{{ $category }}</div>

        <hr class="divider">

        <div class="label">Pesan</div>
        <div class="message-box">{{ $userMessage }}</div>

        <div class="footer">
            Email ini dikirim otomatis melalui form Contact Us di SkillNest.
            Balas langsung ke email pengirim di atas.
        </div>
    </div>
</body>
</html>
