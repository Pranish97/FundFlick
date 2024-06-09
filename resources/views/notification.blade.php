<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </script>
    <link rel="stylesheet" href="css/notification.css">
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
                    <a href="/settings">
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
        <h1>Notifications</h1>
        @if (auth()->user()->notifications->isEmpty())
        <p>No notifications.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->notifications as $notification)
                <tr class="notification-row" data-toggle="modal" data-target="#notificationModal" data-message="@if ($notification->data['type'] === 'debited')
                            Your account has been debited with {{ $notification->data['amount'] }} by
                            {{ $notification->data['other_user'] }}. Remarks: {{ $notification->data['remarks'] }}
                            @else
                            Your account has been credited with {{ $notification->data['amount'] }} by
                            {{ $notification->data['other_user'] }}. Remarks: {{ $notification->data['remarks'] }}
                            @endif" data-date="{{ $notification->created_at->format('d/m/Y') }}">
                    <td>
                        @if ($notification->data['type'] === 'debited')
                        Your account has been debited with {{ $notification->data['amount'] }} by
                        {{ $notification->data['other_user'] }}. Remarks: {{ $notification->data['remarks'] }}
                        @else
                        Your account has been credited with {{ $notification->data['amount'] }} by
                        {{ $notification->data['other_user'] }}. Remarks: {{ $notification->data['remarks'] }}
                        @endif
                    </td>
                    <td>{{ $notification->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

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



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>