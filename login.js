document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const messageDiv = document.getElementById('message');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        // Show the processing message
        messageDiv.innerHTML = '<div class="text-blue-500"><i class="fas fa-spinner fa-spin mr-2"></i>Processing...</div>';

        fetch('login.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = '<div class="text-green-500"><i class="fas fa-check-circle mr-2"></i>' + data.message + '</div>';
                form.reset();  // Reset the form on success
                // Redirect or perform other actions on successful login
                window.location.href = 'dashboard.php';
            } else {
                messageDiv.innerHTML = '<div class="text-red-500"><i class="fas fa-exclamation-circle mr-2"></i>' + data.message + '</div>';
            }
        })
        .catch(() => {
            messageDiv.innerHTML = '<div class="text-red-500"><i class="fas fa-exclamation-triangle mr-2"></i>An error occurred. Please try again.</div>';
        });
    });
});

