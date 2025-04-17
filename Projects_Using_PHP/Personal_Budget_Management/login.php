<html>
<head>
<link rel="stylesheet" href="./style/header.css">
    <h1> LOGIN PAGE </h1>
</head>
<body>
<form method ='post'>
        <table>
        <tr>
            <td>
                    Enter you email
                </td>
               
                <td>
                    <input type = "text" name = "email">
                </td>
            </tr>
            <tr>
            <td>
                    Enter you password
                </td>
               
                <td>
                    <input type = "password" name = "password">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type = "submit" name = "submit" value="Login">
                </td>
            </tr>
        
</form>
            <?php 

    if(isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];

        
        include 'connection.php';
        if($conn->connect_error)
        {
            die("Connection failed:" . $conn->connect_error);
        }
           $sql = "SELECT * FROM tbl1signin where email='$email' and password='$password'";
           $result = $conn->query($sql);
           if(($result->num_rows) === 1){
            header("Location: expensehead.php");
           }
        else{
            echo "invalid credential";
        }
    $conn->close();

    }

?>
    
</body>
</html>