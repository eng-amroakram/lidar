<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="{{ asset('assets/css/password_recovery.css') }}">
</head>

<body>
    <div class="">
        <header>
            <div class="logo">
                <h1 style="font-size: 16px">LiGAURD</h1>
            </div>
            <nav>
                <a href="#">about</a>
                <a href="#">support</a>
            </nav>
        </header>

        <section class="password-recovery-section">
            @livewire('password-recovery', ['email_phone' => $email_phone])
        </section>
    </div>

    <script src="{{ asset('assets/js/password_recovery.js') }}"></script>
</body>

</html>
