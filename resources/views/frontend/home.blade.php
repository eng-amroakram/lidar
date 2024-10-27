<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LiGAURD Home Page</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>

<body>

    <header>
        <div class="logo">
            <img src="{{ asset('assets/img/logo-ligaurd.png') }}" alt="LiGAURD Logo" />
            <a href="{{ route('frontend.home') }}">Home</a>
            <a href="{{ route('frontend.meetings') }}">Meeting</a>
            <a href="#">Hi User name</a>
        </div>
        <nav>
            <a href="#">help</a>
            <a href="{{ route('auth.logout') }}">logout</a>
            <a href="profile.htML">profile</a>
        </nav>
    </header>

    <main>

        {{-- Flash message for registration success --}}
        @if (session('success'))
            <div class="alert" style="display: {{ session('success') ? 'block' : 'none' }};">
                {{ session('success') }}
            </div>
        @endif

        <div class="tabs">
            <div class="tab active" id="detecting-summary-tab">
                Detecting summary
            </div>
            <div class="tab" id="recording-attempt-tab">Recording attempt</div>
        </div>

        <div class="tab-content" id="detecting-summary-content">
            <h2>Detecting Summary</h2>
            <p>Summary of the detecting activities will appear here.</p>

            <!-- Bar and Circular Charts -->
            <div class="charts-container">
                <div class="chart">
                    <canvas id="barChart"></canvas>
                </div>
                <div class="chart">
                    <canvas id="circularChart"></canvas>
                </div>
            </div>
        </div>

        <div class="tab-content hide" id="recording-attempt-content">
            <h2>Recording Attempt</h2>
            <p>Details of any recording attempt will appear here.</p>
        </div>
    </main>

    <footer>
        <p>LiGAURD &copy; 2024</p>
    </footer>



    <script src="{{ asset('assets/js/home.js') }}"></script>

</body>

</html>
