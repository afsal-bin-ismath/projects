<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <header>
        <h1>Pharmacy Management System</h1>
        <!-- <nav>
            <ul>
                <li><a href="index.php">Medicine</a></li>
                <li><a href="ViewMedicine.php">View Medicine</a></li>
                <li><a href="supplier.php">Supplier</a></li>
                <li><a href="viewsupplier.php">View Supplier</a></li>
                <li><a href="purchase.php">Purchase</a></li>
                <li><a href="viewpurchase.php">View Purchase</a></li>
                <li><a href="customerregistration.php">Customer Register</a></li>
            </ul>
        </nav> -->
    </header>

    <div class="flex items-center justify-center h-screen bg-gray-100">
        <form method="post" class="bg-white p-10 rounded-xl shadow-lg w-96">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h1>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Username</label>
                <div class="relative">
                    <input type="text" name="user" class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" placeholder="Enter your username">
                    <span class="absolute left-3 top-2.5 text-gray-400">
                        &#128100;
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="pass" class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" placeholder="Enter your password">
                    <span class="absolute left-3 top-2.5 text-gray-400">
                        &#128274;
                    </span>
                </div>
            </div>

            <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">Login</button>

            <?php if (isset($error)): ?>
                <div class="mt-3 p-2 bg-red-100 text-red-600 text-center rounded-lg">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </form>
</body>
</div>

</html>

<?php
include './connection.php';
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM reg WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid Credentials";
    }
    $stmt->close();
    $conn->close();
}
?>