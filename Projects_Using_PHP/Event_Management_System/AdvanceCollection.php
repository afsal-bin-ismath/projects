<?php 
session_start();

// Database connection
$servername = "localhost"; 
$dbusername = "root"; 
 $dbpassword = "";
$dbname = "event management"; 

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// Check if tables exist
$checkTable = $conn->query("SHOW TABLES LIKE 'bookinguserdb'");
if ($checkTable->num_rows == 0) {
    die("Error: Table 'bookinguserdb' does not exist. Please create it in the database.");
}

$checkTable2 = $conn->query("SHOW TABLES LIKE 'bookeventsdb'");
if ($checkTable2->num_rows == 0) {
    die("Error: Table 'bookeventsdb' does not exist. Please create it in the database.");
}

// Fetch users and available dates
$users = $conn->query("SELECT * FROM bookinguserdb"); 
$dates = $conn->query("SELECT DISTINCT date FROM bookeventsdb");

if (isset($_POST["submit"])) { 
    $selectuser = $_POST["seluser"]; 
    $selectdate = $_POST["seldate"]; 

    $stmt = $conn->prepare("SELECT * FROM bookeventsdb WHERE user_id = ? AND date = ?");
    $stmt->bind_param("is", $selectuser, $selectdate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { 
        $firstRow = $result->fetch_assoc();
        $_SESSION['id'] = $firstRow['id']; 
        $_SESSION['totalAmount'] = $firstRow["CateringAmount"] + $firstRow["PhotographyAmount"] + $firstRow["EntertainmentAmount"] + $firstRow["GoodyBagsAmount"]; 
    } else { 
        echo "<p style='color:red;'>No results found.</p>"; 
    } 
}

if (isset($_POST["getBalance"])) { 
    if (!isset($_SESSION['id']) || !isset($_SESSION['totalAmount'])) {
        die("Error: No booking selected. Please submit first.");
    }
    $Advanceamount = $_POST["Advanceamount"]; 
    $totalAmount = $_SESSION['totalAmount']; 

    if ($Advanceamount > $totalAmount) {
        echo "<p style='color:red;'>Error: Advance amount cannot be greater than total amount.</p>";
    } else {
        $balanceAmount = $totalAmount - $Advanceamount; 
        echo "<p>Balance Amount: $balanceAmount</p>";
    }
} 
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance Collection</title>
<link rel="stylesheet" href="./style/common.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; }
        header { background: #333; color: white; padding: 15px; }
        header a { color: white; text-decoration: none; margin: 0 15px; }
        .container { width: 80%; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #333; color: white; }
        select, input { padding: 5px; width: 100%; }
        input[type="submit"] { background: #28a745; color: white; border: none; padding: 10px; cursor: pointer; }
        input[type="submit"]:hover { background: #218838; }
    </style>
</head> 
<body> 
    <header>
        <h2>Event Management System</h2>
        <a href="login.php">LOGIN</a>
        <a href="Registration.php">REGISTRATION</a>
        <a href="UserBooking.php">USER BOOKING</a>
        <a href="Booking.php">BOOKING</a>
        <a href="Event.php">EVENT</a>
        <a href="viewevent.php">VIEW EVENT</a>
        <a href="viewbooking.php">VIEW BOOKING</a>
        <a href="AdvanceCollection.php">ADVANCE COLLECTION</a>
    </header>
    <div class="container">
        <h1>Advance Collection</h1>
        <form method="post"> 
            <table> 
                <tr> 
                    <td>Select User</td> 
                    <td> 
                        <select name="seluser" required> 
                            <?php foreach ($users as $user): ?> 
                                <option value="<?php echo $user["id"]; ?>"> 
                                    <?php echo htmlspecialchars($user["Name"]); ?> 
                                </option> 
                            <?php endforeach; ?> 
                        </select> 
                    </td> 
                </tr> 
                <tr> 
                    <td>Select Date</td> 
                    <td> 
                        <select name="seldate" required> 
                            <?php foreach ($dates as $date): ?> 
                                <option value="<?php echo $date["date"]; ?>"> 
                                    <?php echo htmlspecialchars($date["date"]); ?> 
                                </option> 
                            <?php endforeach; ?> 
                        </select> 
                    </td> 
                </tr> 
                <tr> 
                    <td></td> 
                    <td><input type="submit" name="submit" value="Submit"></td> 
                </tr> 
                <tr> 
                    <td>Enter Advance Amount</td> 
                    <td><input type="number" name="Advanceamount" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="getBalance" value="Get Balance"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
