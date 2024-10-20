// document
//     .getElementById("registrationForm")
//     .addEventListener("submit", function (event) {
//         event.preventDefault();
//         const firstName = document.getElementById("firstName").value;
//         const lastName = document.getElementById("lastName").value;
//         const email = document.getElementById("email").value;
//         const confirmEmail = document.getElementById("confirmEmail").value;
//         const phone = document.getElementById("phone").value;
//         const password = document.getElementById("password").value;
//         const verifyPassword = document.getElementById("verifyPassword").value;

//         if (email !== confirmEmail) {
//             alert("Emails do not match.");
//             return;
//         }

//         if (password !== verifyPassword) {
//             alert("Passwords do not match.");
//             return;
//         }

//         if (firstName && lastName && email && phone && password) {
//             alert("Registration successful!");
//             // Add your registration logic here, such as an API call to the backend.
//         } else {
//             alert("Please fill out all fields.");
//         }
//     });
