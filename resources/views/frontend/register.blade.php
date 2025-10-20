<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(45deg, #ff9a9e, #fad0c4, #a1c4fd);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            position: relative;
            width: 400px;
            /* height: 500px; */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            transform-style: preserve-3d;
            perspective: 1000px;
            animation: containerFloat 6s ease-in-out infinite;
        }

        @keyframes containerFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 380px;
            height: 420px;
            background: linear-gradient(0deg, transparent, 
                        rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4));
            transform-origin: bottom right;
            animation: animate 6s linear infinite;
        }

        .container::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 380px;
            height: 420px;
            background: linear-gradient(0deg, transparent, 
                        rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4));
            transform-origin: bottom right;
            animation: animate 6s linear infinite;
            animation-delay: -3s;
        }

        @keyframes animate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .form {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 40px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo span {
            font-size: 2.5em;
            font-weight: 700;
            letter-spacing: 2px;
            background: linear-gradient(45deg, #ff9a9e, #a1c4fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .inputBox {
            position: relative;
            width: 100%;
            margin-top: 30px;
        }

        .inputBox input {
            position: relative;
            width: 100%;
            padding: 15px 20px;
            outline: none;
            font-size: 1em;
            color: #333;
            border-radius: 10px;
            border: none;
            background: rgba(255, 255, 255, 0.7);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: 0.5s;
        }

        .inputBox span {
            position: absolute;
            left: 0;
            padding: 15px 20px;
            pointer-events: none;
            font-size: 1em;
            color: #666;
            transition: 0.5s;
        }

        .inputBox input:valid ~ span,
        .inputBox input:focus ~ span {
            color: #a1c4fd;
            transform: translateX(10px) translateY(-7px);
            font-size: 0.75em;
            padding: 0 10px;
            background: white;
            border-radius: 10px;
        }

        .inputBox input:valid,
        .inputBox input:focus {
            border-bottom: 2px solid #a1c4fd;
        }

        .enter {
            position: relative;
            width: 100%;
            height: 50px;
            margin-top: 40px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            letter-spacing: 2px;
            transition: 0.5s;
            border: none;
            overflow: hidden;
            background: linear-gradient(90deg, #ff9a9e, #a1c4fd);
            color: white;
        }

        .enter:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .enter::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .floating-elements div {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: floatUp 15s linear infinite;
            bottom: -150px;
        }

        .floating-elements div:nth-child(1) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 0s;
            animation-duration: 12s;
        }

        .floating-elements div:nth-child(2) {
            left: 35%;
            width: 25px;
            height: 25px;
            animation-delay: 2s;
            animation-duration: 16s;
        }

        .floating-elements div:nth-child(3) {
            left: 55%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
            animation-duration: 13s;
        }

        .floating-elements div:nth-child(4) {
            left: 70%;
            width: 30px;
            height: 30px;
            animation-delay: 1s;
            animation-duration: 15s;
        }

        .floating-elements div:nth-child(5) {
            left: 85%;
            width: 15px;
            height: 15px;
            animation-delay: 7s;
            animation-duration: 12s;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.5;
                border-radius: 0;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }

        .links {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .links a {
            color: #666;
            text-decoration: none;
            font-size: 0.9em;
            transition: 0.3s;
        }

        .links a:hover {
            color: #a1c4fd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="floating-elements">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" method="POST" action="{{ route('frontend.register') }}">
        @csrf
            <div class="logo">
                <span>REGISTER</span>
            </div>
            <div class="inputBox">
                <input type="text" name="fullname" required="required">
                <span>Fullname</span>
            </div>
            <div class="inputBox">
                <input type="text" name="email" required="required">
                <span>Email</span>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
            </div>
            <div class="inputBox">
                <input type="password" name="password_confirmation" required="required">
                <span>Confirm Password</span>
            </div>
            <button class="enter">CREATE</button>
            <div class="links">
                <a href="#">Forgot Password?</a>
                <a href="{{ route('frontend.login')}}">Sign In</a>
            </div>
        </form>
    </div>

  <script>
    // Add some interactivity
    document.querySelector('.enter').addEventListener('mouseenter', function() {
      document.querySelectorAll('.floating-elements div').forEach(function(bubble) {
        bubble.style.animationDuration = '8s';
      });
    });
    
    document.querySelector('.enter').addEventListener('mouseleave', function() {
      document.querySelectorAll('.floating-elements div').forEach(function(bubble, index) {
        bubble.style.animationDuration = (12 + index) + 's';
      });
    });
  </script>
</body>
</html>            