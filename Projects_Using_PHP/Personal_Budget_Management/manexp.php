<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./style/header.css">
    <style>
        table {
            border-collapse: collapse;
            margin: auto;
        }

        th,
        tr,
        td {
            border: 2px solid black;
            padding: 5px;
        }

        th{
            background-color:rgb(141, 165, 239);
            
        }

        form {
            display: flex;
            justify-content: center;
            /* Optional: Centers vertically */
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color:rgb(223, 58, 37);
            /* Dark Blue */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover {
            background-color: black;
            /* Red on Hover */
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
        <h3>Manage Expenses</h3>
    </div>
    <form method='post'>

        <input type="submit" name="submit" value="Manage Account">

    </form>
    <div>
        <?php
        include 'connection.php';

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST["submit"])) {
            $sql = "SELECT * FROM addexp";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<table>
              <tr>
              <th>Id</th>
              <th>Expense Id</th>
              <th>Date</th>
              <th>Cost of Item</th>
              </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                  <td>" . $row["id"] . "</td>
                  <td>" . $row["expenseid"] . "</td>
                  <td>" . $row["date"] . "</td>
                  <td>" . $row["costofitem"] . "</td>
                  </tr>";
                }
                echo "</table>";
            } else {
                echo "No results found";
            }
            $conn->close();
        }
        ?>
    </div>
</body>

</html>