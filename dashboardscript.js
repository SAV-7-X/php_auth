// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
  });
  
  // Form submission handlers
  const userForm = document.getElementById('userForm');
  const passwordForm = document.getElementById('passwordForm');
  
  userForm.addEventListener('submit', async (e) => {
    e.preventDefault();
const formData = new FormData(userForm)
  
    try {
      const response = await fetch('updateuser.php', {
        method: 'POST',
       
        body: formData   
      });
  
      const result = await response.json();
    //   alert(result.success)
      if (result.success) {
        showNotification('Profile updated successfully!', 'success');
      } else {
        showNotification(result.message || 'Failed to update profile.', 'error');
      }
    } catch (error) {
      showNotification('An error occurred while updating profile.', 'error');
    }
  });
  
  document.getElementById('passwordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    fetch('updatepassword.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            current_password: currentPassword,
            new_password: newPassword,
            confirm_password: confirmPassword,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Password changed successfully!', 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
    });
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} shadow-lg transition-all duration-300 transform translate-y-full`;
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.remove('translate-y-full');
    }, 100);

    setTimeout(() => {
        notification.classList.add('translate-y-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

  
  // Logout functionality
  const logoutButton = document.querySelector('a[href="#"]');
  logoutButton.addEventListener('click', (e) => {
    e.preventDefault();
    // Here you would typically handle the logout process
    console.log('Logging out...');
    showNotification('You have been logged out.', 'info');
  });
  
  // Notification function
  function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg text-white ${
      type === 'success'
        ? 'bg-green-500'
        : type === 'error'
        ? 'bg-red-500'
        : 'bg-blue-500'
    } shadow-lg transition-all duration-300 transform translate-y-full`;
    notification.textContent = message;
  
    document.body.appendChild(notification);
  
    setTimeout(() => {
      notification.classList.remove('translate-y-full');
    }, 100);
  
    setTimeout(() => {
      notification.classList.add('translate-y-full');
      setTimeout(() => {
        document.body.removeChild(notification);
      }, 300);
    }, 3000);
  }
  

  document.getElementById('logout').addEventListener('click', async function()
{
const response = await fetch('logout.php',{
    method:'POST'
});
const result = response.json();

    showNotification('Logging out' ,'success');
    window.location.href = 'login_page.php';

});