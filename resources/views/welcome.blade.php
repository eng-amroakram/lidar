
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Participants POV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        .container {
            width: 100%;
            height: 100%;
            background-color: #111;
            position: relative;

        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #222;
            border-radius: 10px 10px 0 0;
        }

        .logo img {
            width: 80px;
            height: 80px;
        }

        nav {
            display: flex;
            gap: 15px;
        }

        nav .icon {
            display: inline-block;
            background-color: #444;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            text-align: center;
            line-height: 35px;
            font-size: 20px;
            cursor: pointer;
            color: white;
        }

        nav .leave-btn {
            background-color: red;
            padding: 10px 15px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .message {
            text-align: center;
            margin-top: 150px;
        }

        .message h1 {
            font-size: 3rem;
        }

        .message p {
            font-size: 1.5rem;
            margin-top: 20px;
        }





        .controls .btn {
      background-color: transparent;
      border: none;
      color: white;
      font-size: 20px;
      cursor: pointer;
    }

    .leave-btn {
      background-color: red;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 16px;
    }

    .main-content {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      flex-grow: 1;
      text-align: center;
      background-color: #000;
      color: white;
    }

    h1 {
      font-size: 36px;
      margin-bottom: 10px;
    }

    p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .continue-btn {
      background-color: #666;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .participants-section {
      padding: 10px;
      background-color: white;
      color: black;
      border-left: 1px solid #ddd;
      position: absolute;
      top: 110px;
      right: 10px;
    }

    .participants-section h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .suspicious ul {
      list-style: none;
    }

    .suspicious li {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
    }

    .block-btn, .allow-btn {
      background-color: #333;
      color: white;
      border: none;
      padding: 15px 20px;
      margin: 5px;
      cursor: pointer;
      border-radius: 10px;
    }

    .block-btn:hover, .allow-btn:hover, .continue-btn:hover {
      background-color: #555;
    }

    .host-section, .participants-list {
      margin-top: 10px;
    }


    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="1.png" alt="LiGAURD Logo">
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

    <script>
      document.querySelector('.block-btn').addEventListener('click', () => {
        alert('All suspicious users blocked');
      });

      document.querySelector('.allow-btn').addEventListener('click', () => {
        alert('All suspicious users allowed');
      });

      document.querySelector('.continue-btn').addEventListener('click', () => {
        alert('Meeting continued');
      });
    </script>
</body>
</html>







