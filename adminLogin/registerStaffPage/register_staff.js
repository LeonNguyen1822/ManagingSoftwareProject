document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');
    const staffCreatedMessage = document.getElementById('staff-message'); //registered staff message
    const errorMessage = document.getElementById('error-message'); // staff username

    registerForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const newUsername = document.getElementById('newUsername').value;
        const newPassword = document.getElementById('newPassword').value;

        // Send the new staff data to the server for registration
        const response = await fetch('register_staff.php', {
            method: 'POST',
            body: JSON.stringify({ newUsername, newPassword }),
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (response.ok) {
            const data = await response.json();

            if (data.success) {
                errorMessage.textContent = "";
                staffCreatedMessage.textContent = 'Staff registered successfully!';
                registerForm.reset();

            } else {
                staffCreatedMessage.textContent = '';
                errorMessage.textContent = data.message; // parse back the message that staff username used 
            }
        } else {
            errorMessage.textContent = 'An error occurred during registration. Please try again later.';
        }
    });
});
