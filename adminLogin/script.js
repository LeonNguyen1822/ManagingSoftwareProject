document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();
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
                    window.location.href = 'admin_dashboard.html';
                } else if (data.role === 'staff') {
                    window.location.href = 'staff_dashboard.html';
                }
            } 
        } else {
            alert('An error occurred');
        }
    });
});