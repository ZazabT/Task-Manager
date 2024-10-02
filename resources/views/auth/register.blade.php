<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
    
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <!-- Left Side with Image and Text -->
                <div class="col-md-5 side-image">
                    <img src="{{ asset('assets/icon2.png') }}" alt="Logo" class="logo">
                    <div class="text">
                        <p>Streamline Your Security—Effortless Password <i>- Management Awaits!</i></p> 
                    </div>
                </div>

                <!-- Right Side with Form -->
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <!-- Already have an account Link -->
                    <div class="signin mt-3">
                        <span>Already have an account? <a href="{{ route('auth.login.view') }}">Log in here</a></span>
                    </div>
                    <div class="input-box">
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <header>Create Account</header>
                       
                        <!-- Social Login Options -->
                        <div class="social-login mb-3">
                            <button class="btn btn-outline-primary btn-block w-100 mb-2">
                                Sign in with Google
                            </button>
                            <button class="btn btn-outline-primary btn-block w-100">
                                Sign in with Facebook
                            </button>
                        </div>

                        <!-- Divider Line -->
                        <div class="divider text-center my-3">
                            <span>or continue with email</span>
                        </div>

                        <!-- Form for Name, Email, and Password -->

                        <div class="input-field">

                            <form action="{{ route('auth.register.func') }}" method="POST" >
                                @csrf

                                <input type="text" class="input" id="name" name="name"  autocomplete="off">
                                <label for="name">Full Name</label>
                            </div>
                            <div class="input-field">
                                <input type="text" class="input" id="email" name="email"  autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="input" id="password" name="password" >
                                <label for="password">Password</label>
                            </div>
                             
                            <div class="input-field">
                                <input type="password" class="input" id="password_confirmation" name="password_confirmation" >
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                            
                            <div class="input-field">
                                <input type="submit" class="submit" value="Sign Up">
                            </div>
                            </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
