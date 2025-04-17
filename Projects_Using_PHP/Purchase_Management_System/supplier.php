<html>
<head>
<link rel="stylesheet" href="./style/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #fff;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
            font-size: 16px;
        }

        input[type="text"], 
        input[type="email"], 
        input[type="number"], 
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        ul {
            list-style-type: none;
            padding: 0;
            background-color: #333;
            overflow: hidden;
            text-align: center;
            margin: 0;
        }

        ul li {
            display: inline;
            padding: 15px;
        }

        ul li a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            display: inline-block;
            transition: 0.3s;
        }

        ul li a:hover {
            background-color: #575757;
            border-radius: 5px;
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
                <li><a href="viewsupplier.php">View Supplier</a></li>
                <li><a href="purchase.php">Purchase</a></li>
                <li><a href="viewpurchase.php">View Purchase</a></li>
                <li><a href="customerregistration.php">Customer Register</a></li>
            </ul>
        </nav>
    </header>

    <form method='post'>
        <table>
            <tr>
                <td>Supplier Name</td>
                <td><input type="text" name="txtn" required></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><textarea name="txta" required></textarea></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="txte" required></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td><input type="number" name="txtp" required></td>
            </tr>
            <tr>
                <td>GST No</td>
                <td><input type="text" name="txtg" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Submit"></td>
            </tr>       
        </table>
    </form>

    
</body>
<?php
include './connection.php';
if(isset($_POST['submit']))
{
   $gstNo = $_POST['txtg'];
   $Name = $_POST['txtn'];
   $address = $_POST['txta'];
   $email = $_POST['txte'];
   $phoneNo = $_POST['txtp'];

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   $sql = "INSERT INTO supplier(GSTNo, Name, Address, Email, PhoneNo) VALUES ('$gstNo', '$Name', '$address', '$email', '$phoneNo')";

   if ($conn->query($sql) === TRUE) {
       echo "<script>alert('New record created successfully');</script>";
   } else {
       echo "<script>alert('Error: " . $sql . " " . $conn->error . "');</script>";
   }
   $conn->close();
}
?>
</html>
