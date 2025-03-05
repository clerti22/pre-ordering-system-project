<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX POST Example</title>
</head>
<body>
    <h1>AJAX POST Example</h1>
    
    <form id="userForm" action="samp1.php" method="POST">
        <label for="name">Name:</label>
        <!-- Hidden input field with a value -->
        <input type="hidden" id="name" name="name" value="John Doe" required>
        <button type="submit">Submit</button>
    </form>

    <script>
        document.getElementById("userForm").addEventListener("submit", function(event){
            event.preventDefault();  // Prevent form from submitting the normal way

            var name = document.getElementById("name").value;  // Get the value from the hidden input field

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure the request
            xhr.open("POST", "samp1.php", true);  // Sending data to samp1.php

            // Set up a function to handle the response from the server
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Log the response from the PHP script in the console
                    if(xhr.responseText === 'Recieved'){
                      console.log('Yey');
                    }
                    else{
                      console.log('AWw')
                    }
                    
                } else {
                    // If there's an error, log the error status in the console
                    console.log("Error: " + xhr.status);
                }
            };

            // Set the request header for POST data
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Send the POST data (the 'name' field value)
            xhr.send("name=" + encodeURIComponent(name));  // Send the 'name' data to the server
        });
    </script>
</body>
</html>


<?php

?>