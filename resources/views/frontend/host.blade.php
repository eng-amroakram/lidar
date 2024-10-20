<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Participants POV</title>
    <link rel="stylesheet" href="{{ asset('assets/css/host.css') }}">

</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="LiGAURD Logo">
            </div>
            <nav>
                <span class="icon">👥</span>
                <span class="icon">🎥</span>
                <span class="icon">🎤</span>
                <button class="leave-btn" id="leaveBtn">Leave</button>
            </nav>
        </header>

        <div class="participants-section">
            <h3>Participants</h3>
            <div class="suspicious">
                <h4>Suspicious user</h4>
                <ul>
                    <li>user1 <span>✖ ✔</span></li>
                    <li>user2 <span>✖ ✔</span></li>
                    <li>user3 <span>✖ ✔</span></li>
                </ul>
                <button class="block-btn">Block all</button>
                <button class="allow-btn">Allow all</button>
            </div>
            <div class="host-section">
                <h4>Host</h4>
                <p>Host 1</p>
                <p>Co-Host 1</p>
            </div>
            <div class="participants-list">
                <h4>Participants</h4>
                <p>user1</p>
                <p>user2</p>
                <p>........</p>
                <p>........</p>
            </div>
        </div>

        <div class="message">
            <h1>Record detected</h1>
            <p>Pauses meeting</p>
            <button class="allow-btn">Continue</button>
        </div>
    </div>

    <script src="{{ asset('assets/js/host.js') }}"></script>
</body>

</html>
