<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
            width: 30%;
            margin: 50px auto;
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
        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
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
        <h2>Register</h2>
        <form method="post">
            <table>
                <tr>
                    <td><label>Name</label></td>
                    <td><input type="text" name="name" placeholder="Enter Name" required></td>
                </tr>
                <tr>
                    <td><label>Mobile No</label></td>
                    <td><input type="number" name="mobileno" placeholder="Enter Mobile Number" required></td>
                </tr>
                <tr>
                    <td><label>E-Mail</label></td>
                    <td><input type="email" name="email" placeholder="Enter E-Mail" required></td>
                </tr>
                <tr>
                    <td><label>Address</label></td>
                    <td><input type="text" name="address" placeholder="Enter Address" required></td>
                </tr>
                <tr>
                    <td><label>Username</label></td>
                    <td><input type="text" name="username" placeholder="Enter Username" required></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" name="password" placeholder="Enter Password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="submit">Register</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $mobileno = htmlspecialchars($_POST['mobileno']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $userName = htmlspecialchars($_POST['username']);
    $passWord = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $servername = "localhost";
    $dbusername = "root";
     $dbpassword = "";
    $dbname = "event management";
    
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO registrationdb (name, mobileno, email, address, username, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissss", $name, $mobileno, $email, $address, $userName, $passWord);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>