<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication - Project Alpha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/public/css/auth.css">
</head>
<body class="bg-dark text-light d-flex align-items-center justify-content-center vh-100">

    <div class="container" style="max-width: 450px;">
        <div class="card bg-secondary bg-opacity-10 border-secondary shadow-lg auth-card">
            <div class="card-body p-4 p-md-5">
                
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-braces fs-3"></i>
                    </div>
                    <h2 class="fw-bold">Project Alpha</h2>
                    <p class="text-secondary" id="auth-subtitle">Sign in to your workspace</p>
                </div>

                <form id="login-form" class="auth-form active needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label text-secondary small text-uppercase fw-bold">Email address</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control bg-dark text-light border-secondary" id="loginEmail" placeholder="name@company.com" required>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label for="loginPassword" class="form-label text-secondary small text-uppercase fw-bold">Password</label>
                            <a href="#" class="text-decoration-none text-primary small toggle-form" data-target="reset-form">Forgot?</a>
                        </div>
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control bg-dark text-light border-secondary password-input" id="loginPassword" required>
                            <button class="btn btn-outline-secondary border-secondary toggle-password" type="button"><i class="bi bi-eye"></i></button>
                            <div class="invalid-feedback">Password is required.</div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mb-3 fw-semibold submit-btn">
                        <span class="btn-text">Sign In</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    
                    <div class="text-center mt-3">
                        <span class="text-secondary small">Don't have an account? </span>
                        <a href="#" class="text-decoration-none text-primary small toggle-form" data-target="register-form">Create one</a>
                    </div>
                </form>

                <form id="register-form" class="auth-form needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="regName" class="form-label text-secondary small text-uppercase fw-bold">Full Name</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control bg-dark text-light border-secondary" id="regName" placeholder="John Doe" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="regEmail" class="form-label text-secondary small text-uppercase fw-bold">Email</label>
                        <input type="email" class="form-control bg-dark text-light border-secondary" id="regEmail" required>
                    </div>
                    <div class="mb-4">
                        <label for="regPassword" class="form-label text-secondary small text-uppercase fw-bold">Password</label>
                        <div class="input-group has-validation">
                            <input type="password" class="form-control bg-dark text-light border-secondary password-input" id="regPassword" required minlength="8">
                            <button class="btn btn-outline-secondary border-secondary toggle-password" type="button"><i class="bi bi-eye"></i></button>
                            <div class="invalid-feedback">Must be at least 8 characters.</div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 mb-3 fw-semibold submit-btn">
                        <span class="btn-text">Create Account</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    
                    <div class="text-center mt-3">
                        <span class="text-secondary small">Already have an account? </span>
                        <a href="#" class="text-decoration-none text-primary small toggle-form" data-target="login-form">Sign In</a>
                    </div>
                </form>

                <form id="reset-form" class="auth-form needs-validation" novalidate>
                    <p class="text-secondary small mb-4 text-center">Enter your email and we'll send a recovery link.</p>
                    <div class="mb-4">
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control bg-dark text-light border-secondary" id="resetEmail" placeholder="name@company.com" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning text-dark w-100 mb-3 fw-semibold submit-btn">
                        <span class="btn-text">Send Link</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none text-secondary small toggle-form" data-target="login-form"><i class="bi bi-arrow-left"></i> Back to Sign In</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/auth.js"></script>
</body>
</html>