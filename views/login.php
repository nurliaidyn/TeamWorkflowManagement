<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Login - Project Alpha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #11111b; height: 100vh; display: flex; align-items: center; justify-content: center; }</style>
</head>
<body class="text-light">
    <div class="container" style="max-width: 400px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Project Alpha</h2>
            <p class="text-secondary">Sign in to your workspace</p>
        </div>
        
        <?php if(isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
            <div class="alert alert-danger py-2 text-center small border-danger bg-danger bg-opacity-10 text-danger">Invalid email or password.</div>
        <?php endif; ?>

        <div class="card bg-secondary bg-opacity-10 border-secondary shadow-lg">
            <div class="card-body p-4">
                <form action="controllers/auth_process.php" method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Email</label>
                        <input type="email" name="email" class="form-control bg-dark border-secondary text-light" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Password</label>
                        <div class="input-group">
                            <input type="password" id="passwordInput" name="password" class="form-control bg-dark border-secondary text-light" required>
                            <button class="btn btn-outline-secondary border-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold mb-3">Sign In</button>
                    <div class="text-center small">
                        <span class="text-secondary">Don't have an account?</span> 
                        <a href="index.php?page=register" class="text-primary text-decoration-none fw-bold">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');

            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function () {
                    // Toggle the type attribute
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle the icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                });
            }
        });
    </script>
</body>
</html>