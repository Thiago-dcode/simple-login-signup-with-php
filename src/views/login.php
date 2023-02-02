<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.php">
    <title>Document</title>
</head>
<style>
    body {

        display: flex;
        justify-content: center;
        align-items: center;

    }

    .form {

        display: flex;
        flex-direction: column;

        align-items: center;
        justify-content: center;
        min-height: 80vh;

    }

    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        justify-content: center;
    }

    .input {
        display: flex;
        gap: 0.5rem;
        flex-direction: column;

    }
</style>


<body>

    <div class="form">


        <?php if (isset($success)) : ?>

            <p><?php
                
                echo $success;

                ?></p>


        <?php endif; ?>
        <h4>LOGIN!</h4>
        <?php if (isset($error)) : ?>

            <p><?php
                foreach ($error as $value) {
                    echo '<br>';
                    echo $value;
                }

                ?></p>


        <?php endif; ?>
        <form action="" method="post">
            <div class="input"> <label for="email">Email</label>
                <input type="text" name="email" require autofocus>
            </div>
            <div class="input"><label for="password">Password</label>
                <input type="password" name="password" require>
            </div>

            <button type="submit" name="submit" value="login">LOGIN!</button>
            <p>Don't have an account? <button type="submit" name="submit" value="register">sign up!</button></p>
        </form>
    </div>
</body>

</html>