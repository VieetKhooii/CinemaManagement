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
            dataType: 'json', // Specify the expected data type as JSON
            success: function(data) {
                if (data.status === 'success') { // Check if the status is 'success'
                    // // Access user-related information from the response
                    // const user = data.user;
                    // const userId = user.user_id;
                    // const userName = user.user_name;
                    // const userEmail = user.email;
                    // // Access other user properties as needed
                    
                    // // Optionally, you can also handle authorization token
                    // const authorization = data.authorization;
                    // const token = authorization.token;
                    
                    // // Display a success message or perform further actions
                    alert('Login successful!');
                } else {
                    alert('Unauthorized');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error occurred during Ajax request:', textStatus, errorThrown);
                alert('An error occurred while processing the request.');
            }
        });
    });
});