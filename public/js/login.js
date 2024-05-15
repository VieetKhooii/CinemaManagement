$(document).ready(function() {
    $('#loginForm').submit(function(e) {
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
                    document.getElementById('password').value = '';
                    if (data.role_id === 1){
                        window.location.href = '/admin';
                    }
                    else if (data.role_id === 3){
                        window.location.href = '/dashboard';
                    }
                } else if (data.status === 'error'){
//                     let jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbG9naW4iLCJpYXQiOjE3MTI1NDc1NTMsImV4cCI6MTcxMjU0Nzg1MywibmJmIjoxNzEyNTQ3NTUzLCJqdGkiOiJDV0U4eHZiREYwOWtPRGtPIiwic3ViIjoiQUQwMDAiLCJwcnYiOiJmNjRkNDhhNmNlYzdiZGZhN2ZiZjg5OTQ1NGI0ODhiM2U0NjI1MjBhIn0.BBevDsNJDzLC3KM0YFm5MVB1mSGSoRneO1hR5o8qT4k'

// let jwtData = jwt.split('.')[1]
// let decodedJwtJsonData = window.atob(jwtData)
// let decodedJwtData = JSON.parse(decodedJwtJsonData)

// let isAdmin = decodedJwtData.admin

// console.log('jwtData: ' + jwtData)
// console.log('decodedJwtJsonData: ' + decodedJwtJsonData)
// console.log('decodedJwtData: ' + decodedJwtData)
// console.log('Is admin: ' + isAdmin)
                    const message = data.message;
                    iziToast.warning({
                        title: 'Warning',
                        message: message,
                        position: 'topRight'
                    });
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