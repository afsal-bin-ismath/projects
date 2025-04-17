<?php

include 'connection.php';
$select = "select * from expenses";
$expenses = $conn->query($select);

if (isset($_POST["submit"])) {
    $expenseid = $_POST["selExpensehead"];
    $expenseid = $_POST["expenseid"];
    $date = $_POST["date"];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $costofitem = $_POST["costofitem"];




    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO addexp(`expenseid`, `date`,`month`,`year`, `costofitem`) VALUES ('$expenseid','$date','$month','$year', '$costofitem')";
    if ($conn->query($sql) === TRUE) {
        echo " Add expenses successfully";
        header("Location: manexp.php");
    } else {
        echo "error:", $sql . "<br>" . $conn->error;
        $conn->error;
    }
    $conn->close();
}

?>
<html>

<head>
    <link rel="stylesheet" href="./style/header.css">

    <style>
        table {
            margin: 20px auto;
            padding: 20px;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            /* Curved edges */
            border: 2px solid #ccc;
            /* Border color */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        input[type="submit"] {
            padding: 10px 20px;
            border-radius: 10px;
            /* Curved edges */
            border: none;
            background-color: #4CAF50;
            /* Green background */
            color: white;
            /* White text */
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }

        h3 {
            text-align: center;
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
        <h3>Add Expenses</h3>
    </div>
    <form method='post'>
        <table>
            <tr>
                <td>Expense Id</td>
                <td>
                    <input type="number" name="expenseid">
                </td>
            </tr>

            <tr>
                <td>
                    Select Date
                </td>
                <td>
                    <select name='date'>
                        <option value='0'>Select Date</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                        <option value='11'>11</option>
                        <option value='12'>12</option>
                        <option value='13'>13</option>
                        <option value='14'>14</option>
                        <option value='15'>15</option>
                        <option value='16'>16</option>
                        <option value='17'>17</option>
                        <option value='18'>18</option>
                        <option value='19'>19</option>
                        <option value='20'>20</option>
                        <option value='21'>21</option>
                        <option value='22'>22</option>
                        <option value='23'>23</option>
                        <option value='24'>24</option>
                        <option value='26'>26</option>
                        <option value='27'>27</option>
                        <option value='28'>28</option>
                        <option value='29'>29</option>
                        <option value='30'>30</option>
                        <option value='31'>31</option>
                </td>
            </tr>
            <tr>
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
                <td>Select Expense </td>
                <td>
                    <select name="selExpensehead">
                        <?php foreach ($expenses as $expensehead): ?>
                            <option value="<?php echo $expensehead["id"]; ?>">
                                <?php echo $expensehead["expenseName"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td>cost of item</td>
                <td>
                    <input type="number" name="costofitem">
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Add">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>