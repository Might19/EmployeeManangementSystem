<!DOCTYPE html>
<html>
<head>
    <title>Main Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar styling */
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #fff;
            margin: 10px 0;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }
    </style>
</head>
<body class="bg-light">

<!-- 🔹 Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Employee Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- 🔹 Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar d-md-block collapse" id="navbarNav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                        Employees
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                        Departments
                    </a>
                </li>
            </ul>
        </div>

        <!-- 🔹 Main Content (yield) -->
        <main id="main-content" class="col-md-9 col-lg-10 px-4 py-5">
            @yield('content')
        </main>
    </div>
</div>

<script>
/*
  Simple AJAX navigation:
  - Intercept clicks on sidebar links
  - Fetch page, parse HTML, extract <main> content and inject it
  - Update history (pushState)
  - Handle browser back/forward (popstate)
*/
(function () {
    const sidebar = document.querySelector('.sidebar');

    function setActiveLink(url) {
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            if (link.href === url) link.classList.add('active');
            else link.classList.remove('active');
        });
    }

    async function loadIntoMain(url, addHistory = true) {
        try {
            const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const text = await res.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(text, 'text/html');
            const newMain = doc.querySelector('main') || doc.querySelector('#main-content') || doc.body;
            if (newMain) {
                document.querySelector('main#main-content').innerHTML = newMain.innerHTML;
                if (addHistory) history.pushState({ url }, '', url);
                setActiveLink(url);
                // Optional: re-run any inline scripts in the loaded fragment if needed
            } else {
                // fallback: full navigation if cannot parse
                window.location.href = url;
            }
        } catch (err) {
            console.error('AJAX load failed', err);
            window.location.href = url;
        }
    }

    // Intercept sidebar link clicks
    sidebar.addEventListener('click', function (e) {
        const a = e.target.closest('.nav-link');
        if (!a) return;
        const url = a.href;
        // Only intercept same-origin navigations
        if (url && location.origin === new URL(url).origin) {
            e.preventDefault();
            loadIntoMain(url, true);
        }
    });

    // Handle back/forward
    window.addEventListener('popstate', function (e) {
        const url = location.href;
        loadIntoMain(url, false);
    });

    // Optional: if the page initially loaded a sub-route (like /employees), ensure sidebar marks it active
    setActiveLink(location.href);
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
