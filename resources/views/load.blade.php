<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </script>
    <link rel="stylesheet" href="css/load.css">
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
                        <a href="/load">
                            <i class='bx bx-wallet-alt icon'></i>
                            <span class="text nav-text">Load Fund</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/notification">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notification</span>
                            @php
                            $unreadCount = auth()->user()->unreadNotifications->count();
                            @endphp
                            @if($unreadCount > 0)
                            <span class="badge badge-pill badge-danger">{{ $unreadCount }}</span>
                            @endif
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
        <h1>Load Money</h1>
        <form action="{{ route('loadFromBank') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-2">
                <label for="bank_name">Bank Name</label>
                <select id="bank_name" class="select" name="bank_name">
                    <option value="">Select Bank</option>
                    <option value="Siddhartha Bank">Siddhartha Bank</option>
                </select>
                <div class="error"></div>
            </div>
            <div class="mb-2">
                <label class="userText">User Id </label>
                <input type="text" id="user_id" class="user_id" name="user_id" onclick="changeStyleUser()" onkeyup="onKeyUpUser()" />
                <div class="error"></div>
            </div>
            <div class="mb-2">
                <label class="amountText">Amount</label>
                <input type="number" class="amount" id="amount" name="amount" onclick="changeStyleAmount()" onkeyup="onKeyUpAmount()">
                <div class="error"></div>
            </div>
            <div class="mb-2">
                <label class="pinText">Pin</label>
                <input type="number" class="pin" id="pin" name="pin" onclick="changeStylePin()" onkeyup="onKeyUpPin()">
                <div class="error"></div>
            </div>
            <button type="submit" class="loadButton">Load Money</button>
        </form>
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

    @if(Session::has('error'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.error("{{ session('error') }}")
    </script>
    @endif
</body>

</html>