<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Meeting Link</title>
    <link rel="stylesheet" href="{{ asset('assets/css/invite.css') }}">
</head>

<body>
    <div class="container">
        <!-- Header section -->
        <div class="header">
            <div class="logo">Logo</div>
            <div class="controls">
                <button class="btn participants-icon">👥</button>
                <button class="btn more-options">⋯</button>
                <button class="btn video-icon">🎥</button>
                <button class="btn mic-icon">🎤</button>
                <button class="btn leave-btn">Leave</button>
            </div>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <div class="share-link-box">
                <h2>Share meeting link</h2>
                <div class="input-container">
                    <input type="text" id="meeting-link" value="http://.........................." readonly>
                    <button id="copy-button" class="copy-icon">📋</button>
                </div>
                <button class="copy-link-btn" id="copy-link-btn">Copy link</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/invite.js') }}"></script>

</body>
</html>
