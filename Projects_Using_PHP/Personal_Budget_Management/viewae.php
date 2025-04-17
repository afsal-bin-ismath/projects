<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./style/header.css">
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
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
        table{
            margin: auto;
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
        <h3>View Added Expenses</h3>
    </div>
    <div>
        <?php

        include 'connection.php';
        $select = "select addexp.id,addexp.expenseid, addexp.date, addexp.month, addexp.year, addexp.costofitem, expenses.expenseName as expenseName from addexp inner join expenses on addexp.expenseid=expenses.id";
        $addexp = $conn->query($select);



        // $sql = "SELECT * FROM addexp";
        $result = $conn->query($select);
        if ($result->num_rows > 0) {
            echo "<table>
              <tr>
              <th>Id</th>
              <th>Expense Id</th>
              <th>Expense Name</th>
              <th>Date</th>
              <th>Month</th>
              <th>Year</th>
              <th>Costofitem</th>
              </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                  <td>" . $row["id"] . "</td>
                  <td>" . $row["expenseid"] . "</td>
                  <td>" . $row["expenseName"] . "</td>
                  <td>" . $row["date"] . "</td>
                  <td>" . $row["month"] . "</td>
                  <td>" . $row["year"] . "</td>
                  <td>" . $row["costofitem"] . "</td>
                  
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