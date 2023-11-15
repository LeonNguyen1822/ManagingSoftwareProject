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
                <form action="controllerUserData.php" method="POST">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter Your User ID</p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="UserID" placeholder="Enter User ID Here" required>
                    </div>
                    <p class="text-center">Enter Your User Name</p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="UserName" placeholder="Enter User Name Here" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>