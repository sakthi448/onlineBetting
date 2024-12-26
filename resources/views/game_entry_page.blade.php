<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Game</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            /* background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d); */
            background: linear-gradient(135deg, #b5b7c1, #659c69, #deb358e6);
            font-family: 'Arial', sans-serif;
            color: #f5f5f5;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-attachment: fixed;
        }

        .container {
            background: rgba(0, 0, 0, 0.75);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 700px;
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            color: #ff4081;
            text-shadow: 0 0 10px #ff4081, 0 0 20px #ff4081;
        }

        .alert {
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px;
        }

        .alert-info {
            background-color: #1e2a38;
            color: #a4e7ff;
        }

        .alert-warning {
            background-color: #f39200;
            color: #fff;
        }

        .game-card {
            background: #282828;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            margin-top: 20px;
            transition: transform 0.3s ease;
        }

        .game-card:hover {
            transform: scale(1.05);
        }

        .game-card h2 {
            font-size: 2rem;
            color: #ff6600;
            margin-bottom: 20px;
            text-shadow: 0 0 8px #ff6600, 0 0 20px #ff6600;
        }

        .btn {
            background-color: #ff4081;
            border: none;
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .btn:hover {
            background-color: #ff5b89;
            transform: scale(1.1);
        }

        .btn:disabled {
            background-color: #b0b0b0;
            cursor: not-allowed;
        }

        .neon-border {
            border: 2px solid #00f9ff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px 2px #00f9ff;
        }

        .neon-text {
            color: #00f9ff;
            text-shadow: 0 0 10px #00f9ff, 0 0 20px #00f9ff;
        }

        .modal-header {
            background-color: #1e2a38;
            color: #fff;
            border-bottom: 1px solid #333;
        }

        .modal-body {
            background-color: #282828;
            color: #fff;
        }

        .form-label {
            color: #fff;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .container {
                padding: 20px;
            }

            .game-card {
                padding: 20px;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        .btn-pulse {
            animation: pulse 1.5s infinite;
        }

        .spinner-border {
            width: 2rem;
            height: 2rem;
            border-width: 0.3em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="neon-text">Welcome, {{ Auth::user()->name }}!</h1>

        @isset($wallet)
            <div class="alert alert-info">
                <strong>Wallet Balance:</strong> ₹{{ Auth::user()->total_amount }}
            </div>
        @else
            <div class="alert alert-warning">
                <strong>No wallet found for this user.</strong>
            </div>
        @endisset

        <div class="game-card">
            <h2>Collect Your Bonus</h2>
            <p>Claim ₹500 to get started with your game.</p>
         
            <form action="{{ route('wallet.add') }}" method="POST" id="bonusForm">
                @csrf
                @if(Auth::user()->bonus_status == 1)
                    <button type="button" class="btn btn-secondary w-100" disabled>Bonus Already Collected</button>
                @else
                    <button type="button" class="btn neon-border btn-pulse" id="collectBonusBtn">Collect Bonus (₹500)</button>
                @endif
            </form>
        </div>

        <button type="button" class="btn btn-primary mb-2" id="addWalletBtn">Add Wallet</button>

        <div class="modal fade" id="walletModal" tabindex="-1" aria-labelledby="walletModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h01" id="walletModalLabel">Enter Wallet Amount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="walletForm">
                            @csrf
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="total_amount">
                                <div id="amountError" class="text-danger mt-2" style="display:none;">Please enter a valid amount.</div>
                            </div>
                            <button type="submit" class="btn btn-success" id="submitWallet">Add Amount</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user()->total_amount > 0)
            <form action="{{ route('game.start') }}" method="GET">
                <button type="submit" class="btn btn-success">Start Game</button>
            </form>
        @else
            <button type="button" class="btn btn-danger" disabled>Insufficient Balance to Start Game</button>
        @endif
    </div>

    <script>
        $(document).ready(function () {
            $('#collectBonusBtn').on('click', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("wallet.add") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Congratulations!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else if (response.status === 'error') {
                            Swal.fire({
                                icon: 'info',
                                title: 'You Already Got the Bonus!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong. Please try again later.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $('#addWalletBtn').on('click', function () {
                $('#walletModal').modal('show');
            });

            $('#walletForm').on('submit', function (e) {
                e.preventDefault();

                var amount = $('#amount').val();

                if (amount <= 0) {
                    $('#amountError').show();
                    return;
                }

                $('#amountError').hide();

                $.ajax({
                    url: '{{ route("wallet.addAmount") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        amount: amount
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Amount Added Successfully!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#walletModal').modal('hide');
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong. Please try again later.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
