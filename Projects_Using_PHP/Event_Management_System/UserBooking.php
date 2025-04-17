<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booking</title>
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
            text-align: left;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #218838;
        }
        input{
            width: 250px;
            height: 30px;
            padding: 2px;
        }
        h2{
            text-align: center;
        }
        form{
            margin-bottom: 10px;
        }
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
        <h2>USER BOOKING</h2>
        <form method="post">
            <table>
                <tr>
                    <td><label>Name</label></td>
                    <td><input type="text" name="name" placeholder="Enter Name" required></td>
                </tr>
                <tr>
                    <td><label>Aadhar Number</label></td>
                    <td><input type="number" name="Aadharno" placeholder="Enter Aadhar Number" required></td>
                </tr>
                <tr>
                    <td><label>Phone Number</label></td>
                    <td><input type="number" name="phoneno" placeholder="Enter Phone Number" required></td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="email" name="Email" placeholder="Enter Email" required></td>
                </tr>
                <tr>
                    <td><label>Address</label></td>
                    <td><input type="text" name="address" placeholder="Enter Address" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="submit">BOOK</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $Name = htmlspecialchars($_POST['name']);
    $AadharNo = htmlspecialchars($_POST['Aadharno']);
    $PhoneNo = htmlspecialchars($_POST['phoneno']);
    $EmailID = htmlspecialchars($_POST['Email']);
    $Address = htmlspecialchars($_POST['address']);

    $servername = "localhost";
    $dbusername = "root";
     $dbpassword = "";
    $dbname = "event management";
    
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO bookinguserdb (Name, AadharNo, PhoneNo, EmailID, Address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisss", $Name, $AadharNo, $PhoneNo, $EmailID, $Address);
    
    if ($stmt->execute()) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>