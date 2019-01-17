<?php 
    if(isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $stmt=$pdo->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":password",$password);
        
            $stmt->execute();
            $users=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $usName=$user['username'];
                $pass=$user['password'];
            }
            $_SESSION['loggedIn']=$usName;
        header("Location: ?page=loggedIn");
        
    }
        
?>
<h4>Login Here!</h4>
<form action="" method="post" onsubmit=validate()>
    <table>
        <tr>
            <td><input type="text" name="username" class="inputData" id="username" placeholder="Username" required></td>
        </tr>
        <tr>
            <td><input type="password" name="password" class="inputData" id="password" placeholder="Password" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="Login" name="login" class="regButton"></td>
        </tr>
    </table>
</form>