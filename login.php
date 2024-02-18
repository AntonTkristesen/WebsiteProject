<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
  $mysqli = require __DIR__ . "/database.php";
  
  $sql = sprintf("SELECT * FROM user
                  WHERE email = '%s'",
                 $mysqli->real_escape_string($_POST["email"]));
  
  $result = $mysqli->query($sql);
  
  $user = $result->fetch_assoc();

  if ($user)
  {
    if (password_verify($_POST["password"], $user["password_hash"])) {
      session_start();

      $_SESSION["user_id"] = $user["id"];

      header("location: index2.php");
      exit;
    }
  }

  $is_invalid = true;
                  
}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 text-black">

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form method="post" action="" style="width: 23rem;">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                            
                            <?php if ($is_invalid): ?>
                                <em>Invalid Login</em>
                            <?php endif; ?>

                            <div class="form-outline mb-4">
                                <label for="email">Email address</label>
                                <input type="email" id="email" class="form-control form-control-lg" name="email" />
                            </div>

                            <div class="form-outline mb-4">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control form-control-lg" name="password" />
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                            </div>

                            <p>Don't have an account? <a href="signup.html" class="link-info">Register here</a></p>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 px-0 d-none d-lg-block">
                    <img src="https://images.unsplash.com/photo-1500916434205-0c77489c6cf7?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
</body>
</html>


