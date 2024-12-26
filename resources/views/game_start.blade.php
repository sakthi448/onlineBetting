<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Start</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        body {
            /* background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d); */
            background: linear-gradient(135deg, #b5b7c1, #659c69, #deb358e6);
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        h1{
            font-family: fantasy;
        }

        .container {
            width: 80%;
            max-width: 700px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .card {
            background-color: #2e2e2e;
            border: none;
            border-radius: 10px;
            margin: 20px 0;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .color-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .color-option {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .color-option:hover {
            transform: rotateY(360deg);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.4);
        }

        .color-option input[type="radio"] {
            display: none;
        }

        .color-option.red { 
            background-color: red;
        }
        .color-option.green {
            background-color: green;
        }
        .color-option.blue {
            background-color: blue;
        }
        .color-option.orange {
            background-color: orange;
        }
        .color-option.yellow {
            background-color: yellow; 
        }
        .color-option.lightblue { 
            background-color: lightblue;
        }
        .color-option.purple { 
            background-color: purple;
        }

        .alert {
            background-color: #ff7043;
            color: white;
        }

        .btn-primary, .btn-success, .btn-danger {
            width: 100%;
            padding: 12px;
            font-size: 1.2rem;
            border-radius: 10px;
            transition: transform 0.3s ease, background-color 0.3s;
        }

        .btn-primary:hover, .btn-success:hover, .btn-danger:hover {
            transform: scale(1.1);
            background-color: #ff5722;
        }

        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
            z-index: 9999;
        }

        .spinner-border {
            margin-right: 15px;
        }

        @keyframes spin3D {
            0% {
                transform: rotateY(0deg);
            }
            50% {
                transform: rotateY(180deg);
            }
            100% {
                transform: rotateY(360deg);
            }
        }

        .loader-spinner {
            animation: spin3D 2s infinite linear;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Game Start</h1>

        <div class="card">
            <h5 class="card-title">Wallet Balance</h5>
            <p>₹{{ auth()->user()->total_amount }}</p>
        </div>

        <div class="color-container">
            <div class="color-option red">
                <input type="radio" name="color" value="100" class="color_name" id="redColor">
                <label for="redColor">Red</label>
            </div>

            <div class="color-option green">
                <input type="radio" name="color" value="200" class="color_name" id="greenColor">
                <label for="greenColor">Green</label>
            </div>

            <div class="color-option blue">
                <input type="radio" name="color" value="100" class="color_name" id="blueColor">
                <label for="blueColor">Blue</label>
            </div>
        </div>

        <div class="alert alert-warning">
            <strong>Entry Fee:</strong> ₹100
        </div>

        <button class="btn btn-success" id="startLoader">Start Game</button>

        <div id="loader">
            <div class="spinner-border loader-spinner" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div id="countdownTimer"></div>
        </div>

        <h4 class="success_message" style="color: aqua"></h4>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Logout</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
    $("input[name='color']").on('change', function () {
        var color = $(this).val();
        Swal.fire({
            title: 'Color Selected!',
            text: 'You have selected this color',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });

    $('#startLoader').on('click', function () {
        var selectedColor = $("input[name='color']:checked").val();
        var total_amount = "{{ auth()->user()->total_amount }}";

        if (!selectedColor) {
            alert("Please select a color!");
            return;
        }

        if (total_amount < 100) {
            alert("You don't have enough balance to play the game!");
            return;
        }

        Swal.fire({
            title: 'Confirm Game Entry',
            text: 'Your entry fee of ₹100 will be deducted from your balance.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Start Game',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('game.entrance.store') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        selectedColor: selectedColor,
                        total_amount: total_amount,
                        entry_amount: 100
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            startLoader(10, response);
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            }
        });
    });

    function startLoader(seconds, response) {
        $('#loader').show();

        var remainingTime = seconds;

        var countdownInterval = setInterval(function () {
            $('#countdownTimer').text('Time Remaining: ' + remainingTime + ' seconds');
            remainingTime--;

            if (remainingTime < 0) {
                clearInterval(countdownInterval);
                $('#loader').hide();
                $('.success_message').html(response.message);

                setTimeout(() => {
                    window.location.reload();
                }, 5000);
            }
        }, 1000);
    }
});

    </script>
    {{-- <script>
        $(document).ready(function () {
            $("input[name='color']").on('change', function () {
                var color = $(this).val();
                Swal.fire({
                    title: 'Color Selected!',
                    text: `You have selected this color`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });

            $('#startLoader').on('click', function () {
                var selectedColor = $("input[name='color']:checked").val();
                var total_amount = "{{ auth()->user()->total_amount }}";

                if (!selectedColor) {
                    alert("Please select a color!");
                    return;
                }

                $.ajax({
                    url: "{{ route('game.entrance.store') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        selectedColor: selectedColor,
                        total_amount: total_amount,
                        entry_amount: 100
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            startLoader(10, response);
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            });

            function startLoader(seconds, response) {
                $('#loader').show();

                var remainingTime = seconds;

                var countdownInterval = setInterval(function () {
                    $('#countdownTimer').text('Time Remaining: ' + remainingTime + ' seconds');
                    remainingTime--;

                    if (remainingTime < 0) {
                        clearInterval(countdownInterval);
                        $('#loader').hide();
                        $('.success_message').html(response.message);

                        setTimeout(() => {
                            window.location.reload();
                        }, 5000);
                    }
                }, 1000);
            }
        });
    </script> --}}

</body>
</html>
