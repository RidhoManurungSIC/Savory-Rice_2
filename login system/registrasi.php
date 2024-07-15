<?php 
require "functions.php";
require "header.php" ;

if (isset($_POST["register"])) {
    
    if (registrasi($_POST) > 0) {
        echo "
            <script>
                alert('user baru berhasil di tambahkan!');
                document.location.href = 'login.php';
            </script>
        ";
    }else {
        echo mysqli_error($conn);
    }

}

?>

<div class="wrapper">
<div class="form-wrapper sign-up">
            <form action="" method="post" >
                <h2>Register</h2>
                <div class="input-group">
                    <input type="text" name="username" id="username" required>
                    <label for="username">Username</label>
                </div>

                <div class="input-group">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="remember">
                    <label for="remember"><input type="checkbox" name="remember" id="remember">I agree to the  terms & conditions</label>
                </div>

                <button type="submit" name="register">Sign Up</button>

                <div class="signUp-link">
                    <p>Already have account?<a href="login.php" class="signInBtn-link">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php require "footer.php" ?>