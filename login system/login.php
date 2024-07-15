<?php 
// sesion
session_start();
require "functions.php";
require "header.php";

if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {

    $id  = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn,"SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
}

if ( isset($_SESSION["login"]) ) {
    header("Location: ../index.php");
    exit;
}



if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result)  === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION["login"] = $row["id_akses"];
            $_SESSION["user"] =  $row["username"];

            if (isset($_POST['remember'])) {

                setcookie('id',$row['id'],time()+60);
                setcookie('key', hash('sha256', $row['username']),time()+60);
            }

            if ($_SESSION["login"] == '1') {
                header("Location: ../index.php");
            }elseif ($_SESSION["login"] == '2') {
                header("Location: ../owner/index.php");
            }elseif ($_SESSION["login"] == '3') {
                header("Location: ../kasir/index.php");
            }else{
                header("Location: ../costumer/index.php");
            }
            exit;
        }
    }

    $error = true;
}

?>
    <?php if (isset($error)):?>
        <?php 
            echo "
            <script>
                alert('username atau password anda salah!');
                document.location.href = 'login.php';
            </script>
        ";        
        ?>
    <?php endif; ?>

    <div class="wrapper">
        <div class="form-wrapper sign-in">
            <form action="" method="post" >
                <h2>Login</h2>
                <div class="input-group">
                    <input type="text" name="username" id="username" required>
                    <label for="username">Username</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="remember">
                    <label for="remember"><input type="checkbox" name="remember" id="remember">Remember me</label>
                </div>

                <button type="submit" name="login">Login</button>

                <div class="signUp-link">
                    <p>Don't have account?<a href="registrasi.php" class="signUpBtn-link">Sign Up</a></p>
                </div>
            </form>
        </div>    
    </div>

<?php require "footer.php" ?>

   
 