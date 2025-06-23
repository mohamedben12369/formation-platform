<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - ODR Formation</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <style>
        /* Global Styles */
        :root {
            /* Stunning Color Palette with Yellow & Violet Theme */
            --primary: #667eea;
            --primary-dark: #5a6acf;
            --primary-light: #7c3aed;
            --secondary: #06b6d4;
            --secondary-dark: #0891b2;
            --accent: #fbbf24;
            --accent-light: #fcd34d;
            
            /* Enhanced Surface Colors */
            --surface: rgba(255, 255, 255, 0.95);
            --surface-alt: rgba(248, 250, 252, 0.85);
            --surface-hover: rgba(241, 245, 249, 0.8);
            --surface-glass: rgba(255, 255, 255, 0.15);
            --background: #0f172a;
            
            /* Beautiful Text Colors */
            --text: #1e293b;
            --text-light: #64748b;
            --text-muted: #94a3b8;
            --text-white: #ffffff;
            --text-yellow: #fbbf24;
            
            /* Vibrant Borders */
            --border: rgba(226, 232, 240, 0.5);
            --border-light: rgba(241, 245, 249, 0.3);
            --border-glow: rgba(139, 92, 246, 0.3);
            
            /* Rainbow Color Extensions */
            --success: #10b981;
            --success-light: #34d399;
            --warning: #f59e0b;
            --error: #ef4444;
            --info: #3b82f6;
            --purple: #8b5cf6;
            --violet: #7c3aed;
            --pink: #ec4899;
            --indigo: #6366f1;
            --teal: #14b8a6;
            --orange: #f97316;
            --cyan: #06b6d4;
            --emerald: #10b981;
            --fuchsia: #d946ef;
            --rose: #f43f5e;
            --yellow: #fbbf24;
            --gold: #f59e0b;
            
            /* Modern Radius */
            --radius: 20px;
            --radius-sm: 12px;
            --radius-lg: 28px;
            --radius-xl: 36px;
            
            /* Enhanced Shadows with Color */
            --shadow-sm: 0 2px 4px rgba(139, 92, 246, 0.08);
            --shadow: 0 4px 12px rgba(139, 92, 246, 0.12), 0 2px 4px rgba(251, 191, 36, 0.08);
            --shadow-lg: 0 12px 24px rgba(139, 92, 246, 0.15), 0 6px 12px rgba(124, 58, 237, 0.1);
            --shadow-xl: 0 20px 40px rgba(139, 92, 246, 0.18), 0 10px 20px rgba(251, 191, 36, 0.12);
            --shadow-2xl: 0 30px 60px rgba(139, 92, 246, 0.25), 0 15px 30px rgba(124, 58, 237, 0.15);
            --shadow-glow: 0 0 30px rgba(139, 92, 246, 0.4), 0 0 60px rgba(251, 191, 36, 0.2);
            
            /* Spectacular Gradients */
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #06b6d4 0%, #14b8a6 100%);
            --gradient-accent: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-purple: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            --gradient-violet: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #d946ef 100%);
            --gradient-yellow: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fcd34d 100%);
            --gradient-rainbow: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 20%, #d946ef 40%, #fbbf24 60%, #f59e0b 80%, #fcd34d 100%);
            --gradient-hero: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 25%, #d946ef 50%, #fbbf24 75%, #f59e0b 100%);
            --gradient-card: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0.1) 100%);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--gradient-violet);
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            line-height: 1.7;
            color: var(--text);
            font-weight: 400;
            scroll-behavior: smooth;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(124, 58, 237, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 60%, rgba(217, 70, 239, 0.2) 0%, transparent 50%);
            z-index: -2;
            animation: backgroundFloat 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes backgroundFloat {
            0%, 100% { 
                opacity: 0.6;
                transform: scale(1) rotate(0deg);
            }
            33% { 
                opacity: 0.8;
                transform: scale(1.1) rotate(120deg);
            }
            66% { 
                opacity: 0.4;
                transform: scale(0.9) rotate(240deg);
            }
        }
        
        .welcome-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        .main-header {
            background: var(--gradient-rainbow);
            color: white;
            padding: 1.5rem 0;
            box-shadow: var(--shadow-glow);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(251, 191, 36, 0.3);
            position: relative;
            overflow: hidden;
        }

        .main-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 200%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(251,191,36,0.2), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .main-header .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-link:hover {
            transform: scale(1.02);
        }

        .logo-image {
            height: 48px;
            width: auto;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .logo-text {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            background: linear-gradient(45deg, #ffffff 0%, #f0f9ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links ul {
            list-style: none;
            display: flex;
            gap: 0.5rem;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
        }

        .auth-btn {
            padding: 0.75rem 1.5rem !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: 2px solid transparent !important;
        }

        .login-btn {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(8px) !important;
        }

        .login-btn:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            transform: translateY(-1px) !important;
        }

        .register-btn {
            background: white !important;
            color: var(--primary) !important;
            box-shadow: var(--shadow) !important;
        }

        .register-btn:hover {
            background: #f8fafc !important;
            transform: translateY(-2px) !important;
            box-shadow: var(--shadow-lg) !important;
        }

        .entreprise-nav-link {
            background: rgba(6, 182, 212, 0.15) !important;
            border-color: rgba(6, 182, 212, 0.3) !important;
            backdrop-filter: blur(8px) !important;
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1.25rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
        }

        .profile-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            line-height: 1.3;
        }

        .profile-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.3;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-glass);
            backdrop-filter: blur(20px);
            padding: 8rem 0 6rem;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid var(--border-glow);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 20%, rgba(102, 126, 234, 0.4) 0%, transparent 40%),
                radial-gradient(circle at 70% 80%, rgba(139, 92, 246, 0.3) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(236, 72, 153, 0.2) 0%, transparent 40%),
                radial-gradient(circle at 20% 80%, rgba(6, 182, 212, 0.3) 0%, transparent 40%);
            z-index: 1;
            animation: heroGradient 15s ease-in-out infinite;
        }

        @keyframes heroGradient {
            0%, 100% { 
                opacity: 0.6;
                transform: scale(1);
            }
            50% { 
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-glass);
            z-index: 2;
        }

        .hero-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 3;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6rem;
            align-items: center;
            min-height: 60vh;
        }

        .hero-text {
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 2rem;
            letter-spacing: -0.025em;
        }

        .hero-title-main {
            display: block;
            color: var(--text-yellow);
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(124, 58, 237, 0.3);
        }

        .hero-title-accent {
            display: block;
            background: var(--gradient-yellow);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
        }

        .hero-description {
            font-size: 1.25rem;
            color: var(--text-white);
            line-height: 1.7;
            margin-bottom: 3rem;
            max-width: 500px;
            text-shadow: 1px 1px 2px rgba(124, 58, 237, 0.3);
        }

        .hero-actions {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 4rem;
            flex-wrap: wrap;
        }

        .btn-hero-primary,
        .btn-hero-secondary {
            padding: 1.25rem 2rem;
            border-radius: var(--radius);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .btn-hero-primary {
            background: var(--gradient-rainbow);
            color: white;
            box-shadow: var(--shadow-glow);
            border: 2px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-hero-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-hero-primary:hover::before {
            left: 100%;
        }

        .btn-hero-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-2xl);
            color: white;
            border-color: rgba(255, 255, 255, 0.5);
        }

        .btn-hero-secondary {
            background: var(--gradient-glass);
            color: var(--primary);
            border: 2px solid rgba(102, 126, 234, 0.3);
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(20px);
        }

        .btn-hero-secondary:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0.1) 100%);
            transform: translateY(-3px) scale(1.02);
            box-shadow: var(--shadow-glow);
            color: var(--primary-dark);
            border-color: rgba(102, 126, 234, 0.5);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 900;
            background: var(--gradient-yellow);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--text-white);
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(124, 58, 237, 0.3);
        }

        .hero-visual {
            position: relative;
            height: 500px;
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .hero-main-visual {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .hero-gradient-orb {
            position: absolute;
            top: 20%;
            right: 20%;
            width: 200px;
            height: 200px;
            background: var(--gradient-purple);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 4s ease-in-out infinite reverse;
            filter: blur(40px);
        }

        .hero-floating-card {
            position: absolute;
            background: var(--gradient-glass);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-glow);
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 700;
            color: var(--text);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(20px);
            animation: float 3s ease-in-out infinite;
            transition: all 0.3s ease;
        }

        .hero-floating-card:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: var(--shadow-2xl);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .hero-card-1 {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.3) 0%, rgba(255, 255, 255, 0.2) 100%);
            border-color: rgba(102, 126, 234, 0.4);
        }

        .hero-card-2 {
            top: 60%;
            right: 0%;
            animation-delay: 1s;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.3) 0%, rgba(255, 255, 255, 0.2) 100%);
            border-color: rgba(139, 92, 246, 0.4);
        }

        .hero-card-3 {
            bottom: 20%;
            left: 20%;
            animation-delay: 2s;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.3) 0%, rgba(255, 255, 255, 0.2) 100%);
            border-color: rgba(236, 72, 153, 0.4);
        }

        .hero-floating-card i {
            font-size: 1.5rem;
            background: var(--gradient-rainbow);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-card-1 i {
            color: var(--primary);
        }

        .hero-card-2 i {
            color: var(--secondary);
        }

        .hero-card-3 i {
            color: var(--purple);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* Enhanced Animations */
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .hero-text {
            animation: fadeInUp 0.8s ease-out;
        }

        .hero-visual {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .stat-item:hover .stat-number {
            animation: pulse 0.6s ease-in-out;
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: var(--text-white);
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            animation: float 2s ease-in-out infinite;
            text-shadow: 1px 1px 2px rgba(124, 58, 237, 0.3);
        }

        .scroll-indicator i {
            font-size: 1.5rem;
        }

        /* Main Content */
        main {
            flex: 1;
        }

        /* Formations Section */
        .formations-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 6rem 2rem 4rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            background: var(--gradient-yellow);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            line-height: 1.2;
            letter-spacing: -0.025em;
            text-shadow: 2px 2px 4px rgba(124, 58, 237, 0.2);
        }

        .section-subtitle {
            font-size: 1.25rem;
            color: var(--text-white);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(124, 58, 237, 0.3);
        }

        .search-filter-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            gap: 2rem;
            padding: 2rem;
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .search-bar {
            position: relative;
            flex: 1;
            max-width: 500px;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3.5rem;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-size: 1rem;
            background: var(--surface-alt);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background: var(--surface);
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .filter-tabs {
            display: flex;
            gap: 0.75rem;
        }

        .filter-tab {
            padding: 1rem 1.5rem;
            border: 2px solid var(--border);
            background: var(--surface-alt);
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .filter-tab.active,
        .filter-tab:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Formation Cards */
        .formations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }

        .formation-card {
            background: var(--gradient-glass);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-glow);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(25px);
        }

        .formation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-card);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
            pointer-events: none;
        }

        .formation-card:hover::before {
            opacity: 1;
        }

        .formation-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: var(--shadow-2xl);
            border-color: rgba(102, 126, 234, 0.5);
        }

        .formation-image {
            position: relative;
            height: 240px;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
        }

        .formation-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 20px 20px 0 0;
        }

        .formation-img:not([src]) {
            display: none;
        }

        .formation-img[alt]:after {
            content: attr(alt);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--gradient-primary);
            color: white;
            padding: 1rem;
            border-radius: var(--radius);
            font-size: 0.9rem;
            text-align: center;
            white-space: nowrap;
            max-width: 80%;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .formation-card:hover .formation-img {
            transform: scale(1.1);
        }

        .formation-img-placeholder {
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .formation-img-placeholder i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .formation-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-rainbow);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(15px);
        }

        .formation-card:hover .formation-overlay {
            opacity: 1;
        }

        .quick-apply-btn {
            background: white;
            color: var(--primary);
            padding: 1rem 2rem;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-lg);
        }

        .quick-apply-btn:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-xl);
        }

        .formation-content {
            padding: 2.5rem;
            position: relative;
            z-index: 2;
        }

        .formation-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .formation-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text);
            margin: 0;
            line-height: 1.3;
            flex: 1;
            letter-spacing: -0.025em;
        }

        .formation-badge {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-sm);
        }

        .formation-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.95rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .meta-item i {
            color: var(--primary);
            width: 20px;
            flex-shrink: 0;
            font-size: 1.1rem;
        }

        .formation-description p {
            color: var(--text-light);
            line-height: 1.7;
            margin: 0;
            font-size: 1rem;
        }

        .formation-themes {
            margin: 2rem 0;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--surface-alt) 0%, #f1f5f9 100%);
            border-radius: var(--radius);
            border: 1px solid var(--border);
        }

        .themes-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-weight: 700;
            color: var(--text);
            font-size: 1rem;
        }

        .themes-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .theme-tag {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .theme-more {
            background: rgba(99, 102, 241, 0.2);
            color: var(--primary-dark);
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 700;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        /* Formation Actions */
        .formation-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .btn-details {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
            border: 2px solid rgba(99, 102, 241, 0.2);
            color: var(--primary);
            padding: 0.875rem 1.5rem;
            border-radius: var(--radius);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-details:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(6, 182, 212, 0.15) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-apply {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: var(--shadow);
        }

        .btn-apply:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .auth-prompt {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--surface-alt) 0%, #f1f5f9 100%);
            border-radius: var(--radius);
            border: 1px solid var(--border);
        }

        .auth-text {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn-login,
        .btn-register {
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-login {
            background: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }

        .btn-register {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-login:hover,
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Formation Details */
        .formation-details {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid var(--border);
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                max-height: 2000px;
                transform: translateY(0);
            }
        }

        .detailed-themes {
            margin-bottom: 2rem;
        }

        .theme-detail {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .theme-detail:hover {
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .theme-detail .theme-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.025em;
        }

        .theme-prerequisites {
            margin-bottom: 1.5rem;
        }

        .prereq-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            color: var(--success);
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .prereq-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .prereq-list li {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .theme-competences {
            margin-top: 1.5rem;
        }

        .comp-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            color: #7c3aed;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .comp-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .comp-tag {
            background: rgba(124, 58, 237, 0.1);
            color: #6b21a8;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(124, 58, 237, 0.2);
        }

        .additional-info {
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .info-item {
            margin-bottom: 1.5rem;
        }

        .info-item strong {
            color: var(--text);
            display: block;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .info-item p {
            color: var(--text-light);
            margin: 0;
            line-height: 1.7;
            font-size: 1rem;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 6rem 3rem;
            background: linear-gradient(135deg, var(--surface-alt) 0%, #f1f5f9 100%);
            border-radius: 24px;
            border: 2px dashed rgba(99, 102, 241, 0.3);
        }

        .empty-icon {
            font-size: 5rem;
            color: var(--primary);
            margin-bottom: 2rem;
            opacity: 0.8;
        }

        .empty-title {
            color: var(--text);
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .empty-text {
            color: var(--text-light);
            font-size: 1.125rem;
            margin: 0;
            line-height: 1.6;
        }

        /* Espace Entreprise Section */
        .espace-entreprise-section {
            background: var(--surface);
            padding: 6rem 2rem;
            margin-top: 6rem;
            border-top: 1px solid var(--border);
        }

        .section-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .espace-entreprise-content {
            display: flex;
            gap: 6rem;
            align-items: center;
        }

        .espace-entreprise-text {
            flex: 1;
        }

        .espace-entreprise-text h3 {
            font-size: 2.25rem;
            background: var(--gradient-yellow);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(124, 58, 237, 0.2);
        }

        .espace-entreprise-text p {
            color: var(--text-light);
            font-size: 1.125rem;
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .espace-entreprise-text ul {
            list-style: none;
            padding: 0;
            margin-bottom: 3rem;
        }

        .espace-entreprise-text ul li {
            color: var(--text-light);
            font-size: 1.125rem;
            margin-bottom: 1rem;
            padding-left: 2rem;
            position: relative;
            line-height: 1.7;
        }

        .espace-entreprise-text ul li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--success);
            font-weight: 800;
            font-size: 1.25rem;
        }

        .espace-entreprise-image {
            flex: 1;
        }

        .espace-entreprise-image img {
            width: 100%;
            height: auto;
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border);
        }

        .entreprise-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .btn-entreprise {
            background: linear-gradient(135deg, var(--secondary) 0%, #0891b2 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: var(--radius);
            font-size: 1rem;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow);
            display: inline-block;
        }

        .btn-entreprise:hover {
            background: linear-gradient(135deg, #0891b2 0%, var(--secondary) 100%);
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .btn-entreprise-secondary {
            background: var(--surface);
            color: var(--secondary);
            border: 2px solid var(--secondary);
        }

        .btn-entreprise-secondary:hover {
            background: rgba(6, 182, 212, 0.05);
            box-shadow: var(--shadow-lg);
        }

        /* Hamburger Menu */
        .hamburger-menu {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
            padding: 0.5rem;
        }

        .hamburger-menu span {
            width: 28px;
            height: 3px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 4rem;
                text-align: center;
            }
            
            .hero-visual {
                height: 300px;
            }
            
            .hero-main-visual {
                width: 300px;
                height: 300px;
            }
            
            .formations-grid {
                grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
                gap: 1.5rem;
            }
            
            .search-filter-section {
                flex-direction: column;
                gap: 2rem;
                padding: 1.5rem;
            }
            
            .espace-entreprise-content {
                flex-direction: column;
                gap: 3rem;
            }

            .section-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 6rem 0 4rem;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-description {
                font-size: 1.125rem;
            }
            
            .hero-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero-primary,
            .btn-hero-secondary {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
            
            .hero-stats {
                justify-content: center;
                gap: 2rem;
            }
            
            .hero-visual {
                height: 250px;
            }
            
            .hero-floating-card {
                padding: 1rem;
                font-size: 0.9rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .hamburger-menu {
                display: flex;
            }
            
            .formations-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .section-title {
                font-size: 2rem;
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .logo-text {
                font-size: 1.5rem;
            }
            
            .logo-image {
                height: 40px;
            }
            
            .profile-info {
                display: none;
            }
            
            .formation-meta {
                grid-template-columns: 1fr;
            }
            
            .formation-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .main-header .container {
                padding: 0 1rem;
            }

            .formations-section {
                padding: 0 1rem;
            }

            .formation-content {
                padding: 2rem;
            }

            .search-filter-section {
                padding: 1rem;
            }

            .filter-tabs {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .espace-entreprise-section {
                padding: 4rem 1rem;
            }

            .espace-entreprise-text h3 {
                font-size: 1.875rem;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 1.75rem;
            }

            .formation-card {
                border-radius: 20px;
            }

            .formation-content {
                padding: 1.5rem;
            }

            .btn-apply, .btn-details {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-page">
        <!-- Header -->
        <header class="main-header">
            <div class="container">
                <div class="logo">
                    <a href="{{ url('/') }}" class="logo-link">
                        <img src="{{ asset('images/Logos.jpg') }}" alt="Logo ODR" class="logo-image">
                        <span class="logo-text">ODR Formation</span>
                    </a>
                </div>
                <nav class="nav-links">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Accueil</a></li>
                        <li><a href="{{ route('decouvrez-nous') }}">Découvrez-nous</a></li>
                        <li><a href="{{ url('/about') }}">À propos</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <li><a href="{{url('/candidatures')}}">Candidatures</a></li>
                        <li><a href="{{ route('entreprise.dashboard') }}" class="entreprise-nav-link">
                            <i class="fas fa-building"></i>Espace Entreprise
                        </a></li>
                       
                        @guest
                            <li><a href="{{ route('login') }}" class="auth-btn login-btn">Connexion</a></li>
                            <li><a href="{{ route('register') }}" class="auth-btn register-btn">Inscription</a></li>
                        @else
                            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </form>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="profile-avatar-link">
                                    @php
                                        $user = Auth::user();
                                        $avatarUrl = $user->image && file_exists(storage_path('app/public/' . $user->image)) 
                                            ? asset('storage/' . $user->image)
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=667eea&color=fff&size=64';
                                    @endphp
                                    <div class="profile-section">
                                        <img src="{{ $avatarUrl }}" alt="Profile" class="profile-avatar" />
                                        <div class="profile-info">
                                            <span class="profile-name">{{ $user->name }}</span>
                                            <small class="profile-role">Mon Profil</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </nav>
                <div class="hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-container">
                    <div class="hero-content">
                        <div class="hero-text">
                            <h1 class="hero-title">
                                <span class="hero-title-main">Développez vos compétences</span>
                                <span class="hero-title-accent">avec ODR Formation</span>
                            </h1>
                            <p class="hero-description">
                                Découvrez notre catalogue de formations professionnelles conçues pour faire évoluer votre carrière et développer de nouvelles compétences.
                            </p>
                            <div class="hero-actions">
                                <a href="#formations" class="btn-hero-primary">
                                    <i class="fas fa-rocket"></i>
                                    Explorer les formations
                                </a>
                                @guest
                                    <a href="{{ route('register') }}" class="btn-hero-secondary">
                                        <i class="fas fa-user-plus"></i>
                                        Créer un compte
                                    </a>
                                @else
                                    <a href="{{ route('dashboard.index') ?? '#' }}" class="btn-hero-secondary">
                                        <i class="fas fa-user-circle"></i>
                                        Mon tableau de bord
                                    </a>
                                @endguest
                            </div>
                            <div class="hero-stats">
                                <div class="stat-item">
                                    <span class="stat-number">{{ isset($formations) ? $formations->count() : '0' }}+</span>
                                    <span class="stat-label">Formations</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">500+</span>
                                    <span class="stat-label">Étudiants</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">95%</span>
                                    <span class="stat-label">Satisfaction</span>
                                </div>
                            </div>
                        </div>
                        <div class="hero-visual">
                            <div class="hero-image-wrapper">
                                <div class="hero-floating-card hero-card-1">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Formation</span>
                                </div>
                                <div class="hero-floating-card hero-card-2">
                                    <i class="fas fa-certificate"></i>
                                    <span>Certification</span>
                                </div>
                                <div class="hero-floating-card hero-card-3">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Progression</span>
                                </div>
                                <div class="hero-main-visual">
                                    <div class="hero-gradient-orb"></div>
                                    <div class="hero-pattern"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scroll-indicator">
                    <span>Découvrir nos formations</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </section>
            <!-- Formations Section -->
            <section id="formations" class="formations-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-star section-icon"></i>
                        Formations Disponibles
                    </h2>
                    <p class="section-subtitle">
                        Choisissez parmi notre sélection de formations professionnelles adaptées à vos besoins
                    </p>
                </div>

                <!-- Search and Filter -->
                <div class="search-filter-section">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Rechercher une formation..." class="search-input">
                    </div>
                    <div class="filter-tabs">
                        <button class="filter-tab active" data-filter="all">
                            <i class="fas fa-list"></i>
                            Toutes
                        </button>
                        <button class="filter-tab" data-filter="recent">
                            <i class="fas fa-clock"></i>
                            Récentes
                        </button>
                        <button class="filter-tab" data-filter="popular">
                            <i class="fas fa-fire"></i>
                            Populaires
                        </button>
                    </div>
                </div>

                <!-- Formations Grid -->
                <div class="formations-grid">
                    @forelse($formations as $formation)
                        <div class="formation-card" data-category="recent">
                            <!-- Image avec overlay -->
                            <div class="formation-image">
                                @if($formation->image && file_exists(public_path($formation->image)))
                                    <img src="{{ asset($formation->image) }}" alt="{{ $formation->nom }}" class="formation-img" loading="lazy">
                                @elseif($formation->image)
                                    <img src="{{ asset($formation->image) }}" alt="{{ $formation->nom }}" class="formation-img" loading="lazy" 
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'formation-img-placeholder\'><i class=\'fas fa-graduation-cap\'></i><span>{{ strtoupper(substr($formation->nom, 0, 2)) }}</span></div>';">
                                @else
                                    <div class="formation-img-placeholder">
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>{{ strtoupper(substr($formation->nom, 0, 2)) }}</span>
                                    </div>
                                @endif
                                <div class="formation-overlay">
                                    @auth
                                        <a href="{{ route('candidatures.create', $formation) }}" class="quick-apply-btn">
                                            <i class="fas fa-paper-plane"></i>
                                            Candidater
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="quick-apply-btn">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Se connecter
                                        </a>
                                    @endauth
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="formation-content">
                                <div class="formation-header">
                                    <h3 class="formation-title">{{ $formation->nom }}</h3>
                                    <div class="formation-badge">
                                        <i class="fas fa-calendar-check"></i>
                                        Disponible
                                    </div>
                                </div>

                                <div class="formation-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>{{ \Carbon\Carbon::parse($formation->dateDebut)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $formation->lieu }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $formation->duree }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-tag"></i>
                                        <span>{{ $formation->typeFormation->nom ?? 'Formation' }}</span>
                                    </div>
                                </div>

                                <div class="formation-description">
                                    <p>{{ $formation->objectifs ? Str::limit($formation->objectifs, 120) : 'Une formation complète pour développer vos compétences professionnelles.' }}</p>
                                </div>

                                <!-- Thèmes -->
                                @if($formation->themes && $formation->themes->count())
                                    <div class="formation-themes">
                                        <div class="themes-header">
                                            <i class="fas fa-tags"></i>
                                            <span>Thèmes :</span>
                                        </div>
                                        <div class="themes-preview">
                                            @foreach($formation->themes->take(2) as $theme)
                                                <span class="theme-tag">{{ $theme->titre }}</span>
                                            @endforeach
                                            @if($formation->themes->count() > 2)
                                                <span class="theme-more">+{{ $formation->themes->count() - 2 }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Détails cachés -->
                                <div class="formation-details" style="display: none;">
                                    @if($formation->themes && $formation->themes->count())
                                        <div class="detailed-themes">
                                            @foreach($formation->themes as $theme)
                                                <div class="theme-detail">
                                                    <h5 class="theme-title">
                                                        <i class="fas fa-bookmark"></i>
                                                        {{ $theme->titre }}
                                                    </h5>
                                                    
                                                    @if($theme->prerequis_array && count($theme->prerequis_array) > 0)
                                                        <div class="theme-prerequisites">
                                                            <span class="prereq-label">
                                                                <i class="fas fa-check-circle"></i>
                                                                Prérequis :
                                                            </span>
                                                            <ul class="prereq-list">
                                                                @foreach($theme->prerequis_array as $prerequis)
                                                                    <li>{{ trim($prerequis) }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($theme->competence_visees_array && count($theme->competence_visees_array) > 0)
                                                        <div class="theme-competences">
                                                            <span class="comp-label">
                                                                <i class="fas fa-star"></i>
                                                                Compétences :
                                                            </span>
                                                            <div class="comp-tags">
                                                                @foreach($theme->competence_visees_array as $competence)
                                                                    <span class="comp-tag">{{ trim($competence) }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <div class="additional-info">
                                        @if($formation->prerequis)
                                            <div class="info-item">
                                                <strong>Prérequis généraux :</strong>
                                                <p>{{ $formation->prerequis }}</p>
                                            </div>
                                        @endif
                                        @if($formation->programme)
                                            <div class="info-item">
                                                <strong>Programme :</strong>
                                                <p>{{ $formation->programme }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="formation-actions">
                                    <button class="btn-details" onclick="toggleDetails(this)">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="details-text">Voir plus</span>
                                    </button>
                                    
                                    @auth
                                        <a href="{{ route('candidatures.create', $formation) }}" class="btn-apply">
                                            <i class="fas fa-paper-plane"></i>
                                            Candidater
                                        </a>
                                    @else
                                        <div class="auth-prompt">
                                            <p class="auth-text">
                                                <i class="fas fa-lock"></i>
                                                Connectez-vous pour candidater
                                            </p>
                                            <div class="auth-buttons">
                                                <a href="{{ route('login') }}" class="btn-login">Connexion</a>
                                                <a href="{{ route('register') }}" class="btn-register">Inscription</a>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h3 class="empty-title">Aucune formation disponible</h3>
                            <p class="empty-text">Les nouvelles formations seront bientôt disponibles. Revenez plus tard !</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Espace Entreprise Section -->
            <section class="espace-entreprise-section">
                <div class="section-container">
                    <h2 class="section-title">Espace Entreprise</h2>
                    <div class="espace-entreprise-content">
                        <div class="espace-entreprise-text">
                            <h3>Développez les compétences de vos collaborateurs</h3>
                            <p>Notre plateforme offre des solutions de formation adaptées aux besoins spécifiques de votre entreprise :</p>
                            <ul>
                                <li>Formations personnalisées sur mesure</li>
                                <li>Accompagnement professionnel</li>
                                <li>Suivi des progrès</li>
                                <li>Certification professionnelle</li>
                            </ul>
                            <div class="entreprise-actions">
                                @auth
                                    @if(Auth::user()->entreprise)
                                        <a href="{{ route('entreprise.dashboard') }}" class="btn-entreprise">Accéder à mon espace entreprise</a>
                                    @else
                                        <a href="{{ route('entreprise.create') }}" class="btn-entreprise">Créer mon entreprise</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-entreprise">Se connecter à mon espace entreprise</a>
                                    <a href="{{ route('register') }}" class="btn-entreprise btn-entreprise-secondary">Créer un compte entreprise</a>
                                @endauth
                            </div>
                        </div>
                        <div class="espace-entreprise-image">
                            <img src="{{ asset('images/entreprise-formation.jpg') }}" alt="Formation entreprise">
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <x-footer />
    </div>

    <script>
        function toggleDetails(button) {
            const detailsDiv = button.closest('.formation-content').querySelector('.formation-details');
            const detailsText = button.querySelector('.details-text');
            const isExpanded = detailsDiv.style.display !== 'none';
            
            if (isExpanded) {
                detailsDiv.style.display = 'none';
                detailsText.textContent = 'Voir plus';
                button.classList.remove('expanded');
            } else {
                detailsDiv.style.display = 'block';
                detailsText.textContent = 'Voir moins';
                button.classList.add('expanded');
            }
        }
        
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for scroll indicator
            const scrollIndicator = document.querySelector('.scroll-indicator');
            if (scrollIndicator) {
                scrollIndicator.addEventListener('click', function() {
                    document.getElementById('formations').scrollIntoView({
                        behavior: 'smooth'
                    });
                });
                scrollIndicator.style.cursor = 'pointer';
            }
            
            const searchInput = document.getElementById('searchInput');
            const filterTabs = document.querySelectorAll('.filter-tab');
            const formationCards = document.querySelectorAll('.formation-card');
            
            // Search functionality
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    
                    formationCards.forEach(card => {
                        const title = card.querySelector('.formation-title').textContent.toLowerCase();
                        const description = card.querySelector('.formation-description p').textContent.toLowerCase();
                        
                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
            
            // Filter functionality
            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    filterTabs.forEach(t => t.classList.remove('active'));
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    const filter = this.dataset.filter;
                    
                    formationCards.forEach(card => {
                        if (filter === 'all' || card.dataset.category === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            
            // Animation pour les cartes au chargement
            const cards = document.querySelectorAll('.formation-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>