<?php
//Deny direct access
//Reference: https://fedingo.com/how-to-prevent-direct-access-to-php-file/
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("location: index.php");
    exit;
}

// Used to pass data between PHP pages
session_start();
?>

<?php
require_once("./db.php");
require_once("./functions/functions.php");

// If table doesn't already exists, create it.
// We can check if a table exists be selecting from it
// However, on some setups this causes an exception so we handle it to be safe
try {
    if ($conn->query('select * from s103574757_db.orders') == false) {
        // Go to the catch block which contains the creation query
        throw new Exception();
    }
} catch (Exception $e) {
    // Other create table queries can be found in the commit history
    $query = "CREATE TABLE s103574757_db.orders (
        -- Order details
        order_id int(6) AUTO_INCREMENT,
        order_cost int(25) NOT NULL,
        order_time timestamp default current_timestamp,
        order_status varchar(255) DEFAULT 'PENDING',
        
        -- Personal details
        first_name varchar(50) NOT NULL,
        last_name varchar(50) NOT NULL,
        email varchar(50) NOT NULL,
        phone int(10) NOT NULL,
        
        -- Address details
        street varchar(50) NOT NULL,
        state varchar(30) NOT NULL,
        post_code int(4) NOT NULL,

        -- quantity of tickets ordered
        tickets_quantity int NOT NULL,
        
        -- FK to respective tables
        contact_method_id int NOT NULL,
        movie_id int NOT NULL,
        option_id int NOT NULL,
        
        -- Card details
        cc_type varchar(50) NOT NULL,
        cc_name varchar(50) NOT NULL,
        cc_num varchar(16) NOT NULL,
        exp_date char(5) NOT NULL,
        cvv int(3) NOT NULL,

        FOREIGN KEY (contact_method_id) REFERENCES contact_method(contact_method_id),
        FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
        FOREIGN KEY (option_id) REFERENCES options(option_id),
        PRIMARY KEY  (order_id)
     )";

    $conn->query($query);
}

// Associative array that stores errors for each form field
$errors = array();

// Sanitise variables
// Need to sanitase even if select input
// since someone can make an API request with a malicious value

//Initialize variables
if (isset($_POST["first_name"]) && $_POST['first_name'] != "") {
    $first_name = sanitise_input($_POST["first_name"]);

    if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
        $errors["first_name"] = "Only alpha letters allowed in your first name(no spaces).";
    } else if (strlen($first_name) > 25) {
        $errors["first_name"] = "First Name is limited to 25 characters.";
    }
} else {
    $errors["first_name"] = "Please enter your first name";
}

if (isset($_POST["last_name"]) && $_POST['last_name'] != "") {
    $last_name = sanitise_input($_POST["last_name"]);

    // Validate Last name 
    if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
        $errors["last_name"] =  "Only alpha letters allowed in your last name(no spaces).";
    } else if (strlen($last_name) > 25) {
        $errors["last_name"] =  "Last Name is limited to 25 characters.";
    }
} else {
    $errors["last_name"] = "Please enter your last name";
}

if (isset($_POST["email"])) {
    $email = sanitise_input($_POST["email"]);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Remove illegal characters

    if ($email == "") {
        $errors["email"] =  "You must enter your email.";
    } else if ((filter_var($email, FILTER_VALIDATE_EMAIL)) == false) {
        $errors["email"] =  "Invalid email address.";
    }
} else {
    $errors["email"] = "Please enter your email";
}

if (isset($_POST["street"]) && $_POST['street'] != "") {
    $street = sanitise_input($_POST["street"]);

    if (!preg_match("/^[A-Za-z0-9'\.\-\s\,\/]*$/", $street)) {
        $errors["street"] =  "Only Characters such as ['A-Z', 'a-z', '0-9', '.', '-', '/'] are allowed for street.";
    } else if (strlen($street) > 40) {
        $errors["street"] =  "Street is limited to 40 characters.";
    }
} else {
    $errors["street"] = "Please enter your street";
}

if (isset($_POST["post_code"]) && $_POST['post_code'] != "") {
    $post_code = sanitise_input($_POST["post_code"]);

    if (!preg_match("/^[0-9]*$/", $post_code)) {
        $errors["post_code"] =   "Postcode only accepts integers.";
    } else if (strlen($post_code) != 4) {
        $errors["post_code"] =  "Invalid Postcode in Australia(4 digits).";
    }
} else {
    $errors["post_code"] = "Please enter your postcode";
}

