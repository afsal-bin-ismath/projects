<?php 

include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$select = "SELECT * FROM expenses";
$expenses = $conn->query($select);

if (isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $expenseid = $_POST["selExpensehead"];

    $select = "SELECT * FROM addexp INNER JOIN expenses ON expenses.id = addexp.expenseid WHERE addexp.date >= '$fromdate' AND addexp.date <= '$todate' AND addexp.expenseid = '$expenseid'";
    $expenses = $conn->query($select);

    if ($expenses->num_rows > 0) {
        $totalCost = 0;
        echo "<table>
              <tr>
              <th>Id</th>
              <th>Expense Id</th>
              <th>Date</th>
              <th>Cost of Item</th>
              </tr>";
        while ($row = $expenses->fetch_assoc()) {
            $totalCost += $row["costofitem"];
            echo "<tr>
                  <td>" . $row["id"] . "</td>
                  <td>" . $row["expenseid"] . "</td>
                  <td>" . $row["date"] . "</td>
                  <td>" . $row["costofitem"] . "</td>
                  </tr>";
        }
        echo "<tr>
              <td colspan='3'><strong>Total Cost</strong></td>
              <td><strong>" . $totalCost . "</strong></td>
              </tr>";
        echo "</table>";
    } else {
        echo "No results found";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./style/header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .container {
            width: 80%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        /* ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
            text-align: center;
        }
        ul li {
            display: inline;
            margin: 0 10px;
        }
        ul li a {
            text-decoration: none;
            color: #4CAF50;
        }
        ul li a:hover {
            text-decoration: underline;
        } */
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 2px solid black;
        }
        th {
            background-color: rgb(201, 247, 149);
        }
        input[type="date"],
        input[type="text"],
        input[type="submit"],
        select {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
            border: 2px solid #ccc;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <title>Report</title>
</head>
<body>
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
    
    <div class="container">
        <form method="post">
            <table>
                <tr>
                    <td>From Date</td>
                    <td><input type="date" name="fromdate"></td>
                </tr>
                <tr>
                    <td>To Date</td>
                    <td><input type="date" name="todate"></td>
                </tr>
                <tr>
                    <td>Expense Name</td>
                    <td>
                        <select name="selExpensehead">
                            <?php while ($row = $expenses->fetch_assoc()): ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['expenseName']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Get"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
