<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Helpdesk System | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="system-login">
    <div class="system-login-card">

        <div class="system-login-title">
            HELPDESK SYSTEM
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                @foreach ($errors->all() as $error)
                    <small>{{ $error }}</small>
                @endforeach
            </div>
        @endif

        <form action="login/auth" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter username" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                LOGIN
            </button>
        </form>
    </div>
</body>

</html>