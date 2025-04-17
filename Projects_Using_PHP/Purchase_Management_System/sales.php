<?php
include './connection.php';

$select = "SELECT * FROM home";
$medicine = $conn->query($select);
?>
<html>
<head>
<link rel="stylesheet" href="./style/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            background: white;
            padding: 20px;
            margin: 30px auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            margin: 10px 0;
        }
        td {
            padding: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
        ul {
            background: #333;
            padding: 10px;
            list-style: none;
            display: flex;
            justify-content: center;
        }
        ul li {
            margin: 0 10px;
        }
        ul li a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            background: #444;
            border-radius: 5px;
            transition: 0.3s;
        }
        ul li a:hover {
            background: #28a745;
        }
    </style>
</head>
<body>
<header>
        <h1>Pharmacy Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Medicine</a></li>
                <li><a href="ViewMedicine.php">View Medicine</a></li>
                <li><a href="supplier.php">Supplier</a></li>
                <li><a href="viewsupplier.php">View Supplier</a></li>
                <li><a href="purchase.php">Purchase</a></li>
                <li><a href="viewpurchase.php">View Purchase</a></li>
                <li><a href="viewsales.php">View Sales</a></li>
                <li><a href="customerregistration.php">Customer Register</a></li>
                <li><a href="viewcustomer.php">View Customer</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Sales Entry Form</h2>
        <form method="post">
            <table>
                <tr>
                    <td>Date</td>
                    <td><input type="date" name="txtd" value="<?php echo date('Y-m-d'); ?>"></td>
                </tr>
                <tr>
                    <td>Invoice No</td>
                    <td><input type="text" name="txti"></td>
                </tr>
                <tr>
                    <td>Select Medicine</td>
                    <td>
                        <select name="selMed">
                            <?php foreach($medicine as $medicines):?>
                                <option value="<?php echo $medicines["id"]?>">
                                    <?php echo $medicines["MedicineName"];?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="txtq"></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="txtp"></td>
                </tr>
                <tr>
                    <td>GST No</td>
                    <td>
                        <select name="gst">
                            <option value="0">0</option>
                            <option value="5">5</option>
                            <option value="12">12</option>
                            <option value="18">18</option>
                            <option value="28">28</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="submit" value="Save">
                    </td>
                </tr>       
            </table>
        </form>
    </div>
    <?php 
    if(isset($_POST['submit'])) {
        $date = $_POST['txtd'];
        $invoice = $_POST['txti'];
        $medicine = $_POST['selMed'];
        $qty = $_POST['txtq'];
        $price = $_POST['txtp'];
        $gstNo = $_POST['gst'];
     
        $sql = "INSERT INTO sales(Date, InvoiceNo, Medicine, Qty, Price, GSTNo) VALUES ('$date', '$invoice', '$medicine', '$qty', '$price', '$gstNo')";
     
        if($conn->query($sql) === TRUE){
           $sqlProduct = "SELECT * FROM home WHERE id=".$medicine;
           $resultProduct = $conn->query($sqlProduct);
           $firstrow = $resultProduct->fetch_assoc();
           $existingQty = $firstrow["Stock"];
           $newQty = $existingQty - $qty;
           $sqlStockUpdate = "UPDATE home SET stock=".$newQty." WHERE id=".$medicine;
     
           if($conn->query($sqlStockUpdate) === TRUE){
              echo "Stock Updated successfully";
           }
           echo "New record created successfully";
        } else {
           echo "Error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
     }
     
    ?>
</body>
</html>