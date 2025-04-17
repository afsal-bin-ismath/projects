<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
<link rel="stylesheet" href="./style/common.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
        <a href="viewevent.php">VIEWEVENT</a>
        <a href="viewbooking.php">VIEWBOOKING</a>
        <a href="AdvanceCollection.php">ADVANCE COLLECTION</a>
    </header>
    
    <div class="container">
        <h2>Event Details</h2>
        <?php
        $servername = "localhost";
        $username = "root";
         $dbpassword = "";
        $dbname = "event management";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM eventdb";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table>
                  <tr>
                  <th>Event Name</th>
                  <th>Event Type</th>
                  <th>Number of People</th>
                  <th>Floor Type</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                      <td>" . htmlspecialchars($row["eventname"]) . "</td>
                      <td>" . htmlspecialchars($row["eventType"]) . "</td>
                      <td>" . htmlspecialchars($row["numberofpeople"]) . "</td>
                      <td>" . htmlspecialchars($row["floortype"]) . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No events found</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
