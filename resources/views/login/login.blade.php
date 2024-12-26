<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Gaming</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background: url('https://www.wallpapertip.com/wmimgs/6-67303_gaming-wallpaper-hd-free-download.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Russo One', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .login-left {
            flex: 1;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
        }

        .login-left h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            animation: bounceInDown 1s ease-out;
        }

        .login-left p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .login-form {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease-out;
        }

        .login-card h4 {
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
            font-size: 1.8rem;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 12px;
            border: 2px solid #00d4ff;
            margin-bottom: 20px;
            color: #fff;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border: 2px solid #ff6600;
            box-shadow: 0 0 10px rgba(255, 102, 0, 0.8);
        }

        .btn-primary {
            background-color: #ff6600;
            border-color: #ff6600;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #00d4ff;
            border-color: #00d4ff;
            transform: scale(1.1);
        }

        .error-message {
            color: #ff3b30;
            font-size: 0.875rem;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        @keyframes bounceInDown {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            60% {
                transform: translateY(30px);
                opacity: 1;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            0% {
                transform: translateY(50px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left {
                text-align: center;
                padding: 40px;
            }

            .login-form {
                padding: 20px;
            }
        }
        .form-control:focus {
            color: #fff;
        }
         
        .input-group i {
            position: absolute;
            top: 38%;
            right: 24px;
            transform: translateY(-50%); 
            cursor: pointer;
        }
        .form-control.is-invalid ~ i {
            top: 29%;
            right: 33px;
        }
        .input-group input::placeholder {
            color: #d3d3d3;
        }
        .form-control::placeholder {
            color: #d3d3d3; 
        }
        .input-group>.form-control{
            width: 100%;
        }
        #password-error{
            padding-left: 12% !important;
            padding-right: 12% !important;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-left">
            <h2>Join Us and Level Up!</h2>
            <p>Sign up now and start your epic gaming journey!</p>
            {{-- <img src="{{ asset('storage/images/login/register.jpg') }}" alt="Register Image" class="img-fluid rounded-circle shadow-lg" style="max-width: 60%; height: auto;" /> --}}
        </div>

        <div class="login-form">
            <div class="login-card">
                <h4>Login</h4>
                <form method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" autofocus>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="Enter your password">
                            <i id="toggle-password" class="fas fa-eye-slash"></i>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary mb-4">Login</button>
                        
                        <a href="{{route('register-view')}}" class="btn btn-info">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('toggle-password');
    
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $("form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Please enter a password.",
                        minlength: "Password must be at least 8 characters long."
                    }
                },
                errorElement: 'div',
                errorClass: 'error-message',
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

</body>
</html>
