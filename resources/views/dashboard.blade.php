<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </script>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Welcome to FundFlick</title>
</head>

<body>
    <nav class="navbar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/images/money.png" alt="logo" />
                </span>
                <div class="text header-text">
                    <span class="name">FundFlick.io</span>
                </div>
            </div>

        </header>
        <div class="menu-bar">
            <div class="menu">

                <p class="menu-text">Menu</p>
                <ul class="menu-links">
                    <li class="nav-link">

                        <a href="/dashboard">
                            <i class='bx bx-home icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/football">
                            <i class='bx bx-transfer-alt icon'></i>
                            <span class="text nav-text">Transaction</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/football">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notification</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        @if(auth()->check() && auth()->user()->role == 'Admin')
                        <a href="{{ route('data.manage') }}">
                            <i class='bx bx-data icon'></i>
                            <span class="text nav-text">Manage Data</span>
                        </a>
                        @endif
                    </li>

                </ul>
            </div>
            <div class="bottom-content">
                <li>
                    <a href="/profile">
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="/profile">
                        <i class='bx bx-cog icon'></i>
                        <span class="text nav-text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="/logout">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Welcome Back!</h1>
        <p>Check Your Account latest updated here</p>
        <div style="width:870px; margin-left:260px; height:500px;">
            <canvas id="areaChart"></canvas>
        </div>
        <div class="transaction-box">
            <h2>Recent Transaction</h2>
            <table>
                <thead>
                    <tr>
                        <th>Last Transaction</th>
                        <th>Time</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funds as $fund)
                    <tr>
                        <td><b>{{ $fund->receiver ? $fund->receiver->name : 'N/A' }}</b><br><br>
                            {{$fund['remarks']}}
                        </td>
                        <td>{{$fund['amount_updated_time']}}</td>
                        <td>@if ($fund['amount_type'] === 'credited')
                            +
                            @else
                            -
                            @endif
                            <b>MRP</b> {{ $fund['amount'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="left-box">
        <p>Hello, {{ $users->name }}!</p>
        <div class="amount">
            <img src="images/nepal.png" class="nepal">
            <span id="amount-text-{{ $users->id }}" data-amount="{{ $users->user_amount }}">{{ $users->user_amount }}</span>
            <img src="images/eye-open.png" class="eye-icon" id="eye-icon-{{ $users->id }}" onclick="toggleVisibility({{ $users->id }})">
        </div>
        <div class="quick-transfer">
            <h2>Quick Transfer</h2>
            <form action="{{ route('transfer.perform') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label class="userText">Username </label>
                    <input type="text" id="name" class="username" name="name" onclick="changeStyleUser()" onkeyup="onKeyUpUser()" />
                    <div class="error"></div>
                </div>
                <div class="mb-2">
                    <label class="amountText">Amount </label>
                    <input type="text" id="amount-box" class="amount-box" name="amount" onclick="changeStyleAmount()" onkeyup="onKeyUpAmount()" value="0.00" />
                    <div class="error"></div>
                </div>
                <div class="mb-2">
                    <label class="remarkText">Remarks</label>
                    <input type="text" id="remarks" class="remarks" name="remarks" onclick="changeStyleRemarks()" onkeyup="onKeyUpRemarks()" />
                    <div class="error"></div>
                </div>
                <button type="submit" class="send">Send Money</button>
            </form>
        </div>
    </div>
    </div>
    @if(Session::has('success'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.success("{{ session('success') }}")
    </script>
    @endif

    @if(Session::has('amount'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.error("{{ session('amount') }}")
    </script>
    @endif

    <script>
        function toggleVisibility(id) {
            const amountElement = document.getElementById('amount-text-' + id);
            const eyeIcon = document.getElementById('eye-icon-' + id);
            const actualAmount = amountElement.getAttribute('data-amount');
            if (amountElement.textContent.trim() === 'XXX') {
                amountElement.textContent = actualAmount;
                eyeIcon.src = 'images/eye-open.png';
            } else {
                amountElement.textContent = 'XXX';
                eyeIcon.src = 'images/cross-eye.png';
            }
        }

        function changeStyleUser() {
            var usernameInput = document.getElementById('name');
            usernameInput.classList.add('clicked-style');
        }

        function onKeyUpUser() {
            var usernameInput = document.getElementById('name');
            usernameInput.classList.add('clicked-style');
        }

        function changeStyleAmount() {
            var amountInput = document.getElementById('amount-box');
            amountInput.classList.add('clicked-style');
        }

        function onKeyUpAmount() {
            var amountInput = document.getElementById('amount-box');
            amountInput.classList.add('clicked-style');
        }

        function changeStyleRemarks() {
            var remarkInput = document.getElementById('remarks');
            remarkInput.classList.add('clicked-style');
        }

        function onKeyUpRemarks() {
            var remarkInput = document.getElementById('remarks');
            remarkInput.classList.add('clicked-style');
        }




        // Graph
        var ctx = document.getElementById('areaChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($data['data']),
                datasets: [{
                    label: 'User Amounts',
                    data: @json($data['labels']),
                    backgroundColor: 'rgba(199, 151, 202, 0.4)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>