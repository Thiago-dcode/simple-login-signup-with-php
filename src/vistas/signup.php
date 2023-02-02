<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="form">
  
        <h4>Sign up!</h4>
        <?php  if(isset($error)): ?>
            <p> <?php  foreach ($error as $value) {
                echo $value;
            }  ?>  </p>
            <?php endif ?>
        <form action="" method="post">
            <div class="input">
                <label for="email">Email</label>
                <input type="text" name="email" require autofocus>
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" name="password" require>
            </div>

            <div class="input">
                <label for="passwordR">Password Repeat</label>
                <input type="password" name="passwordR" require>
            </div>
            <button type="submit" name="submit" value="signup">Sign up!</button>

        </form>
    </div>
</body>

</html>