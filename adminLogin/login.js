document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');

    function displayError(fieldId, message) {
        const errorElement = document.getElementById(fieldId + 'Error');
        errorElement.innerText = message;
    }

    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        document.getElementById('usernameError').innerText = '';
        document.getElementById('passwordError').innerText = '';

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        const response = await fetch('login.php', {
            method: 'POST',
            body: JSON.stringify({ username, password }),
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (response.ok) {
            const data = await response.json();
            if (data.success) {
                if (data.role === 'admin') {
                    window.location.href = 'adminDashboardPage/admin_dashboard.html';
                } else if (data.role === 'staff') {
                    window.location.href = 'staff_dashboard.html';
                }
            } else {
                displayError('password', 'Invalid username or password');
            }
        } else {
            displayError('username', 'An error occurred');
        }
    });
});
