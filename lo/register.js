function register() {
    // Clear previous error messages
    clearErrors();
    
    // Get input field values
    var name = document.getElementById("name").value;
    var gender = document.getElementById("gender").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    // Validate input fields
    var isValid = true;
    
    if (name.trim() === "") {
        displayError("name", "Name is required");
        isValid = false;
    }
    
    if (gender === "") {
        displayError("gender", "Gender is required");
        isValid = false;
    }
    
    if (username.trim() === "") {
        displayError("username", "Username is required");
        isValid = false;
    }
    
    if (password.trim() === "") {
        displayError("password", "Password is required");
        isValid = false;
    }
    
    if (isValid) {
        // Perform registration process
        
        alert("Registration successful!");
    }
}

function login() {
    // Clear previous error messages
    clearErrors();
    
    // Get input field values
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    // Validate input fields
    var isValid = true;
    
    if (username.trim() === "") {
        displayError("username", "Username is required");
        isValid = false;
    }
    
    if (password.trim() === "") {
        displayError("password", "Password is required");
        isValid = false;
    }
    
    if (isValid) {
        // Perform login process
        
        alert("Login successful!");
    }
}

function displayError(fieldId, errorMessage) {
    var field = document.getElementById(fieldId);
    var errorElement = document.createElement("span");
    errorElement.className = "error";
    errorElement.innerHTML = errorMessage;
    field.parentNode.insertBefore(errorElement, field.nextSibling);
}

function clearErrors() {
    var errorElements = document.getElementsByClassName("error");
    for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].remove();
    }
}