<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./style/header.css">
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: auto;
        }

        table,
        th,
        td {
            border: 2px solid black;

        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: rgb(201, 247, 149);
        }
    </style>

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
        <h3>View Month</h3>
    </div>
    <div>
        <?php

        include 'connection.php';
        $select = "select * from month";
        $expenses = $conn->query($select);


        $sql = "SELECT * FROM month";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>
              <tr>
              <th>ID</th>
              <th>MONTH</th>
              <th>YEAR</th>
              <th>BUDGET AMOUNT</th>
              <th>Description</th>
              </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                  <td>" . $row["id"] . "</td>
                  <td>" . $row["month"] . "</td>
                  <td>" . $row["year"] . "</td>
                  <td>" . $row["budgetamount"] . "</td>
                  <td>" . $row["description"] . "</td>                  
                  </tr>";
            }
            echo "</table>";
        } else {
            echo "No results found";
        }
        $conn->close();

        ?>
    </div>
</body>

</html>