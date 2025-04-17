<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body class="bg-light">
<header>
        <h1>Pharmacy Management System</h1>
        <nav>
            <ul>
                <li><a href="ViewMedicine.php">View Medicine</a></li>
                <li><a href="supplier.php">Supplier</a></li>
                <li><a href="viewsupplier.php">View Supplier</a></li>
                <li><a href="purchase.php">Purchase</a></li>
                <li><a href="viewpurchase.php">View Purchase</a></li>
                <li><a href="customerregistration.php">Customer Register</a></li>
                <li><a href="viewcustomer.php">View Customer</a></li>
                <li><a href="sales.php">Sales</a></li>
                <li><a href="viewsales.php">View Sales</a></li>
            </ul>
        </nav>
    </header>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Medicine Registration</h2>
        <form method="post" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Medicine Name</label>
                <input type="text" name="med" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="des" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="Tablet" required>
                    <label class="form-check-label">Tablet</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="Syrup">
                    <label class="form-check-label">Syrup</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="Injection">
                    <label class="form-check-label">Injection</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="Scrap">
                    <label class="form-check-label">Scrap</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Manufacture Name</label>
                <input type="text" name="mafn" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Manufacture Code</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Age Limit</label>
                <div class="d-flex gap-2">
                    <input type="number" name="minage" class="form-control w-50" placeholder="Min Age" required>
                    <input type="number" name="maxage" class="form-control w-50" placeholder="Max Age" required>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
        </form>

        
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $MedicineName = $_POST['med'];
        $Description = $_POST['des'];
        $Type = $_POST['type'];
        $ManufactureName = $_POST['mafn'];
        $ManufactureCode = $_POST['code'];
        $MinAge = $_POST['minage'];
        $MaxAge = $_POST['maxage'];

        $conn = new mysqli("localhost", "root", "", "testdb");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO home (ManufactureCode, MedicineName, Description, Type, ManufactureName, MinAge, MaxAge, Stock) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
        $stmt->bind_param("sssssss", $ManufactureCode, $MedicineName, $Description, $Type, $ManufactureName, $MinAge, $MaxAge);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center mt-3'>New record created successfully</div>";
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
        $conn->close();
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>