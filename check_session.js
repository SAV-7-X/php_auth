   // Function to check session status
   function checkSession() {
    fetch('check_session.php')
        .then(response => response.json())
        .then(data => {
            if (data.authenticated) {
                // If user is authenticated, redirect to dashboard
                console.log('Session active');
                window.location.href = 'dashboard.php';
            }
        })
        .catch(error => {
            console.error('Error checking session:', error);
        });
}

// Check session on page load
document.addEventListener('DOMContentLoaded', checkSession);

// Listen for the popstate event (triggered by the back button)
window.addEventListener('popstate', checkSession);