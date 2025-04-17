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
        // Check connection
        if ($conn->connect_error) {
            die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
        }

        $sql = "SELECT * FROM home";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Medicine Name</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Manufacture Name</th>
                        <th>Manufacture Code</th>
                        <th>Min Age</th>
                        <th>Max Age</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['MedicineName']}</td>
                        <td>{$row['Description']}</td>
                        <td>{$row['Type']}</td>
                        <td>{$row['ManufactureName']}</td>
                        <td>{$row['ManufactureCode']}</td>
                        <td>{$row['MinAge']}</td>
                        <td>{$row['MaxAge']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No medicine records found.</p>";
        }

        $conn->close();
    ?>

</body>
</html>
