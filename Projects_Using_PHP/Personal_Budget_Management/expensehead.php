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
        input[type="password"], 
        textarea { 
            width: 100%; 
            padding: 10px; 
            border-radius: 10px;
            border: 2px solid #ccc;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        } 
        input[type="submit"] { 
            padding: 10px 20px; 
            border-radius: 10px;
            border: none; background-color: #4CAF50; 
            color: white;
            cursor: pointer; 
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); 
        } 
        input[type="submit"]:hover { 
            background-color: #45a049;
        } 
        h3 { 
            text-align: center; 
        } 
    </style> 
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
        <h3>Expense Head</h3>
    </div>
    <form method ='post'>
        <table>
            <tr>
                <td>
                    Enter the Expense Name
                </td>
                <td>
                    <input type = "text" name  = "expenseName">
                </td>
            </tr>
            <tr>
                <td>
                    Enter your Description
                </td>
                <td>
                    <input type = "text" name = "Description" autocompleteoff>
                </td>
            </tr>
            <tr>
                <td> 
                </td>
                <td>
                    <input type = "submit" name = "submit" value="Enter">
                </td>
            </tr>
        </table>
    </form>
    </div>
</body>
<?php 

    if(isset($_POST['submit']))
    {
        $expenseName=$_POST['expenseName'];
        $Description=$_POST['Description'];
    
        
        include 'connection.php';

        if($conn->connect_error)
        {
            die("Connection failed:" . $conn->connect_error);
        }
        $sql = "insert into expenses(`expenseName`, `Description`) values('$expenseName','$Description')";

        if($conn->query($sql) === TRUE) {
            echo " new  record is  created successfully ";
            header("Location: addexp.php");    
            }
            else{
                echo "Error:" . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }

   
?>
</html>