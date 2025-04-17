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
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
         
        .container {
            width: 90%;
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
            background: white;
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
        <a href="viewevent.php">VIEW EVENT</a>
        <a href="viewbooking.php">VIEW BOOKING</a>
        <a href="AdvanceCollection.php">ADVANCE COLLECTION</a>
    </header>
    
    <div class="container">
        <h2>Booked Events</h2>
        <?php
        $servername = "localhost";
        $username = "root";
         $dbpassword = "";
        $dbname = "event management";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM bookeventsdb";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table>
                  <tr>
                  
                  <th>User</th>
                  <th>Event</th>
                  <th>Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Number of People</th>
                  <th>Food Catering</th>
                  <th>Catering Amount</th>
                  <th>Photography</th>
                  <th>Photography Amount</th>
                  <th>Entertainment</th>
                  <th>Entertainment Amount</th>
                  <th>Goody Bags</th>
                  <th>Goody Bags Amount</th>
                  <th>Total Amount</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                      
                      <td>" . htmlspecialchars($row["selectuser"]) . "</td>
                      <td>" . htmlspecialchars($row["selectevent"]) . "</td>
                      <td>" . htmlspecialchars($row["date"]) . "</td>
                      <td>" . htmlspecialchars($row["startingTime"]) . "</td>
                      <td>" . htmlspecialchars($row["EndingTime"]) . "</td>
                      <td>" . htmlspecialchars($row["selectnumberofpeoples"]) . "</td>
                      <td>" . htmlspecialchars($row["foodcatering"]) . "</td>
                      <td>" . htmlspecialchars($row["CateringAmount"]) . "</td>
                      <td>" . htmlspecialchars($row["photography"]) . "</td>
                      <td>" . htmlspecialchars($row["PhotographyAmount"]) . "</td>
                      <td>" . htmlspecialchars($row["Entertainment"]) . "</td>
                      <td>" . htmlspecialchars($row["EntertainmentAmount"]) . "</td>
                      <td>" . htmlspecialchars($row["goodybags"]) . "</td>
                      <td>" . htmlspecialchars($row["GoodyBagsAmount"]) . "</td>
                      <td>" . htmlspecialchars($row["totalamount"]) . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
