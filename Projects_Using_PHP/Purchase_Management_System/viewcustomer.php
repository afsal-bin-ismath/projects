<html>
<head>
<link rel="stylesheet" href="./style/style.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        /* Navigation Menu */
        ul {
            list-style-type: none;
            padding: 0;
            background: #333;
            overflow: hidden;
            text-align: center;
            border-radius: 8px;
        }

        ul li {
            display: inline;
        }

        ul li a {
            display: inline-block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        ul li a:hover {
            background: #575757;
            border-radius: 5px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #333;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
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
                <li><a href="sales.php">Sales</a></li>
                <li><a href="viewsales.php">View Sales</a></li>
            </ul>
        </nav>
    </header>


    <!-- PHP Code to Fetch Data -->
    <?php
        include './connection.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cusregister";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Pin Code</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['CustomerName']}</td>
                        <td>{$row['Address']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['PhoneNumber']}</td>
                        <td>{$row['PinCode']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No customer records found.</p>";
        }

        $conn->close();
    ?>

</body>
</html>
