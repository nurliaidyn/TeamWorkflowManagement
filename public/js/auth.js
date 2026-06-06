// auth.js
document.addEventListener("DOMContentLoaded", () => {
    
    // --- 1. FORM TOGGLING LOGIC ---
    const toggleLinks = document.querySelectorAll(".toggle-form");
    const forms = document.querySelectorAll(".auth-form");
    const subtitle = document.getElementById("auth-subtitle");

    const subtitles = {
        "login-form": "Sign in to your workspace",
        "register-form": "Join the development team",
        "reset-form": "Recover your account access"
    };

    toggleLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const targetId = link.getAttribute("data-target");
            forms.forEach(form => {
                form.classList.remove("active");
                form.classList.remove("was-validated"); // Clear validation states on switch
                form.reset(); // Clear inputs on switch
            });
            document.getElementById(targetId).classList.add("active");
            subtitle.innerText = subtitles[targetId];
        });
    });

    // --- 2. PASSWORD VISIBILITY TOGGLE ---
    const togglePasswordBtns = document.querySelectorAll(".toggle-password");
    togglePasswordBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            // Find the input right next to this button
            const input = btn.previousElementSibling;
            const icon = btn.querySelector("i");
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        });
    });

    // --- 3. VALIDATION & LOADING STATE ---
    const needsValidationForms = document.querySelectorAll('.needs-validation');
    
    needsValidationForms.forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault(); // Stop normal submission
            
            // Check Bootstrap validation
            if (!form.checkValidity()) {
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            // If valid, show loading state
            const btn = form.querySelector('.submit-btn');
            const btnText = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.spinner-border');
            
            btnText.classList.add('d-none');
            spinner.classList.remove('d-none');
            btn.disabled = true;

            // FUTURE PHP: Here is where you will send data via fetch() or standard POST.
            // For now, we simulate a network request delay, then redirect.
            setTimeout(() => {
                if(form.id === 'login-form') {
                    window.location.href = "index.html"; // Go to dashboard
                } else {
                    // Reset loading state for demo
                    btnText.classList.remove('d-none');
                    spinner.classList.add('d-none');
                    btn.disabled = false;
                    alert("Action successful! (Simulated)");
                }
            }, 1000);
        });
    });
});