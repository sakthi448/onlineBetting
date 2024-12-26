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
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-left">
            <h2>Join Us!</h2>
            <p>Sign up to start your gaming journey!</p>
            {{-- <img src="{{ asset('storage/images/login/register.jpg') }}" alt="Register Image" class="img-fluid rounded-circle shadow-lg" style="max-width: 60%; height: auto;" /> --}}
        </div>

        <div class="login-form">
            <div class="login-card">
                <h4>Create an Account</h4>
                <form method="POST" action="{{ route('register') }}" class="form-01">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age') }}">
                        @error('age')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gaming_experience" class="form-label">Gaming Experience (Years) <span class="text-danger">(optional)</span></label>
                        <input type="number" name="gaming_experience" class="form-control" value="{{ old('gaming_experience') }}">
                        
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary mb-4">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<script>
    $(document).ready(function () {
        $(".form-01").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: '[name="password"]'
                },
                phone: {
                    required: true,
                    minlength: 7,
                    maxlength: 15,
                    digits: true
                },
                age: {
                    required: true,
                    min: 18
                }
            },
            messages: {
                name: {
                    required: "Please enter your name.",
                    minlength: "Your name must be at least 3 characters long."
                },
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address."
                },
                password: {
                    required: "Please enter a password.",
                    minlength: "Password must be at least 8 characters long."
                },
                password_confirmation: {
                    required: "Please confirm your password.",
                    equalTo: "Passwords do not match."
                },
                phone: {
                    required: "Please enter your phone number.",
                    minlength: "Phone number must be at least 7 digits long.",
                    maxlength: "Phone number must not exceed 15 digits.",
                    digits: "Please enter only digits."
                },
                age: {
                    required: "Please enter your age.",
                    min: "You must be at least 18 years old."
                }
            },
            errorElement: 'div',
            errorClass: 'text-danger mt-1',
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