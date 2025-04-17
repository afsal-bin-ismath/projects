<html>
<head>
<link rel="stylesheet" href="./style/header.css">
    
</head>
<body>
    <h3> REGISTER PAGE </h3>
    <form method ='post'>
        <table>
            <tr>
            <td>
                    Enter you fullName
                </td>
               
                <td>
                    <input type = "text" name = "fullName">
                </td>
            </tr>
            <tr>
                <td>
                    Enter your email
                </td>
                <td>
                    <input type = "email" name = "email">
                </td>
            </tr>
            <tr>
                <td>
                    Enter your mobileNumber
                </td>
                
                <td>
                    <input type = "number" name = "mobileNumber">
                </td>
            </tr>
            <tr>
                <td>
                    Enter your password
                </td>
                <td>
                    <input type = "password" name = "Password">
                </td>
            </tr>
            <tr>
                <td>
                    Enter your designation
                </td>
                <td>
                    <input type = "text" name = "designation">
                </td>
            </tr>
            <tr>
                <td>
                    Enter your salary
                </td>
                <td>
                    <input type = "text" name = "salary">
                </td>
            </tr>
            <tr>
                <td>
                    Enter number of people in home
                </td>
                <td>
                    <input type = "text" name = "numberofpeopleinhome">
                </td>
            </tr>
            <tr>
                <td>
                    Enter your emi
                </td>
                <td>
                    <input type = "text" name = "emi">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type = "submit" name = "submit" value="Register">
                </td>
            </tr>
            <tr>
                <td>
                    <a href="login.php">You already have account?</a>
                </td>
               
            </tr>
        </table>
    </form>
</body>

<?php 

    if(isset($_POST['submit']))
    {
        
        $fullName=$_POST['fullName'];
        $email=$_POST['email'];
        $mobileNumber=$_POST['mobileNumber'];
        $Password=$_POST['Password'];
        $designation=$_POST['designation'];
        $salary=$_POST['salary'];
        $numberofpeopleinhome=$_POST['numberofpeopleinhome'];
        $emi=$_POST['emi'];
    
       
        
    include 'connection.php';

        if($conn->connect_error)
        {
            die("Connection failed:" . $conn->connect_error);
        }
        $sql = "insert into tbl1signin(`fullName`, `email`, `mobileNumber`, `Password`, `designation`, `salary`, `numberofpeopleinhome`, `emi`)  values('$fullName','$email','$mobileNumber','$Password','$designation','$salary','$numberofpeopleinhome','$emi')";

        if($conn->query($sql) === TRUE) {
            echo " new  record is  created successfully ";

            $sql = "SELECT * FROM tbl1signin";

            $result = $conn->query($sql);
            
            if($result->num_rows>0){
                echo "<table>
                <tr>
                   <td>FULLNAME</td>
                   <td>EMAIL</td>
                   <td>MOBILENUMBER</td>
                   <td>PASSWORD</td>
                   <td>DESIGNATION</td>
                   <td>SALARY</td>
                   <td>NUMBEROFPEOPLEINHOME<td>
                   <td>EMI</td>
                </tr>";


                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["fullName"]."</td> <td>".$row["email"]."</td> <td>".$row["mobileNumber"]."</td> <td>".$row["Password"]."</td> <td>".$row["designation"]."</td> <td>".$row["salary"]."</td> <td>".$row["numberofpeopleinhome"]."</td> <td>".$row["emi"]."</td> </tr>";
                }
                    echo "</table>";


        }
        else{
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
        $conn->close();


        
        }
    }
   
?>
</html>