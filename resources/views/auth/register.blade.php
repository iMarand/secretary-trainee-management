<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SJITC</title>
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

        .register-container {
            
            background: var(--color-card-dark);
            border: 0px solid var(--color-border);
            border-radius: 16px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            transition: all 0.3s;
            position: relative;
            z-index: 1;
        }

        h2 {
            font-size: 2.2em;
            color: var(--color-accent-orange); 
            margin-bottom: 5px;
            text-align: center;
            font-weight: 700;
        }

        .subtitle {
            color: var(--color-text-subtle);
            margin-bottom: 30px;
            text-align: center;
            font-size: 1em;
        }

        
        .form-row {
            display: flex;
            gap: 20px; 
            margin-bottom: 25px; 
        }

        .form-row .form-group {
            flex: 1; 
            margin-bottom: 0; 
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

        
        .input-hint {
            display: block;
            color: var(--color-text-subtle);
            font-size: 0.75em; 
            margin-top: 4px;
            opacity: 0.8;
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

        .error-text {
            color: var(--color-error);
            font-size: 0.85em;
            display: block;
            margin-top: 5px;
        }

        .btn-register {
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
            margin-top: 5px; 
        }

        .btn-register:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.95em;
            color: var(--color-text-subtle);
        }

        .login-link a {
            color: var(--color-accent-orange); 
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: #FFC107;
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .register-container {
                padding: 30px;
                max-width: 100%;
            }
        }

        
        @media (max-width: 550px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            .form-row .form-group {
                margin-bottom: 25px; 
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create Account</h2>
        <p class="subtitle">Register as a new secretary for the Trainees Registration Management System</p>

        
        <div id="client-error-box" class="validation-message" style="display: none;"></div>

        <form action="{{ route('register.post') }}" method="POST" onsubmit="return validateRegister()">
            @csrf
            
            
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">Full Name <span class="input-hint">(Your legal first and last name)</span></label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">Username <span class="input-hint">(Unique identifier for login)</span></label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email" style="display: flex;">Email Address <span class="input-hint" style="margin-left: 5px">(Your official work email address)</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row" style="margin-top: 10px;">
                <div class="form-group">
                    <label for="password">Password <span class="input-hint">(Minimum 6 characters for security)</span></label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password <span class="input-hint">(Must match the password above)</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login.form') }}">Login here</a>
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

        function validateRegister() {
            // Hide previous client-side errors
            document.getElementById('client-error-box').style.display = 'none';

            const fullName = document.getElementById('full_name').value.trim();
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (fullName === '' || fullName.length < 3) {
                showClientError('Full name must be at least 3 characters.');
                return false;
            }

            if (username === '' || username.length < 4) {
                showClientError('Username must be at least 4 characters.');
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showClientError('Please enter a valid email address.');
                return false;
            }

            if (password.length < 6) {
                showClientError('Password must be at least 6 characters.');
                return false;
            }

            if (password !== confirmPassword) {
                showClientError('Passwords do not match.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>