if (isset($_POST["state"])) {
    $state = sanitise_input($_POST["state"]);

    if (array_key_exists("post_code", $errors) == false) {
        if ($state == "NSW" && $post_code[0] != 1 || $state != "NSW" && $post_code[0] == 1) {
            $errors['state'] = "New South Wales postcode's starts with 1.";
        } else if ($state == "ACT" && $post_code[0] != 2 || $state != "ACT" && $post_code[0] == 2) {
            $errors['state'] = "Australian Capital Territory postcode's starts with 2.";
        } else if ($state == "VIC" && $post_code[0] != 3 || $state != "VIC" && $post_code[0] == 3) {
            $errors['state'] = "Victoria postcode's starts with 3.";
        } else if ($state == "QLD" && $post_code[0] != 4 || $state != "QLD" && $post_code[0] == 4) {
            $errors['state'] = "Queensland postcode's starts with 4.";
        } else if ($state == "SA" && $post_code[0] != 5 || $state != "SA" && $post_code[0] == 5) {
            $errors['state'] = "South Australia postcode's starts with 5.";
        } else if ($state == "WA" && $post_code[0] != 6 || $state != "WA" && $post_code[0] == 6) {
            $errors['state'] = "Western Australia postcode's starts with 6.";
        } else if ($state == "TAS" && $post_code[0] != 7 || $state != "TAS" && $post_code[0] == 7) {
            $errors['state'] = "Tasmania postcode's starts with 7.";
        } else if ($state == "NT" && $post_code[0] != 0 || $state != "NT" && $post_code[0] == 0) {
            $errors['state'] = "Northern Territory postcode's starts with 0.";
        }
    }
} else {
    $errors["state"] = "Please enter your state";
}

if (isset($_POST["phone"]) && $_POST['phone'] != "") {
    $phone = sanitise_input($_POST["phone"]);

    if (!preg_match("/^[0-9]*$/", $phone)) {
        $errors['phone'] = "Phone number is not a valid phone number.";
    } else if (strlen($phone) != 10) {
        $errors['phone'] = "Phone number is not within the legal range(10 digits).";
    }
} else {
    $errors["phone"] = "Please enter your phone";
}

if (isset($_POST["option_id"])) {
    $option_id = sanitise_input($_POST["option_id"]);
} else {
    $errors["option_id"] = "Please select an option";
}

if (isset($_POST["contact_method_id"])) {
    $contact_method_id = sanitise_input($_POST["contact_method_id"]);
} else {
    $errors["contact_method_id"] = "Please select a contact method";
}

if (isset($_POST["tickets_quantity"]) && $_POST['tickets_quantity'] != "") {
    $tickets_quantity = sanitise_input($_POST["tickets_quantity"]);

    if (!preg_match("/^[0-9]*$/", $tickets_quantity)) {
        $errors['tickets_quantity'] = "Ticket quantity only accepts integers.";
    }
} else {
    $errors["tickets_quantity"] = "Please select a ticket quantity";
}

// This is passed in via a query parameter from products.php
$movie_id = sanitise_input($_POST["movie_id"]);

if (isset($_POST["cc_type"])) {
    $cc_type = sanitise_input($_POST["cc_type"]);
} else {
    $errors["cc_type"] = "Please enter your credit card type";
}

if (isset($_POST["cc_name"]) && $_POST['cc_name'] != "") {
    $cc_name = sanitise_input($_POST["cc_name"]);
} else {
    $errors["cc_name"] = "Please enter your credit card name";
}

