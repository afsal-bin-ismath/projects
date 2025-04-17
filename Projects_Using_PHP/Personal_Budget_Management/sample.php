<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="./style/header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h3>Report</h3>
    </div>
        <form method="post">
            <table>
                <tr>
                    <td>Select Month</td>
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
                        </select>
                    </td>        
                </tr>
                <tr>
                    <td>Select Year</td>
                    <td>
                        <select name='year'>
                            <option value='0'>Select Year</option>
                            <option value='2024'>2024</option>
                            <option value='2025'>2025</option>
                            <option value='2026'>2026</option>
                            <option value='2027'>2027</option>
                            <option value='2028'>2028</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Enter Budget Amount</td>
                    <td>
                        <input type="number" name="budgetamount">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <input type="text" name="description">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
</div>

<?php

if(isset($_POST['submit'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $budgetamount = $_POST['budgetamount'];
    $description = $_POST['description'];

    $budget_limit = $budgetamount;

    
    if ($month == '0' || $year == '0') {
        echo "Please select a valid month and year.";
    } elseif ($budgetamount > $budget_limit) {
        // Check if the entered budget amount exceeds the limit
        echo "The budget amount exceeds the allowed limit of $budget_limit.";
    } else {
        
    include 'connection.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to check if there's an existing record in the 'month' table for the given month and year
        $sql_check_month = "SELECT * FROM month WHERE month = '$month' AND year = '$year'";
        $result_check_month = $conn->query($sql_check_month);

        // Query to check if there are any related records in the 'expensehead' table for the same month and year
        $sql_check_expenses = "SELECT * FROM expenses WHERE month = '$month' AND year = '$year'";
        $result_check_expenses = $conn->query($sql_check_expenses);

        if ($result_check_month->num_rows > 0) {
            // There is an existing record for the given month and year in the 'month' table
            echo "A record already exists for the selected month and year in the 'month' table.";
        } elseif ($result_check_expensehead->num_rows > 0) {
            // There are existing records in the 'expensehead' table for the given month and year
            echo "There are existing records for the selected month and year in the 'expensehead' table.";
        } else {
            // No conflicts, proceed with the insert query
            $sql_insert = "INSERT INTO month (`month`, `year`, `budgetamount`, `description`)
                           VALUES ('$month', '$year', '$budgetamount', '$description')";

            if ($conn->query($sql_insert) === TRUE) {
                echo "New record created successfully.";
                header("Location: viewmonth.php");
            } else {
                echo "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        }

        // Close connection
        $conn->close();
    }
}
?>

</body>
</html>