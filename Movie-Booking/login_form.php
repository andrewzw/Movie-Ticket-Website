<?php

session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header("Location: ./manager.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="GOI Cinemas - Manager Login" />
    <meta name="keywords" content="HTML,CSS,Javascript" />
    <meta name="author" content="Gang of Islands" />
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body class='managerBG'>
    <?php include_once 'includes/menu.php'; ?>

    <div id="loginContainer">
        <form id="loginForm" method='post' action="authentication.php">
            <fieldset>
                <legend> Manager Login </legend>

                <div class="formGroup">
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" pattern="[A-Za-z]{1,25}" placeholder="Username" required />
                </div>

                <div class="formGroup">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" pattern="[A-Za-z]{1,25}" placeholder="Password" required />
                </div>

                <div class="loginSubmitBtn">
                    <input type="submit" value="Login">
                </div>

                <?php
                if (isset($_GET["error_msg"])) {
                    if ($_GET["error_msg"] == "AccessDenied") {
                        echo "<h3 id=loginError>Invalid username or password. Please try again</h3>";
                    } else if ($_GET["error_msg"] == "Unauthenticated") {
                        echo "<h3 id=loginError>Please login to access the manager page</h3>";
                    }
                }
                ?>
            </fieldset>

        </form>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>

</html>