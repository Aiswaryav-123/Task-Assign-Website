<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task Management System</title>
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f4f6f9;
            --primary-blue: #0d6efd;
            --primary-blue-hover: #0b5ed7;
            --border-color: #dee2e6;
            --text-dark: #212529;
            --text-muted: #6c757d;
            --danger-color: #dc3545;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-top: 5px solid var(--primary-blue);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
            padding: 2rem;
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .login-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.35rem;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c2c7;
            color: #842029;
            padding: 0.75rem 1rem;
            border-radius: 4px;
            margin-bottom: 1.25rem;
            font-size: 0.85rem;
        }

        .alert-success {
            background: #d1e7dd;
            border: 1px solid #badbcc;
            color: #0f5132;
            padding: 0.75rem 1rem;
            border-radius: 4px;
            margin-bottom: 1.25rem;
            font-size: 0.85rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
        }

        .input-control {
            width: 100%;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 0.65rem 0.85rem;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .input-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }

        .btn-submit {
            width: 100%;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.75rem;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            background: var(--primary-blue-hover);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <h2>Task Manager</h2>
            <p>Please sign in to continue</p>
        </div>

        @if(session('status'))
            <div class="alert-success">✓ {{ session('status') }}</div>
        @endif

        @if($errors->has('email'))
            <div class="alert-error">⚠️ {{ $errors->first('email') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST" id="login-form">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="input-control" value="{{ old('email') }}"
                    placeholder="name@example.com" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="input-control" placeholder="••••••••"
                    required>
            </div>

            <button type="submit" class="btn-submit" id="login-submit-btn">Login</button>
        </form>
    </div>
</body>

</html>