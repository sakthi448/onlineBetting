<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-buttons-bs5@2.2.0/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-buttons@2.2.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jszip@3.1.3/dist/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.53/build/pdfmake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.53/build/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-buttons@2.2.0/js/buttons.html5.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body{
            background-color: whitesmoke;
        }
        .btn01 {
            margin-right: 1%;
        }

        .filter-container {
            display: none;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .filter-container input,
        .filter-container select {
            margin-right: 10px;
        }

        .filter-container .col-3 {
            margin-bottom: 10px;
        }

        .btn-container {
            margin-top: 10px;
        }

        .logout-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .logout-container button {
            padding: 10px 20px;
            font-size: 16px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .card {
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        .filter-btn {
            background-color: #007bff;
            color: white;
        }

        .filter-btn:hover {
            background-color: #0056b3;
        }
        .select2-container {
            width: 100% !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <div class="card">
            <h1>Admin Dashboard</h1>

            <button class="btn btn-primary filter-btn mb-3" id="filterBtn" style="width: 11%;">Filters</button>

            <div class="filter-container row">
                <div class="col-3">
                    <input type="text" id="filterName" class="form-control" placeholder="Filter by Name">
                </div>
                <div class="col-3">
                    <input type="email" id="filterEmail" class="form-control" placeholder="Filter by Email">
                </div>
                <div class="col-3">
                    <select id="filterBonusStatus" class="form-control">
                        <option value="">Filter by Bonus Status</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-3 btn-container">
                    <button class="btn btn-success" id="applyFilter">Apply Filter</button>
                    <button class="btn btn-secondary" id="resetFilter">Reset Filters</button>
                </div>
            </div>

            <div class="table-container">
                <table id="usersTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Bonus Status</th>
                            <th>Total Amount (Wallet)</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#filterBtn').on('click', function() {
                $('.filter-container').toggle();
            });

            var table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.users.data") }}',
                    data: function(d) {
                        d.name = $('#filterName').val();
                        d.email = $('#filterEmail').val();
                        d.bonus_status = $('#filterBonusStatus').val();
                    }
                },
                columns: [
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'bonus_status' },
                    { data: 'wallet' }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        className: 'btn btn-secondary btn01'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        className: 'btn btn-secondary'
                    }
                ]
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();
            });

            $('#resetFilter').on('click', function() {
                $('#filterName').val('');
                $('#filterEmail').val('');
                $('#filterBonusStatus').val('').trigger('change');
                
                table.ajax.reload();
            });
        });
    </script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#filterBonusStatus').select2();
    });
</script>
</body>
</html>
