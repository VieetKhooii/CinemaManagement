function loadHomePage() {
    // Retrieve the authentication token from local storage or cookie
    const token = getTokenFromCookie('jwt'); // Implement this function to retrieve the token
    console.log(token);
    // Make a request to load the /home page
    fetch('/users', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`, // Attach the token to the Authorization header
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        // Handle response
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function getTokenFromCookie(cookieName) {
    const cookie = document.cookie.split('; ')
        .find(row => row.startsWith(`${cookieName}=`));
    if (cookie) {
        return cookie.split('=')[1];
    }
    
    return null;
}

// Call the function to load the home page when needed
loadHomePage();