if (isset($_POST["cc_num"]) && $_POST['phone'] != "") {
    $cc_num = sanitise_input($_POST["cc_num"]);

    $cc_num = preg_replace('/\s+/', '', $cc_num);
    $first_num = $cc_num[0];
    $sec_num = $cc_num[1];

    if ($cc_num == "") {
        $errors['cc_num'] = "You must enter your Credit Card number.";
    } else if (!preg_match("/^[0-9]*$/", $cc_num)) {
        $errors['cc_num'] = "Credit Card number only accepts integers.";
    } else if ($cc_type == "visa") {
        // Visa should start with 4 and be 16 digits long
        if ($first_num != "4") {
            $errors['cc_num'] = "Invalid card number (must start with 4).";
        } else if (strlen($cc_num) != 16) {
            $errors['cc_num'] = "Invalid card number (must be 16 digits).";
        }
    } else if ($cc_type == "mastercard") {
        // Mastercard should start with 51-55 and be 16 digits long
        if ($first_num != "5") {
            $errors['cc_num'] = "Invalid card number (must start with 51-55).";
        } else if (($sec_num < "1" || $sec_num > "5")) {
            $errors['cc_num'] = "Invalid card number (must start with 51-55).";
        } else if (strlen($cc_num) != 16) {
            $errors['cc_num'] = "Invalid card number (must be 16 digits).";
        }
    } else if ($cc_type == "americanExpress") {
        // American express should start with 34/37 and be 15 digits long
        if (strlen($cc_num) != 15) {
            $errors['cc_num'] = "Invalid card number (must be 15 digits).";
        } else if ($first_num != "3" || ($sec_num != "4" || $sec_num != 4)) {
            $errors['cc_num'] = "Invalid card number (must start with 34/37).";
        }
    }
} else {
    $errors["cc_num"] = "Please enter your credit card number";
}

if (isset($_POST["exp_month"]) && $_POST['exp_month'] != "") {
    $exp_month = sanitise_input($_POST["exp_month"]);
} else {
    $errors["exp_month"] = "Please enter your credit card expiry month";
}

if (isset($_POST["exp_year"]) && $_POST['exp_year'] != "") {
    $exp_year = sanitise_input($_POST["exp_year"]);
} else {
    $errors["exp_year"] = "Please enter your credit card expiry year";
}

//Validate Expiry Date 
if (array_key_exists("exp_month", $errors) == false && array_key_exists("exp_month", $errors) == false) {
    if ($exp_month <=  date("m") && $exp_year <= date("y")) {
        $errors['exp_month'] = "Card is expired. Try another one.";
        $errors['exp_year'] = "Card is expired. Try another one.";
    } else {
        //Show expiry as MM/YY
        $exp_date = "$exp_month/$exp_year";
    }
}

if (isset($_POST["cvv"]) && $_POST['cvv'] != "") {
    $cvv = sanitise_input($_POST["cvv"]);

    if (!preg_match("/^[0-9]*$/", $cvv)) {
        $errors['cvv'] = "Credit Card CVV only accepts integers.";
    } else if (strlen($cvv) != 3) {
        $errors['cvv'] = "Invalid Card CVV (must be 3 digits).";
    }
} else {
    $errors["cvv"] = "Please enter your credit card CVV";
}

// Used to populate fix_order.php fields and receipt
$values = array(
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'phone' => $phone,
    'street' => $street,
    'state' => $state,
    'post_code' => $post_code,
    'tickets_quantity' => $tickets_quantity,

    'movie_id' => $movie_id,
    'option_id' => $option_id,
    'contact_method_id' => $contact_method_id,
);

$_SESSION['values'] = $values;

// If any errors, redirect to fix order
if (empty($errors) == false) {
    $_SESSION["errors"] = $errors;

    header("location: fix_order.php");

    // Do we need to return?
    return;
}

// Get the price of the option from database
$res = $conn->query('SELECT option_price, option_name FROM s103574757_db.options WHERE option_id = ' . $option_id  . ';');
$option_detail = mysqli_fetch_assoc($res);
$price = intval($option_detail['option_price']);

// Calculate final cost
$order_cost = $price * intval($tickets_quantity);

$res =  $conn->query('SELECT movie_name FROM s103574757_db.movies WHERE movie_id = ' . $movie_id . ';');
$movie_detail = mysqli_fetch_assoc($res);

$values['receipt_desc'] =  $movie_detail['movie_name'] . " (" . $option_detail['option_name'] . ")";
$values['order_cost'] = $order_cost;

$_SESSION['values'] = $values;

//INSERT
$sql = "INSERT INTO s103574757_db.orders (order_cost, first_name, last_name, email, phone, street, state, post_code, tickets_quantity, contact_method_id, movie_id, option_id, cc_type, cc_name, cc_num, exp_date, cvv)
        VALUES ('$order_cost', '$first_name', '$last_name', '$email', '$phone', '$street', '$state', '$post_code', '$tickets_quantity', '$contact_method_id', '$movie_id', '$option_id',  '$cc_type', '$cc_name', '$cc_num', '$exp_date', '$cvv')";

$conn->query($sql);

header("location: receipt.php")

?>