<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Product Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        body { background-color: #f8fafc; color: #0f172a; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card { width: 100%; max-width: 400px; background: #ffffff; padding: 36px 32px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0; }
        .login-header { margin-bottom: 28px; text-align: center; }
        .login-header h2 { color: #0f172a; font-size: 22px; font-weight: 700; letter-spacing: -0.02em; margin-bottom: 6px; }
        .login-header p { font-size: 13px; color: #64748b; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.03em; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #0f172a; background-color: #ffffff; }
        input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        .error-alert { background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 18px; text-align: center; }
        .btn-submit { width: 100%; padding: 11px; background-color: #2563eb; color: #ffffff; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background-color 0.2s; margin-top: 6px; }
        .btn-submit:hover { background-color: #1d4ed8; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <h2>Account Login</h2>
        <p>Enter your credentials to access the system</p>
    </div>

    <?php if(!empty($error)): ?>
        <div class="error-alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required placeholder="Enter username">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter password">
        </div>

        <button type="submit" class="btn-submit">Sign In</button>
    </form>
</div>

</body>
</html>