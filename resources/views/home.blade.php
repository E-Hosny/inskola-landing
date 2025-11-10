<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inskola - Modern Education Platform</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 150px 2rem 100px;
            text-align: center;
            margin-top: 70px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            animation: fadeInUp 1s ease 0.2s;
            animation-fill-mode: both;
        }

        .cta-button {
            background: white;
            color: #667eea;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
            animation: fadeInUp 1s ease 0.4s;
            animation-fill-mode: both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        /* Features Section */
        .features {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #333;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #667eea;
        }

        .feature-card p {
            color: #666;
            line-height: 1.8;
        }

        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 2rem;
            text-align: center;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .stat-item h2 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Contact Section */
        .contact {
            max-width: 600px;
            margin: 80px auto;
            padding: 0 2rem;
        }

        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        /* Success Message */
        .success-message {
            background: #10b981;
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
            animation: fadeInUp 0.5s ease;
        }

        /* Error Messages */
        .error-message {
            background: #ef4444;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        /* Animations */
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .nav-links {
                gap: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">Inskola</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <h1>Welcome to Inskola</h1>
        <p>Transform Your Learning Experience with Modern Education Technology</p>
        <a href="#contact" class="cta-button">Get Started</a>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2 class="section-title">Our Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Rich Content</h3>
                <p>Access thousands of courses and educational materials designed by experts in their fields.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Personalized Learning</h3>
                <p>AI-powered recommendations tailored to your learning style and goals.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Community Support</h3>
                <p>Connect with learners worldwide and collaborate on projects together.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Mobile Friendly</h3>
                <p>Learn anywhere, anytime with our responsive platform optimized for all devices.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏆</div>
                <h3>Certifications</h3>
                <p>Earn recognized certificates upon course completion to boost your career.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Fast & Reliable</h3>
                <p>Lightning-fast platform with 99.9% uptime to ensure uninterrupted learning.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats" id="about">
        <h2 class="section-title">Inskola by Numbers</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <h2>10K+</h2>
                <p>Active Students</p>
            </div>
            <div class="stat-item">
                <h2>500+</h2>
                <p>Expert Instructors</p>
            </div>
            <div class="stat-item">
                <h2>1000+</h2>
                <p>Courses Available</p>
            </div>
            <div class="stat-item">
                <h2>95%</h2>
                <p>Satisfaction Rate</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <h2 class="section-title">Get In Touch</h2>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-button">Send Message</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Inskola. All rights reserved. | Built with Laravel & Blade</p>
    </footer>
</body>
</html>

