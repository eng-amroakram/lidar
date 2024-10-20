<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Participants POV</title>

    <link rel="stylesheet" href="{{ asset('assets/css/unauthorized_recording.css') }}">

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

        <div class="message">
            <h1>Unauthorized Recording</h1>
            <p>Waiting for the host action</p>
        </div>
    </div>

    <script src="{{ asset('assets/js/unauthorized_recording.js') }}"></script>


</body>

</html>
