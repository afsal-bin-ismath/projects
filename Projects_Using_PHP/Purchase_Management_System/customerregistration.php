<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="./style/style.css">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            
        }

        /* Page Background */
        body {
            display: flex;
            /* justify-content: center;
            align-items: center; */
            min-height: 100vh;
            background: #f4f4f4;
        }

        /* Form Container */
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Heading */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Input Groups */
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Submit Button */
        button {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #0056b3;
        }

        /* Navigation Links */
        nav {
            margin-top: 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Success and Error Messages */
        .success-msg {
            color: green;
            font-size: 16px;
            margin-top: 10px;
        }

        .error-msg {
            color: red;
            font-size: 16px;
            margin-top: 10px;
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
                <li><a href="sales.php">Sales</a></li>
                <li><a href="viewsales.php">View Sales</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Customer Registration</h1>
        <form method="post">
            <div class="input-group">
                <label>Customer Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-group">
                <label>Address</label>
                <input type="text" name="add" required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="id" required>
            </div>
            <div class="input-group">
                <label>Phone Number</label>
                <input type="number" name="phno" required>
            </div>
            <div class="input-group">
                <label>Pincode</label>
                <input type="number" name="pin" required>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
        <!-- <nav>
            <ul>
                <li><a href="index.php">Medicine</a></li>
                <li><a href="ViewMedicine.php">View Medicine</a></li>
                <li><a href="supplier.php">Supplier</a></li>
                <li><a href="viewsupplier.php">View Supplier</a></li>
                <li><a href="purchase.php">Purchase</a></li>
                <li><a href="viewpurchase.php">View Purchase</a></li>
                <li><a href="customerregistration.php">Customer Register</a></li>
            </ul>
        </nav> -->
    </div>
</body>

</html>

<?php
include './connection.php';
if (isset($_POST['submit'])) {
    $CustomerName = $_POST['name'];
    $Address = $_POST['add'];
    $Email = $_POST['id'];
    $PhoneNumber = $_POST['phno'];
    $Pincode = $_POST['pin'];

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO cusregister (CustomerName, Address, Email, PhoneNumber, PinCode) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $CustomerName, $Address, $Email, $PhoneNumber, $Pincode);

    if ($stmt->execute()) {
        echo "<p class='success-msg'>New record created successfully</p>";
    } else {
        echo "<p class='error-msg'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>