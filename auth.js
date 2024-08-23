// Simulated user authentication status (this should be replaced with real auth logic)
let isLoggedIn = false; // Change this to true when a user successfully logs in

document.getElementById('download-btn').addEventListener('click', function (event) {
  if (!isLoggedIn) {
    event.preventDefault(); // Prevent the default action
    alert('You need to sign in to download this book.');
    // Redirect to the sign-in page
    window.location.href = 'signin.html';
  } else {
    // Allow the download if the user is signed in
    window.location.href = 'path/to/your/book.pdf'; // The actual download link
  }
});
