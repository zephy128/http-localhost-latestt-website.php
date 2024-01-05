<?php
require 'connection.php';

if (isset($_POST["submit"])) {
    $Firstname = $_POST["Firstname"];
    $Lastname = $_POST["Lastname"];
    $Email = $_POST["Email"];
    $Date = $_POST["Date"];
    $Event = $_POST["Event"];
    $Time = $_POST["Time"];
    $Gender = $_POST["Gender"];
    $Message = $_POST["Message"];
    
    // Check if the selected date is a Sunday (day of the week is 0)
    $selectedDayOfWeek = date('w', strtotime($Date));
    if ($selectedDayOfWeek == 0) {
        echo '<script>alert("Appointments cannot be booked on Sundays. Please choose another date.")</script>';
    } elseif (strtotime($Date) < strtotime('today')) {
        echo '<script>alert("Appointments cannot be booked for past dates. Please choose another date.")</script>';
    } else {
        // Check if the same combination of date, event, and time is already booked
        $existingQuery = "SELECT * FROM tb_appointment WHERE Date = '$Date' AND Event = '$Event' AND Time = '$Time'";
        $existingResult = mysqli_query($conn, $existingQuery);

        if (mysqli_num_rows($existingResult) > 0) {
            echo '<script>alert("The selected date, event, and time are already booked. Please choose another combination.")</script>';
        } else {
            // Proceed with the appointment submission
            $query = "INSERT INTO tb_appointment VALUES('', '$Firstname', '$Lastname', '$Email', '$Date', '$Event', '$Time', '$Gender', '$Message')";
            $result = mysqli_query($conn, $query);

            // Add additional logic if needed

            echo '<script>alert("Appointment submitted successfully!")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Scholarship</title>

   <link rel="stylesheet" href="appoint.css">

</head>
<body>

<div class="form-container">

   <form action="" method="post">
      <h1>Appointment</h1></br>
      <p style="color: white;  font-size: 16px;"><b>Description: </b>Wait for the staff to email, can you download the download form for health questions, it's important to keep it safe, thank you.</p></br>
      <label for="Firstname" class="white"><b>First Name:</b></label>
      <input type="text" id="Firstname" name="Firstname" placeholder="Firstname"> 
      <label for="Lastname" class="white"><b>Last Name:</b></label>
      <input type="text" id="Lastname" name="Lastname" placeholder="Lastname">
      <label for="Email" class="white"><b>Email Address</b></label>
      <input type="text" id="Email" name="Email" placeholder="Email">
      <label for="Date" class="white"><b>Date</b></label>
        <input type="Date" id="Date" name="Date" required>
        <label for="Event" class="white"><b>Name Event:</b></label>
        <select id="Event" name="Event">
                <option selected disabled>Select Event</option>
                    <option>Basketball Court</option>
                    <option>Dance Floor</option>
                    <option>Clinic</option>
                </select>
                <label for="Time" class="white"><b>Time Appointment:</b></label>
        <select id="Time" name="Time" required>
        <option selected disabled>Time:</option>
            <option value="8:00 AM">8:00 AM - 9:00 AM</option>
            <option value="9:00 AM">9:00 AM - 10:00 AM</option>
            <option value="10:00 AM">10:00 AM - 11:00 AM</option>
            <option value="11:00 AM">11:00 AM - 12:00 PM</option>
            <option value="01:00 PM">1:00 PM - 2:00 PM</option>
            <option value="02:00 PM">2:00 PM - 3:00 PM</option>
            <option value="03:00 PM">3:00 PM - 4:00 PM</option>
        </select>
        
                <label for="Gender" class="white"><b>Gender:</b></label>
                <select id="Gender" name="Gender">
                    <option selected disabled>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <label for="Message" class="white"><b>Message Us</b></label></br>
                <textarea name="Message" id="Message" rows="4" cols="67"></textarea>

      <input type="submit" name="submit" value="Submit" class="form-btn">
      <a href="website.php" class="proceed-btn">Back</a>

      <div class="detel">
      <a href="SurveyForm.pdf"download>DOWNLOAD FORM</a> 
    </div>
      </div>
   </form>
   
</div>

</body>
</html>