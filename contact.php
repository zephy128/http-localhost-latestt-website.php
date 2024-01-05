<?php
require 'contactconnect.php';

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $message = $_POST["message"];

    // Prepare the SQL statement with placeholders
    $query = $conn->prepare("INSERT INTO tbl_con (email, name, message) VALUES (?, ?, ?)");

    if ($query === false) {
        // Handle prepare error
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $query->bind_param("sss", $email, $name, $message);

    // Execute the query
    $result = $query->execute();

    if ($result === false) {
        // Handle execute error
        echo "Error: " . $query->error;
    } else {
        echo  '<script>alert("Data inserted successfully")</script>';
        
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="stylesheet" href="contact.css">

</head>
<body>

<div class="form-container">
   <form action="" method="post">
      <h1>Contact Us</h1>
      <div class="form-group">
                <p class="contact-description">Have a Complain? Message us here, We'll be in touch. </p>

                
                <input placeholder="Email" type="email" name="email" id="email" required>
    
            
                <input placeholder="Name" type="text" name="name" id="name" required>
           
            
                <textarea placeholder="Message" name="message" id="message" cols="30" rows="5" required></textarea>

            </div>
            <input type="submit" name="submit" value="Submit" class="btn-submit"></input></br>
            <a href="website.php" class="proceed-btn">Back</a>
        </form>
        </div>

   
</div>

</body>
</html>