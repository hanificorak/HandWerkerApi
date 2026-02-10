<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-posta Doğrulama</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f7fa;
            padding: 20px;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .header {
            background-color: #5a67d8;
            padding: 40px 30px;
            text-align: center;
        }
        
        .logo {
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
        }
        
        .header-subtitle {
            color: #ffffff !important;
            font-size: 14px;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 24px;
            font-weight: 600;
            color: #1a202c !important;
            margin-bottom: 20px;
        }
        
        .message {
            color: #4a5568 !important;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        
        .code-container {
            background-color: #5a67d8;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
            box-shadow: 0 4px 15px rgba(90, 103, 216, 0.3);
        }
        
        .code-label {
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        
        .verification-code {
            font-size: 48px;
            font-weight: 700;
            color: #ffffff !important;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            margin: 10px 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .code-validity {
            color: #ffffff !important;
            font-size: 13px;
            margin-top: 15px;
        }
        
        .info-box {
            background-color: #f7fafc;
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        
        .info-box p {
            color: #4a5568;
            font-size: 14px;
            margin: 0;
        }
        
        .security-notice {
            background-color: #fff5f5;
            border-left: 4px solid #fc8181;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        
        .security-notice p {
            color: #742a2a;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }
        
        .footer {
            background-color: #f7fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-text {
            color: #718096;
            font-size: 13px;
            margin-bottom: 15px;
        }
        
        .footer-links {
            margin: 20px 0;
        }
        
        .footer-link {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
            font-size: 13px;
        }
        
        .footer-link:hover {
            text-decoration: underline;
        }
        
        .company-info {
            color: #a0aec0;
            font-size: 12px;
            margin-top: 15px;
        }
        
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .header {
                padding: 30px 20px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .verification-code {
                font-size: 36px;
                letter-spacing: 6px;
            }
            
            .greeting {
                font-size: 20px;
            }
            
            .message {
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header" style="background-color: #5a67d8;">
            <div class="logo" style="color: #ffffff;">🛠️ Handwerker</div>
            <div class="header-subtitle" style="color: #ffffff;">Profesyonel Hizmet Platformu</div>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="greeting" style="color: #1a202c;">
                {{ $name ? 'Merhaba ' . $name . '!' : 'Merhaba!' }}
            </div>
            
            <p class="message" style="color: #4a5568;">
                Handwerker'a hoş geldiniz! E-posta adresinizi doğrulamak için aşağıdaki doğrulama kodunu kullanabilirsiniz.
            </p>
            
            <!-- Verification Code Box -->
            <div class="code-container" style="background-color: #5a67d8;">
                <div class="code-label" style="color: #ffffff;">Doğrulama Kodunuz</div>
                <div class="verification-code" style="color: #ffffff;">{{ $code }}</div>
                <div class="code-validity" style="color: #ffffff;">⏱️ Bu kod 10 dakika geçerlidir</div>
            </div>
            
            <!-- Information Box -->
            <div class="info-box">
                <p style="color: #4a5568;"><strong>💡 Nasıl kullanılır?</strong></p>
                <p style="color: #4a5568;">Mobil uygulamamızda doğrulama ekranına gidin ve yukarıdaki 6 haneli kodu girin.</p>
            </div>
            
            <!-- Security Notice -->
            <div class="security-notice">
                <p style="color: #742a2a;"><strong>🔒 Güvenlik Uyarısı:</strong> Bu kodu hiç kimseyle paylaşmayın. Handwerker ekibi asla bu kodu sizden talep etmez. Eğer bu işlemi siz başlatmadıysanız, lütfen bu e-postayı dikkate almayın ve hesabınızın güvenliğini kontrol edin.</p>
            </div>
            
            <p class="message" style="margin-top: 30px; color: #4a5568;">
                Herhangi bir sorunuz varsa, destek ekibimiz size yardımcı olmaktan mutluluk duyacaktır.
            </p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">
                Bu e-posta Handwerker tarafından gönderilmiştir.
            </p>
            
            <div class="footer-links">
                <a href="#" class="footer-link">Destek Merkezi</a>
                <a href="#" class="footer-link">Gizlilik Politikası</a>
                <a href="#" class="footer-link">Kullanım Şartları</a>
            </div>
            
            <p class="company-info">
                © {{ date('Y') }} Handwerker. Tüm hakları saklıdır.
            </p>
        </div>
    </div>
</body>
</html>