<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Welcome Back</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0 30px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 600;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            font-size: 15px;
        }

        .user-role {
            font-size: 12px;
            opacity: 0.9;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #667eea;
            font-size: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        /* Welcome Section */
        .welcome-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideDown 0.5s ease-out;
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

        .welcome-content h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .welcome-text {
            color: #666;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .success-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #d4edda;
            color: #155724;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
        }

        .logout-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            animation: fadeIn 0.6s ease-out;
            animation-fill-mode: both;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #4facfe15 0%, #00f2fe15 100%);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #43e97b15 0%, #38f9d715 100%);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #fa709a15 0%, #fee14015 100%);
        }

        .stat-title {
            color: #888;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 13px;
            color: #27ae60;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            animation: fadeIn 0.7s ease-out;
        }

        .section-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            border-color: #667eea;
            background: #667eea05;
            transform: translateX(5px);
        }

        .action-btn-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Recent Activity */
        .recent-activity {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.8s ease-out;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.3s ease;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background: #f8f9fa;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            color: #333;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .activity-time {
            color: #999;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 0 15px;
            }

            .navbar-brand {
                font-size: 18px;
            }

            .user-info {
                display: none;
            }

            .container {
                padding: 15px;
            }

            .welcome-section {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .welcome-content h2 {
                font-size: 22px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Mobile Menu Toggle */
        .mobile-menu-btn {
            display: none;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <div class="logo-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
            </div>
            <span>Dashboard</span>
        </div>
        <div class="navbar-user">
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-content">
                <h2>Selamat Datang Kembali, {{ auth()->user()->name }}! 👋</h2>
                <p class="welcome-text">Senang melihat Anda lagi. Berikut ringkasan aktivitas Anda hari ini.</p>
                <div class="success-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Login berhasil!
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="display: inline; vertical-align: middle; margin-right: 5px;">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon purple">📊</div>
                </div>
                <div class="stat-title">Total Proyek</div>
                <div class="stat-value">24</div>
                <div class="stat-change">↑ 12% dari bulan lalu</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon blue">👥</div>
                </div>
                <div class="stat-title">Pengguna Aktif</div>
                <div class="stat-value">1,248</div>
                <div class="stat-change">↑ 8% dari bulan lalu</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon green">✓</div>
                </div>
                <div class="stat-title">Tugas Selesai</div>
                <div class="stat-value">89</div>
                <div class="stat-change">↑ 23% dari bulan lalu</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon orange">💰</div>
                </div>
                <div class="stat-title">Total Pendapatan</div>
                <div class="stat-value">Rp 45M</div>
                <div class="stat-change">↑ 15% dari bulan lalu</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h3 class="section-title">Aksi Cepat</h3>
            <div class="action-buttons">
                <a href="#" class="action-btn">
                    <div class="action-btn-icon">📝</div>
                    <span>Buat Proyek Baru</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-btn-icon">👤</div>
                    <span>Kelola Pengguna</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-btn-icon">📈</div>
                    <span>Lihat Laporan</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-btn-icon">⚙️</div>
                    <span>Pengaturan</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-activity">
            <h3 class="section-title">Aktivitas Terbaru</h3>
            
            <div class="activity-item">
                <div class="activity-icon">📄</div>
                <div class="activity-content">
                    <div class="activity-title">Dokumen baru ditambahkan</div>
                    <div class="activity-time">2 jam yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">✅</div>
                <div class="activity-content">
                    <div class="activity-title">Tugas "Update Database" diselesaikan</div>
                    <div class="activity-time">4 jam yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">👤</div>
                <div class="activity-content">
                    <div class="activity-title">3 pengguna baru mendaftar</div>
                    <div class="activity-time">5 jam yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">💬</div>
                <div class="activity-content">
                    <div class="activity-title">2 komentar baru di proyek "Website Redesign"</div>
                    <div class="activity-time">6 jam yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">🔔</div>
                <div class="activity-content">
                    <div class="activity-title">Reminder: Meeting tim pukul 14:00</div>
                    <div class="activity-time">Kemarin</div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>