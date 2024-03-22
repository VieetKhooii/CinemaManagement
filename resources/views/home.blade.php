<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Simple API Request</title>
</head>
<body>

<h1>Users List</h1>

<ul id="userList"></ul>

<button id="logoutBtn">Logout</button>
<script src="/js/login.js"></script>


<!-- <script>
document.addEventListener('DOMContentLoaded', function () {
    // Function to make an AJAX request
    function getUsers() {
        // Make a GET request to your API endpoint
        fetch('/api/users')
            .then(response => response.json())
            .then(data => {
                // Handle the response data
                displayUsers(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Function to display users on the page
    function displayUsers(users) {
        const userListElement = document.getElementById('userList');

        // Clear existing content
        userListElement.innerHTML = '';

        // Iterate through the users and append them to the list
        users.forEach(user => {
            const listItem = document.createElement('li');
            listItem.textContent = `ID: ${user.id}, Name: ${user.name}, Email: ${user.email}`;
            userListElement.appendChild(listItem);
        });
    }

    // Call the function to get users when the page loads
    getUsers();
});
</script> -->

</body>
</html>
