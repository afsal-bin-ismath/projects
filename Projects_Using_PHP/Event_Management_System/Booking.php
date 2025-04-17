<?php

$servername = "localhost";
$dbusername = "root";
 $dbpassword = "";
$dbname = "event management";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$select = "SELECT * FROM bookinguserdb";
$index = $conn->query($select);

$Select = "SELECT * FROM eventdb";
$events = $conn->query($Select);

if (isset($_POST["submit"])) {
    $selectuser = $_POST["seluser"];
    $selectevent = $_POST["selevent"];
    $date = $_POST["date"];
    $startingTime = $_POST["startingTime"];
    $EndingTime = $_POST["endingTime"];
    $selectnumberofpeoples = $_POST["selnumberofpeoples"];
    $foodcatering = isset($_POST["foodYes"]) ? 'yes' : 'no';
    $CateringAmount = $_POST["cateringamount"] ?? 0;
    $photography = isset($_POST["photoYes"]) ? 'yes' : 'no';
    $PhotographyAmount = $_POST["photographyamount"] ?? 0;
    $Entertainment = $_POST["entertainmentType"] ?? " ";
    $EntertainmentAmount = $_POST["entertainmentAmount"] ?? 0;
    $goodybags = $_POST["goodyBags"] ?? " ";
    $GoodyBagsAmount = $_POST["Goodybagsamount"] ?? 0;

    // Calculate total amount
    $totalamount = $CateringAmount + $PhotographyAmount + $EntertainmentAmount + $GoodyBagsAmount;

    $sql = "INSERT INTO bookeventsdb (selectuser, selectevent, date, startingTime, EndingTime, selectnumberofpeoples, foodcatering, CateringAmount, photography, PhotographyAmount, Entertainment, EntertainmentAmount, goodybags, GoodyBagsAmount, totalamount) 
            VALUES ('$selectuser', '$selectevent', '$date', '$startingTime', '$EndingTime', '$selectnumberofpeoples', '$foodcatering', '$CateringAmount', '$photography', '$PhotographyAmount', '$Entertainment', '$EntertainmentAmount', '$goodybags', '$GoodyBagsAmount', '$totalamount')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booked successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking</title>
<link rel="stylesheet" href="./style/common.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
         
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
        select,input{
            min-width: 250px;
            min-height: 30px;
        }
        button{
            width: 70px;
            height: 40px;
            background-color: ;
        }

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
        <h1>Book an Event</h1>
        <form method="post">
            <table>
                <tr>
                    <td>Select User</td>
                    <td>
                        <select name="seluser">
                            <?php foreach ($index as $indexs): ?>
                                <option value="<?php echo htmlspecialchars($indexs["id"]); ?>">
                                    <?php echo htmlspecialchars($indexs["Name"]); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Select Event</td>
                    <td>
                        <select name="selevent">
                            <?php foreach ($events as $event): ?>
                                <option value="<?php echo htmlspecialchars($event["id"]); ?>">
                                    <?php echo htmlspecialchars($event["eventname"]); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><input type="date" name="date" required></td>
                </tr>
                <tr>
                    <td>Starting Time</td>
                    <td><input type="time" name="startingTime" required></td>
                </tr>
                <tr>
                    <td>Ending Time</td>
                    <td><input type="time" name="endingTime" required></td>
                </tr>
                <tr>
                    <td>Number of People</td>
                    <td><input type="number" name="selnumberofpeoples" required></td>
                </tr>
                <tr>
                    
                    <td colspan="2"><button type="submit" name="submit">Book</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
