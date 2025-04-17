<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
<link rel="stylesheet" href="./style/common.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
         
        .container {
            width: 50%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin: 10px 0;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        /* select{
            min-width: 250px;
            min-height: 30px;
        } */
    </style>
</head>
<body>
    <header>
        <h2>Event Management System</h2>
        <a href="login.php">LOGIN</a>
        <a href="Registration.php">REGISTRATION</a>
        <a href="UserBooking.php">USER BOOKING</a>
        <a href="Booking.php">BOOKING</a>
        <a href="Event.php">EVENT</a>
        <a href="viewevent.php">VIEWEVENT</a>
        <a href="viewbooking.php">VIEWBOOKING</a>
        <a href="AdvanceCollection.php">ADVANCE COLLECTION</a>
    </header>
    
    <div class="container">
        <h2>Event Booking</h2>
        <form method="post">
            <table>
                <tr>
                    <td><label>Event Name:</label></td>
                    <td><input type="text" name="eventname" placeholder="Enter event name" required></td>
                </tr>
                <tr>
                    <td><label>Event Type:</label></td>
                    <td>
                        <select name="eventType" required>
                            <option value="WEDDING">WEDDING</option>
                            <option value="BIRTHDAY PARTY">BIRTHDAY PARTY</option>
                            <option value="CORPORATE INAGURATION">CORPORATE INAGURATION</option>
                            <option value="STAGE EVENTS">STAGE EVENTS</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Number of People:</label></td>
                    <td><input type="number" name="numberofpeople" placeholder="Enter number of people" required></td>
                </tr>
                <tr>
                    <td><label>Floor Type:</label></td>
                    <td>
                        <select name="floortype" required>
                            <option value="First Floor - 500 sq ft">1st floor - 500 sq ft</option>
                            <option value="Second Floor - 1000 sq ft">2nd floor - 1000 sq ft</option>
                            <option value="Third Floor - 1500 sq ft">3rd floor - 1500 sq ft</option>
                            <option value="Fourth Floor - 2000 sq ft">4th floor - 2000 sq ft</option>
                            <option value="Fifth Floor - 3000 sq ft">5th floor - 3000 sq ft</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type="submit" name="submit">Submit</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $eventname = $_POST['eventname'];
    $eventType = $_POST['eventType'];
    $numberofpeople = $_POST['numberofpeople'];
    $floortype = $_POST['floortype'];

    $servername = "localhost";
    $dbusername = "root";
     $dbpassword = "";
    $dbname = "event management";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO eventdb (eventname, eventType, numberofpeople, floortype) VALUES ('$eventname', '$eventType', '$numberofpeople', '$floortype')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Event Booked Successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
