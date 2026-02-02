<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Handwerker') }} API</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|jetbrains-mono:400,500" rel="stylesheet" />

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            :root {
                --bg-primary: #0a0e27;
                --bg-secondary: #141937;
                --bg-card: #1a2040;
                --accent-primary: #00d4ff;
                --accent-secondary: #0095ff;
                --accent-tertiary: #7b61ff;
                --text-primary: #ffffff;
                --text-secondary: #a0aec0;
                --text-muted: #64748b;
                --success: #10b981;
                --warning: #f59e0b;
                --border: rgba(0, 212, 255, 0.1);
                --glow: rgba(0, 212, 255, 0.2);
            }

            body {
                font-family: 'Space Grotesk', sans-serif;
                background: var(--bg-primary);
                color: var(--text-primary);
                line-height: 1.6;
                overflow-x: hidden;
                position: relative;
            }

            /* Animated Background */
            .bg-grid {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: 
                    linear-gradient(var(--border) 1px, transparent 1px),
                    linear-gradient(90deg, var(--border) 1px, transparent 1px);
                background-size: 50px 50px;
                opacity: 0.3;
                animation: gridMove 20s linear infinite;
                z-index: 0;
            }

            @keyframes gridMove {
                0% { transform: translate(0, 0); }
                100% { transform: translate(50px, 50px); }
            }

            .bg-gradient {
                position: fixed;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle at 50% 50%, rgba(0, 212, 255, 0.08) 0%, transparent 50%),
                            radial-gradient(circle at 80% 20%, rgba(123, 97, 255, 0.08) 0%, transparent 50%);
                animation: gradientMove 15s ease-in-out infinite alternate;
                z-index: 0;
            }

            @keyframes gradientMove {
                0% { transform: translate(0, 0) rotate(0deg); }
                100% { transform: translate(5%, 5%) rotate(5deg); }
            }

            .container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 2rem;
                position: relative;
                z-index: 1;
            }

            /* Header */
            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 2rem 0;
                border-bottom: 1px solid var(--border);
                animation: slideDown 0.6s ease-out;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .logo-icon {
                width: 48px;
                height: 48px;
                background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 1.5rem;
                box-shadow: 0 0 30px var(--glow);
                animation: pulse 2s ease-in-out infinite;
            }

            @keyframes pulse {
                0%, 100% { box-shadow: 0 0 30px var(--glow); }
                50% { box-shadow: 0 0 50px var(--glow), 0 0 70px var(--glow); }
            }

            .logo-text {
                display: flex;
                flex-direction: column;
            }

            .logo-title {
                font-size: 1.5rem;
                font-weight: 700;
                background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .logo-subtitle {
                font-size: 0.75rem;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 2px;
                font-weight: 500;
            }

            .status-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 1rem;
                background: rgba(16, 185, 129, 0.1);
                border: 1px solid rgba(16, 185, 129, 0.3);
                border-radius: 50px;
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--success);
            }

            .status-dot {
                width: 8px;
                height: 8px;
                background: var(--success);
                border-radius: 50%;
                animation: blink 2s ease-in-out infinite;
            }

            @keyframes blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.3; }
            }

            /* Hero Section */
            .hero {
                padding: 4rem 0;
                text-align: center;
                animation: fadeInUp 0.8s ease-out 0.2s both;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .hero h1 {
                font-size: 4rem;
                font-weight: 700;
                line-height: 1.2;
                margin-bottom: 1rem;
                background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero .version {
                display: inline-block;
                font-size: 1rem;
                color: var(--accent-primary);
                font-family: 'JetBrains Mono', monospace;
                padding: 0.25rem 0.75rem;
                background: rgba(0, 212, 255, 0.1);
                border: 1px solid var(--accent-primary);
                border-radius: 50px;
                margin-bottom: 1.5rem;
            }

            .hero p {
                font-size: 1.25rem;
                color: var(--text-secondary);
                max-width: 600px;
                margin: 0 auto 2rem;
            }

            .cta-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
            }

            .btn {
                padding: 1rem 2rem;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1rem;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                position: relative;
                overflow: hidden;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
                color: var(--bg-primary);
                border: none;
                box-shadow: 0 10px 40px rgba(0, 212, 255, 0.3);
            }

            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.5s;
            }

            .btn-primary:hover::before {
                left: 100%;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 50px rgba(0, 212, 255, 0.4);
            }

            .btn-secondary {
                background: var(--bg-card);
                color: var(--text-primary);
                border: 1px solid var(--border);
            }

            .btn-secondary:hover {
                background: var(--bg-secondary);
                border-color: var(--accent-primary);
                transform: translateY(-2px);
            }

            /* Features Grid */
            .features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 2rem;
                padding: 4rem 0;
                animation: fadeInUp 0.8s ease-out 0.4s both;
            }

            .feature-card {
                background: var(--bg-card);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 2rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .feature-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 2px;
                background: linear-gradient(90deg, var(--accent-primary), var(--accent-tertiary));
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }

            .feature-card:hover::before {
                transform: scaleX(1);
            }

            .feature-card:hover {
                transform: translateY(-5px);
                border-color: var(--accent-primary);
                box-shadow: 0 20px 60px rgba(0, 212, 255, 0.2);
            }

            .feature-icon {
                width: 56px;
                height: 56px;
                background: linear-gradient(135deg, rgba(0, 212, 255, 0.2), rgba(0, 149, 255, 0.2));
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
                border: 1px solid var(--accent-primary);
            }

            .feature-card h3 {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
                color: var(--text-primary);
            }

            .feature-card p {
                color: var(--text-secondary);
                font-size: 0.95rem;
            }

            /* API Info Section */
            .api-info {
                background: var(--bg-secondary);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 3rem;
                margin: 4rem 0;
                animation: fadeInUp 0.8s ease-out 0.6s both;
            }

            .api-info h2 {
                font-size: 2rem;
                margin-bottom: 2rem;
                text-align: center;
                background: linear-gradient(135deg, var(--accent-primary), var(--accent-tertiary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .endpoint-example {
                background: var(--bg-primary);
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 1.5rem;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.9rem;
                overflow-x: auto;
                position: relative;
            }

            .endpoint-example pre {
                margin: 0;
                color: var(--accent-primary);
            }

            .endpoint-label {
                color: var(--text-muted);
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 0.5rem;
                display: block;
            }

            .method-badge {
                display: inline-block;
                padding: 0.25rem 0.75rem;
                border-radius: 4px;
                font-size: 0.75rem;
                font-weight: 600;
                margin-right: 0.5rem;
            }

            .method-get {
                background: rgba(16, 185, 129, 0.2);
                color: var(--success);
                border: 1px solid var(--success);
            }

            .method-post {
                background: rgba(0, 212, 255, 0.2);
                color: var(--accent-primary);
                border: 1px solid var(--accent-primary);
            }

            /* Stats */
            .stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 2rem;
                padding: 4rem 0;
                animation: fadeInUp 0.8s ease-out 0.8s both;
            }

            .stat-card {
                text-align: center;
                padding: 2rem;
                background: var(--bg-card);
                border: 1px solid var(--border);
                border-radius: 16px;
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: scale(1.05);
                border-color: var(--accent-primary);
            }

            .stat-value {
                font-size: 3rem;
                font-weight: 700;
                background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                display: block;
                margin-bottom: 0.5rem;
            }

            .stat-label {
                color: var(--text-secondary);
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            /* Footer */
            footer {
                border-top: 1px solid var(--border);
                padding: 3rem 0;
                text-align: center;
                color: var(--text-muted);
                animation: fadeInUp 0.8s ease-out 1s both;
            }

            footer p {
                margin-bottom: 1rem;
            }

            footer a {
                color: var(--accent-primary);
                text-decoration: none;
                transition: color 0.3s ease;
            }

            footer a:hover {
                color: var(--accent-secondary);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .hero h1 {
                    font-size: 2.5rem;
                }

                .hero p {
                    font-size: 1rem;
                }

                .cta-buttons {
                    flex-direction: column;
                }

                .features {
                    grid-template-columns: 1fr;
                }

                .api-info {
                    padding: 2rem 1.5rem;
                }

                header {
                    flex-direction: column;
                    gap: 1rem;
                }
            }

            /* Code syntax highlighting */
            .endpoint-example .keyword { color: #ff79c6; }
            .endpoint-example .string { color: #50fa7b; }
            .endpoint-example .number { color: #bd93f9; }
        </style>
    </head>
    <body>
        <div class="bg-grid"></div>
        <div class="bg-gradient"></div>

        <div class="container">
            <header>
                <div class="logo">
                    <div class="logo-icon">H</div>
                    <div class="logo-text">
                        <div class="logo-title">Handwerker</div>
                        <div class="logo-subtitle">REST API</div>
                    </div>
                </div>
                <div class="status-badge">
                    <span class="status-dot"></span>
                    API Aktif
                </div>
            </header>

            <section class="hero">
                <span class="version">v1.0</span>
                <h1>Handwerker API'ye<br>Hoş Geldiniz</h1>
                <p>
                    Modern, güvenli ve yüksek performanslı RESTful API. 
                    Mobil uygulama entegrasyonu için optimize edilmiştir.
                </p>
                <div class="cta-buttons">
                    <a href="{{ url('/api/documentation') }}" class="btn btn-primary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        API Dokümantasyonu
                    </a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                Giriş Yap
                            </a>
                        @endauth
                    @endif
                </div>
            </section>

            <section class="features">
                <div class="feature-card">
                    <div class="feature-icon">🚀</div>
                    <h3>Yüksek Performans</h3>
                    <p>Optimize edilmiş veritabanı sorguları ve caching mekanizması ile hızlı yanıt süreleri.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Güvenli Kimlik Doğrulama</h3>
                    <p>JWT token tabanlı güvenli kimlik doğrulama ve yetkilendirme sistemi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Mobil Uyumlu</h3>
                    <p>iOS ve Android platformları için optimize edilmiş API endpointleri.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Gerçek Zamanlı Veri</h3>
                    <p>WebSocket desteği ile anlık bildirimler ve veri güncellemeleri.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔄</div>
                    <h3>RESTful Standartlar</h3>
                    <p>Endüstri standartlarına uygun RESTful API mimarisi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📖</div>
                    <h3>Kapsamlı Dokümantasyon</h3>
                    <p>Detaylı API dokümantasyonu, örnekler ve entegrasyon kılavuzları.</p>
                </div>
            </section>

            <section class="api-info">
                <h2>API Endpoint Örneği</h2>
                <div style="max-width: 800px; margin: 0 auto;">
                    <div class="endpoint-example" style="margin-bottom: 1.5rem;">
                        <span class="endpoint-label">Base URL</span>
                        <pre>{{ url('/api/v1') }}</pre>
                    </div>
                    <div class="endpoint-example">
                        <span class="endpoint-label">Örnek İstek</span>
                        <pre><span class="method-badge method-get">GET</span>/api/v1/users

<span class="keyword">Headers:</span>
{
  "<span class="string">Authorization</span>": "<span class="string">Bearer {token}</span>",
  "<span class="string">Accept</span>": "<span class="string">application/json</span>"
}

<span class="keyword">Response:</span> <span class="number">200</span> OK
{
  "<span class="string">status</span>": "<span class="string">success</span>",
  "<span class="string">data</span>": {
    "<span class="string">users</span>": [...]
  }
}</pre>
                    </div>
                </div>
            </section>

            <section class="stats">
                <div class="stat-card">
                    <span class="stat-value">99.9%</span>
                    <span class="stat-label">Uptime</span>
                </div>
                <div class="stat-card">
                    <span class="stat-value">&lt;100ms</span>
                    <span class="stat-label">Avg Response</span>
                </div>
                <div class="stat-card">
                    <span class="stat-value">REST</span>
                    <span class="stat-label">Architecture</span>
                </div>
                <div class="stat-card">
                    <span class="stat-value">24/7</span>
                    <span class="stat-label">Availability</span>
                </div>
            </section>

            <footer>
                <p>&copy; {{ date('Y') }} Handwerker. Tüm hakları saklıdır.</p>
                <p>
                    <a href="{{ url('/api/documentation') }}">Dokümantasyon</a> • 
                    <a href="{{ url('/privacy') }}">Gizlilik Politikası</a> • 
                    <a href="{{ url('/terms') }}">Kullanım Koşulları</a>
                </p>
            </footer>
        </div>
    </body>
</html>