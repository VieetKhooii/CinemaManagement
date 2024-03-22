$(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        
        const email = $('#email').val();
        const password = $('#password').val();
        $.ajax({
            method: 'POST',
            url: 'http://localhost:8000/login',
            data: {
                'email': email,
                'password': password
            },
            dataType: 'json',
            success: function(data) {
                if (data.status === 'success') {
                    // const user = data.user;
                    // const userId = user.user_id;
                    // const userName = user.user_name;
                    // const userEmail = user.email;
                    // // Access other user properties as needed
                    
                    // // Optionally, you can also handle authorization token
                    // const authorization = data.authorization;
                    // const token = authorization.token;

                    alert('Login successful!');
                    document.getElementById('password').value = '';
                    window.location.href = '/users';
                } else if (data.status === 'error'){
                    const message = data.message;
                    alert(message);
                    document.getElementById('password').value = '';
                }
            },
            // error: function(xhr, textStatus, errorThrown) {
            //     console.error('Error occurred during Ajax request:', textStatus, errorThrown);
            //     alert('An error occurred while processing the request.');
            // }
            
        });
    });
});


$('#logoutBtn').click(function() {
    // Perform an AJAX request to load the page content
        fetch('/logout', {
        method: 'GET',
        headers: {
            // 'Content-Type': 'application/json',
        }
    })  
    .then(response => {
        if (response.ok) {
            alert("hello");
            // Logout successful, call logout function
            document.cookie = 'jwt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            window.location.replace("http://localhost:8000/login");
        } else {
            // Handle error
            console.error('Logout failed:', response.statusText);
        }
    })
    .catch(error => {
        console.error('Logout failed:', error);
    });
});

function logout() {
    // AJAX request to logout route
    
}