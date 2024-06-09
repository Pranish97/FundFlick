<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </script>
    <link rel="stylesheet" href="/css/editProfile.css">
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
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="user-info">
                <h2 class="edit">Edit Profile</h2>
                <p class="name">Username:</p>
                <input class="user_name" name="name" type="text" value="{{$user->name}}" />

                <p class="email">Email:</p>
                <input class="user_email" name="email" type="email" value="{{$user->email}}" />

                <p class="phone">Phone Number:</p>
                <input class="user_phone" name="phone_number" value="{{$user->phone_number}}" />
                <button class="update">Update</button>
            </div>
        </form>

    </div>
</body>

</html>