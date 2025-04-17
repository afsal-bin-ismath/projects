<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="./style/style.css">
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            text-align: center;
        }

        /* Navigation Bar */
        ul {
            list-style: none;
            padding: 0;
            background: #343a40;
            overflow: hidden;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        ul li {
            display: inline;
        }

        ul li a {
            display: inline-block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }

        ul li a:hover {
            background: #495057;
            border-radius: 5px;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #d6eaff;
            transition: 0.3s;
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
                <li><a href="customerregistration.php">Customer Register</a></li>
                <li><a href="viewcustomer.php">View Customer</a></li>
            </ul>
        </nav>
    </header>


    <h2>Sales Report</h2>

    <?php
        include './connection.php';
        if ($conn->connect_error) {
            die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
        }

        $sql = "SELECT * FROM sales";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Invoice No</th>
                        <th>Medicine</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>GST No</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['Date']}</td>
                        <td>{$row['InvoiceNo']}</td>
                        <td>{$row['Medicine']}</td>
                        <td>{$row['Qty']}</td>
                        <td>{$row['Price']}</td>
                        <td>{$row['GSTNo']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p style='color: red;'>No records found.</p>";
        }

        $conn->close();
    ?>

</body>
</html>