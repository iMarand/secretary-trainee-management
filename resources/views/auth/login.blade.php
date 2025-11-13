<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary Login - SJITC</title>
    <style>
        :root {
           
            --color-bg-dark: #121217;       
            --color-card-dark: #1E1E28;     
            --color-text-light: #E0E0E0;    
            --color-text-subtle: #999999;   
            --color-accent-primary: #de5900ff; 
            --color-accent-orange: #FFA726; 
            --color-accent-secondary: #0FDB81; 
            --color-border: #3A3A4A;        
            --color-error: #FF5252;         
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif; 
            background: var(--color-bg-dark);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: var(--color-text-light);
            transition: background 0.3s;
            position: relative; 
            overflow: hidden; 
        }

        .input-hint {
            display: block;
            color: var(--color-text-subtle);
            font-size: 0.75em; 
            margin-top: 4px;
            opacity: 0.8;
        }

        
        body::before, body::after {
            content: '';
            position: absolute;
            background-color: var(--color-accent-orange); 
            border-radius: 50%;
            filter: blur(80px); 
            opacity: 0.05; 
            z-index: 0;
        }

        body::before {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
        }

        body::after {
            width: 250px;
            height: 250px;
            bottom: -80px;
            right: -80px;
        }

        .login-container {
            
            background: var(--color-card-dark);
            border: 0px solid var(--color-border);
            border-radius: 16px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            max-width: 450px; 
            width: 100%;
            padding: 40px;
            transition: all 0.3s;
            position: relative; 
            z-index: 1;
        }

        .header-content {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--color-border);
        }

        .header-content h1 {
            font-size: 2.2em;
            color: var(--color-accent-orange); 
            margin-bottom: 5px;
            font-weight: 700;
        }

        .header-content h2 {
            font-size: 1.2em;
            color: var(--color-text-light);
            margin-bottom: 10px;
            font-weight: 500;
        }
        
        .header-content p {
            font-size: 0.9em;
            color: var(--color-text-subtle);
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: var(--color-text-light);
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.9em;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            background: var(--color-bg-dark); 
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-size: 1em;
            color: var(--color-text-light);
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--color-accent-primary); 
            box-shadow: 0 0 0 1px var(--color-accent-primary);
        }

        
        .error-message, .validation-message {
            background: rgba(255, 82, 82, 0.1); 
            color: var(--color-error);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--color-error);
            font-size: 0.9em;
        }

        .success-message {
            background: rgba(15, 219, 129, 0.1); 
            color: var(--color-accent-secondary);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--color-accent-secondary);
            font-size: 0.9em;
        }

        .remember-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9em;
        }

        .remember-group input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
            
            appearance: none;
            width: 16px;
            height: 16px;
            border: 1px solid var(--color-border);
            border-radius: 4px;
            background-color: var(--color-bg-dark);
            cursor: pointer;
            transition: all 0.2s;
        }

        .remember-group input[type="checkbox"]:checked {
            background-color: var(--color-accent-primary); 
            border-color: var(--color-accent-primary);
        }

        .remember-group label {
            margin: 0;
            font-weight: normal;
            color: var(--color-text-subtle);
        }
        
        .remember-group label:hover {
            color: var(--color-text-light);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            
            background: linear-gradient(90deg, #eb7600ff 0%, #fa7d00ff 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(250, 167, 0, 0.3);
        }

        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.95em;
            color: var(--color-text-subtle);
        }

        .register-link a {
            color: var(--color-accent-orange); 
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: #FFC107; 
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .login-container {
                padding: 30px;
                max-width: 100%;
            }
            .header-content h1 {
                font-size: 2em;
            }
            body::before, body::after {
                filter: blur(60px); 
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="header-content">
            <h1>SJITC School</h1>
            <h2>Secretary Login</h2>
            <p>Trainees Registration Management System</p>
            <p style="margin-top: 10px;">Enter your credentials to access the system efficiently.</p>
        </div>
        
        <div id="client-error-box" class="validation-message" style="display: none;"></div>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if($errors->has('login_error'))
            <div class="error-message">{{ $errors->first('login_error') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" onsubmit="return validateLogin()">
            @csrf
            
            <div class="form-group">
                <label for="username" style="display: flex; gap: 5px; align-items: center">Username <span class="input-hint">(Provide valid username)</span></label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <span style="color: var(--color-error); font-size: 0.85em; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span style="color: var(--color-error); font-size: 0.85em; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="{{ route('register.form') }}">Register here</a>
        </div>
    </div>

    <script>
        function showClientError(message) {
            const errorBox = document.getElementById('client-error-box');
            errorBox.textContent = message;
            errorBox.style.display = 'block';
            // Auto-hide the message after a few seconds
            setTimeout(() => {
                errorBox.style.display = 'none';
            }, 5000);
        }

        function validateLogin() {
            // Hide previous client-side errors
            document.getElementById('client-error-box').style.display = 'none';

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (username === '') {
                showClientError('Please enter your username');
                return false;
            }

            if (username.length < 4) {
                showClientError('Username must be at least 4 characters');
                return false;
            }

            if (password === '') {
                showClientError('Please enter your password');
                return false;
            }

            if (password.length < 6) {
                showClientError('Password must be at least 6 characters');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>