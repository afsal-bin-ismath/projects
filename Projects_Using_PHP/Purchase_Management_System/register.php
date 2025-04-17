<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="./style/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body> 
<header>
        <h1>Pharmacy Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Medicine</a></li>
                <li><a href="ViewMedicine.php">View Medicine</a></li>
                <li><a href="supplier.php">Supplier</a></li>
                <li><a href="viewsupplier.php">View Supplier</a></li>
                <li><a href="purchase.php">Purchase</a></li>
                <li><a href="viewpurchase.php">View Purchase</a></li>
                <li><a href="customerregistration.php">Customer Register</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Registration Form</h1>
        <form method="post">
            <table>
                <tr>
                    <td>Pharmacy Name</td>
                    <td><input type="text" name="phar"></td>
                </tr>
                <tr>
                    <td>Pharmacy Location</td>
                    <td><input type="text" name="loc"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="id"></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><input type="number" name="phno"></td>
                </tr>
                <tr>
                    <td>Contact Name</td>
                    <td><input type="text" name="cont"></td>
                </tr>
                <tr>
                    <td>Contact Phone Number</td>
                    <td><input type="text" name="ph"></td>
                </tr>
                <tr>
                    <td>Contact Email</td>
                    <td><input type="text" name="custe"></td>
                </tr>
                <tr>
                    <td>GST No</td>
                    <td><input type="text" name="gst"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="user"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Submit"></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="login.php">Login</a></td>
                </tr>
            </table>
        </form>
    </div>
</body>

<?php
if(isset($_POST['submit'])) {
    $PharmacyName = $_POST['phar'];
    $PharmacyLocation = $_POST['loc'];
    $Email = $_POST['id'];
    $PhoneNumber = $_POST['phno'];
    $contactName = $_POST['cont'];
    $contactPhoneNo = $_POST['ph'];
    $contactEmail = $_POST['custe'];
    $gstno = $_POST['gst'];
    $username = $_POST['user'];
    $Password = $_POST['pass'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "testdb";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO reg (PharmacyName, PharmacyLocation, Email, PhoneNumber, ContactName, ContactPhoneNo, ContactEmail, Username, Password, GSTNo) 
            VALUES ('$PharmacyName', '$PharmacyLocation', '$Email', '$PhoneNumber', '$contactName', '$contactPhoneNo', '$contactEmail', '$username', '$Password', '$gstno')";

    if($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
    $conn->close();
}
?>
</html>
