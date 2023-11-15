<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <h2 class="text-center">Forgot Password</h2>
                <p class="text-center">Choose one of the Option</p>
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Send OTP Code">
                    </div>
                </form>
                <form action="useridentify/identifyuser.php" method="POST" autocomplete="">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Enter User ID and User Name">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>