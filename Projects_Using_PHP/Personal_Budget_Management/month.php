<html>

<head>
    <link rel="stylesheet" href="./style/header.css">
    <style>
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
            font-size: 16px;
            color: #333;
        }

        select,
        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #2c3e50;
            /* Dark Blue */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #e74c3c;
            /* Red on Hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h2 id="proj-title">Personal Budget Management</h2>
            <ul>
                <li>
                    <a href="expensehead.php">Add Expenses Head</a>
                </li>
                <li>
                    <a href="vieweh.php">View Expenses Head</a>
                </li>
                <li>
                    <a href="addexp.php">Add Expenses</a>
                </li>
                <li>
                    <a href="viewae.php">view Expenses</a>
                </li>
                <li>
                    <a href="addexp.php">Manage Account</a>
                </li>
                <li>
                    <a href="report.php">Report Page</a>
                </li>
                <li>
                    <a href="month.php">Month Page</a>
                </li>
                <li>
                    <a href="viewmonth.php">View Month Page</a>
                </li>
            </ul>
        </header>
        <div>
            <h3>Month</h3>
        </div>
        <form method='post'>
            <table>

                <tr>
                    <td>
                        Select Month
                    </td>
                    <td>
                        <select name='month'>
                            <option value='0'>Select Month</option>
                            <option value='January'>January</option>
                            <option value='February'>February</option>
                            <option value='March'>March</option>
                            <option value='April'>April</option>
                            <option value='May'>May</option>
                            <option value='June'>June</option>
                            <option value='July'>July</option>
                            <option value='August'>August</option>
                            <option value='September'>September</option>
                            <option value='October'>October</option>
                            <option value='November'>November</option>
                            <option value='December'>December</option>
                    </td>
                </tr>
                <tr>
                    <td>
                        Select Year
                    </td>
                    <td>
                        <select name='year'>
                            <option value='0'>Select Year</option>
                            <option value='2024'>2024</option>
                            <option value='2025'>2025</option>
                            <option value='2026'>2026</option>
                            <option value='2027'>2027</option>
                            <option value='2028'>2028</option>
                    </td>
                </tr>
                <tr>
                    <td>
                        Enter Budget Amount
                    </td>
                    <td>
                        <input type="number" name="budgetamount">
                    </td>
                </tr>
                <tr>
                    <td>
                        Description
                    </td>
                    <td>
                        <input type="txt" name="description">
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
</body>
<?php

if (isset($_POST['submit'])) {

    $month = $_POST['month'];
    $year = $_POST['year'];
    $budgetamount = $_POST['budgetamount'];
    $description = $_POST['description'];



    include 'connection.php';
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
    $sql = "insert into month(`month`, `year`, `budgetamount`, `description`) values('$month','$year','$budgetamount','$description')";

    if ($conn->query($sql) === TRUE) {
        echo " new  record is  created successfully ";
        header("Location: viewmonth.php");
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}


?>

</html>