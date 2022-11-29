<?php
// Used to pass data between PHP pages
session_start();
?>

<?php
    require_once("./db.php");
    require_once("./functions/functions.php");

    // If the users table doesn't already exists, create it.
    // We can check if a table exists be selecting a single entry from it
    // However, on some setups this causes an exception so we handle it to be safe
    try {                
        if ($conn->query('select * from s103574757_db.users limit 1') == false) {
            // Go to the catch block which contains the creation query
            throw new Exception();
        }
    } catch (Exception $e) {
        $query = "CREATE TABLE s103574757_db.users (
            id int(10) AUTO_INCREMENT,
            username varchar(50) NOT NULL,
            password varchar(50) NOT NULL
        )";
    }

    // Checks that the username and password entered match a user in the users table
    if (isset($_POST["username"]) && isset($_POST['password'])) {
        $username = sanitise_input($_POST["username"]);
        $password = sanitise_input($_POST["password"]);

        $user_query_sql= "SELECT * FROM s103574757_db.users WHERE username = '$username' AND password = '$password';";
        $result = $conn->query($user_query_sql);
        
        // If there no matching users, redirect to login page
        if ($result->num_rows == 0) {
            header("Location: ./login_form.php?error_msg=AccessDenied");
        } else {
            // Otherwise, add the authenticated variable to the session and redirect manager page
            $_SESSION["authenticated"]=true;
            header("Location: ./manager.php");
        }
    }
?>
