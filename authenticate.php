<?php
    session_start();
    $_SESSION['authenticated']=false;
    $config = include('config.php');
    $validation_username = $config['validation_username'];
    $validation_password = $config['validation_password'];
?>

<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $u = $_POST['validation_username'];
        $p = $_POST['validation_password'];
        // die("echo $u==$validation_username,$p==$validation_password");
        if($u==$validation_username && $p==$validation_password){
            // die('tera naam joker');
            $_SESSION['authenticated']=true;
            header("Location: report.php");
        }
        else {
            $_SESSION['incorrect']=true;
            header("Location: authenticate.php");
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Spacer app</title>
</head>
<body>
<div class="container-fluid">
        <div class="row">

            <div class="col-sm-6 left-pane">
                <h1 style="text-align: center;">Admin Page</h1>
                <hr>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id='validation_username' name="validation_username" placeholder="Enter username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id='validation_password' name="validation_password" placeholder="Enter password" required>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" id='submit' class="btn btn-primary mb-2">Generate Report</button>
                </form>
                <?php
                    if($_SESSION['incorrect'])
                    echo
                    '<div class="alert alert-danger" role="alert">
                        Invalid username or password. <br>
                        Thou Shall Not Pass.
                    </div>';
                ?>
            </div>

            <div class="col-sm-6 right-pane">
                <h1 style="text-align: center;">Spacer-App</h1>
                <hr>
                <div class="alert alert-info" role="alert">
                    <p>
                        This app is to designed for providing solution to social distancing implementation, during the difficult time of Corona.
                        Kindly enter all the required fields required in the form. 
                    </p>
                    <p>
                        Enter the token username and token key provided to you to see the records, else "THOU SHALL NOT PASS"!
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>