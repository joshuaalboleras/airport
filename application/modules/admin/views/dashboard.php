<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <style>
        :root {
            --primary-color: #6366f1;
            --text-primary: #1e293b;
            --text-secondary: #4b5563;
            --bg-light: #f9fafb;
            --border-color: #e5e7eb;
            --box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --transition-duration: 0.3s;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: var(--bg-light);
            color: var(--text-primary);
        }

        nav {
            padding: 1rem 1.5rem;
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 10;
            box-shadow: var(--box-shadow);
        }

        nav .left-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        nav .left-section button {
            border: none;
            background: none;
            cursor: pointer;
            padding: 0.75rem;
            border-radius: 0.375rem;
            transition: background-color var(--transition-duration);
        }

        nav .left-section button:hover {
            background-color: var(--bg-light);
        }

        nav .left-section h1 {
            margin: 0;
            font-size: 1.75rem;
            color: var(--primary-color);
        }

        nav .right-section {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        nav .right-section button {
            padding: 0.75rem 1.25rem;
            border-radius: 0.375rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color var(--transition-duration);
        }

        nav .right-section button:hover {
            background-color: #5048e5;
        }

        .main-container {
            display: flex;
            flex: 1;
        }

        .sidebar {
            background-color: white;
            transition: width var(--transition-duration) ease, box-shadow var(--transition-duration) ease;
            overflow-x: hidden;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 50;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
        }

        .sidebar.open {
            width: 280px;
        }

        .sidebar-content {
            padding-top: 4rem; /* Account for fixed navbar */
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            width: 280px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .sidebar-content h2 {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar-content a {
            padding: 0.8rem;
            border-radius: 0.375rem;
            color: var(--text-primary);
            text-decoration: none;
            display: block;
            transition: background-color var(--transition-duration), color var(--transition-duration);
        }

        .sidebar-content a:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            margin-left: 0;
            transition: margin-left var(--transition-duration) ease;
        }

        .main-content.open {
            margin-left: 20px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .content-header h2 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .content-header button {
            padding: 0.75rem 1.25rem;
            border-radius: 0.375rem;
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            cursor: pointer;
            transition: background-color var(--transition-duration), color var(--transition-duration);
        }

        .content-header button:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .cards-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .card {
            padding: 1.75rem;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: var(--box-shadow);
            border-left: 5px solid var(--primary-color);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: var(--text-primary);
        }

        .card p {
            margin: 0;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            display: none;
            transition: opacity var(--transition-duration);
        }

        .overlay.open {
            display: block;
            opacity: 1;
        }

        @media (min-width: 769px) {
            .sidebar {
                position: relative;
                top: auto;
                left: auto;
                height: auto;
                z-index: auto;
                width: 280px;
                box-shadow: none;
            }

            .main-content {
                margin-left: 280px;
            }

            .sidebar-content {
                padding-top: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="left-section">
            <button id="toggleSidebar">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18" />
                </svg>
            </button>
            <h1>Modern Dashboard</h1>
        </div>
        <div class="right-section">
            <button>Add New</button>
        </div>
    </nav>

    <div class="main-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-content">
                <h2>Navigation</h2>
                <a href="#">Overview</a>
                <a href="#">Analytics</a>
                <a href="#">Reports</a>
                <a href="#">Users</a>
                <a href="#">Settings</a>

                <h2>Admin</h2>
                <a href="#">Manage Data</a>
                <a href="#">Audit Logs</a>
            </div>
        </div>

        <div class="main-content" id="mainContent">
            <div class="content-header">
                <h2>Dashboard Overview</h2>
                <button>Generate Report</button>
            </div>
            <div class="cards-grid">
                <div class="card">
                    <h3>Total Users</h3>
                    <p>1,250 active users on the platform.</p>
                </div>
                <div class="card">
                    <h3>Monthly Revenue</h3>
                    <p>$15,780 generated this month.</p>
                </div>
                <div class="card">
                    <h3>New Sign-ups</h3>
                    <p>235 new users joined in the last 30 days.</p>
                </div>
                <div class="card">
                    <h3>Average Session Time</h3>
                    <p>7 minutes 42 seconds per session.</p>
                </div>
            </div>
        </div>

        <div id="overlay" class="overlay"></div>
    </div>

   <script>
        const toggleSidebarButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const overlay = document.getElementById('overlay');

        const toggleSidebar = () => {
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('open');

            if (sidebar.classList.contains('open') && window.innerWidth <= 768) {
                overlay.classList.add('open');
            } else {
                overlay.classList.remove('open');
            }
        };

        toggleSidebarButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.add('open');
                mainContent.classList.add('open');
                overlay.classList.remove('open');
            } else {
                sidebar.classList.remove('open');
                mainContent.classList.remove('open');
                overlay.classList.remove('open');
            }
        });

        // Initial state based on screen size
        if (window.innerWidth > 768) {
            sidebar.classList.add('open');
            mainContent.classList.add('open');
            overlay.classList.remove('open');
        } else {
            sidebar.classList.remove('open');
            mainContent.classList.remove('open');
            overlay.classList.remove('open');
        }
    </script>
</body>
</html>