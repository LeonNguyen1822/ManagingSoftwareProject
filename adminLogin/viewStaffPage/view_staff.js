// Function for dynamic create delete button
function createDeleteButton(username) {
    const listItemContainer = document.createElement('div');
    listItemContainer.classList.add('list-item-container');

    const listItem = document.createElement('li');
    listItem.id = username; //set a unique ID for each list item
    listItem.textContent = username;

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('delete-button');
    deleteButton.addEventListener('click', function () {
        deleteStaffMember(username);
    });

    // Append the delete button to the list item container
    listItemContainer.appendChild(deleteButton);

    return listItemContainer;
}

// Function to delete a staff member
function deleteStaffMember(username) {
    // use send ajax request
    fetch('delete_staff.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `username=${username}`, //send the username to be deleted
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the staff member from the list on success
                const listItem = document.getElementById(username);
                if (listItem) {
                    listItem.remove();
                }
            } else {
                console.error('Delete operation failed.');
            }
        })
        .catch(error => console.error('Error deleting staff member:', error));
}


// Retrieve staff usernames and create delete buttons
fetch('view_staff.php')
    .then(response => response.json())
    .then(data => {
        const staffList = document.getElementById('staff-list');
        data.forEach(username => {
            const listItem = document.createElement('li');
            listItem.id = username;
            listItem.textContent = username;
            
            // Create and append a delete button to the list item
            listItem.appendChild(createDeleteButton(username));

            staffList.appendChild(listItem);
        });
    })
    .catch(error => console.error('Error fetching data:', error));