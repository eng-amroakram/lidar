<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Page - LiGAURD</title>
    <link rel="stylesheet" href="{{ asset('assets/css/past_meetings.css') }}">
</head>

<body>
    <header>
        <div class="logo">
            <img src="{{ asset('assets/img/logo-ligaurd.png') }}" alt="LiGAURD Logo">
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
        <h1>Meeting Page</h1>
        <div class="meeting-options">
            <div class="meeting-option">
                <button id="startMeetingBtn">
                    <p>Start a Meeting</p>
                </button>
            </div>
            <div class="meeting-option">
                <button id="joinMeetingBtn">
                    <p>Join a Meeting</p>
                </button>
            </div>
        </div>



        <!-- Past Meetings -->
        <div class="past-meetings">
            <h2>Past Meetings</h2>
            <input type="text" id="searchMeetings" placeholder="Search past meetings">
            <ul id="meetingsList"></ul> <!-- This will be populated with data from the server -->
        </div>
    </main>

    <footer>
        <p>&copy; 2024 LiGAURD</p>
    </footer>

    <script src="{{ asset('assets/js/past_meetings.js') }}"></script>

</body>

</html>



<!-- Create a Meeting Form
 <div class="meeting-form">
    <h2>Create a Meeting</h2>
    <label for="meeting-name">Meeting Name</label>
    <input type="text" id="meeting-name" placeholder="Enter meeting name" required>

    <label for="meeting-date">Meeting Date</label>
    <input type="date" id="meeting-date" required>

    <label for="meeting-time">Meeting Time</label>
    <input type="time" id="meeting-time" required>

    <label for="participants">Participants (comma separated emails)</label>
    <input type="text" id="participants" placeholder="Enter participants" required>

    <button onclick="createMeeting()">Create Meeting</button>

    <p class="success-message" id="success-message">Meeting created successfully!</p>
</div> -->
