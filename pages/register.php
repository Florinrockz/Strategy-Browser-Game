<?php

    if (isset($_POST['register'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        
        $stmt=$pdo->prepare("INSERT INTO users(username,password,email) VALUES(:username,:password,:email) ");
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":email",$email);
        $stmt->execute();

        echo "You registered successfuly!";
    }
?>
<h4>Register Here!</h4>
<form action="" method="post" onsubmit=validate()>
    <table>
        <tr>
            <td><input type="text" name="username" class="inputData" id="username" placeholder="Username"></td>
        </tr>
        <tr>
            <td><input type="password" name="password" class="inputData" id="password" placeholder="Password"></td>
        </tr>
        <tr>
            <td><input type="password" name="confirmpassword" class="inputData" id="confirmpassword" placeholder="Confirm Password"></td>
        </tr>
        <tr>
            <td><input type="email" name="email" id="email" class="inputData" placeholder="Email"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Register" name="register" class="regButton"></td>
        </tr>
    </table>
</form>