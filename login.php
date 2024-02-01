<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php

session_start();
@include 'config.php';

$email = '';
$passErr = '';

if (isset($_POST['login-submit'])) {
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    // Validate email and password
    $query = "SELECT * FROM signup WHERE useremail='$useremail'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($userpassword === $row['userpassword']) {
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            echo "Login Successful";
            header("Location: home.php");
            exit();
        } else {
            $passErr = "Incorrect password";
        }
    } else {
        $passErr = "User not found";
    }
}
  ?>
    <div class="container">
        <form method="POST" class='signup' action="">
            <h2 class="mb-2 fw-bold">Login</h2>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="useremail">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="userpassword">
              <span style='color:red;'><?php echo "$passErr" ?></span>

            </div>
            <div class="text-center">
            <input type="submit" class="btn btn-primary" value="Submit" name="login-submit">
            <p class='text-primary'>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
        </form>
    </div>
</body>
</html>
