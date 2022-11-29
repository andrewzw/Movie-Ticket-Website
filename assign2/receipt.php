<?php
//Deny direct access
Reference: https://fedingo.com/how-to-prevent-direct-access-to-php-file/
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("location: index.php");
    exit;
}
session_start()
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="description" content="receipt" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Weng Kit Soo Hoo" />
    <link rel="stylesheet" href="./styles/style.css">

    <title>Receipt</title>

</head>

<body id="receiptBG">
    <?php include_once 'includes/menu.php'; ?>

    <section id="receiptContainer">
        <h2>Thanks for your order! Have a good day!</h2>

        <section id="receiptContent">
            <p><?= $_SESSION['values']['first_name'], " ", $_SESSION['values']['last_name']; ?></p>
            <p>Address:<?= $_SESSION['values']['street'], " ", $_SESSION['values']['state'], " ", $_SESSION['values']['post_code'] ?></p>
            <p>Phone:<?= $_SESSION['values']['phone'] ?></p>
            <p>Email:<?= $_SESSION['values']['email'] ?></p>
            <p>CCNum:***************</p>
            <p>CCExp: **/**</p>
            <p>CVV:***</p>

            <table id="receiptItems">
                <tbody>
                    <tr>
                        <td><?= $_SESSION['values']['receipt_desc'] ?>
                        </td>
                        <td class="alignRight"><?= $_SESSION['values']['tickets_quantity'] ?>
                        </td>
                    </tr>

                    <tr id="total">
                        <td>Total</td>
                        <td class="alignRight">$<?= $_SESSION['values']['order_cost'] ?>.00
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <a href="index.php">Back to Homepage</a>
        <p> GOI Inc. Hawthorn, 3122 VICTORIA</p>
        <p>Questions? Email <a href="mailto:">GOISupport@hotmail.com</a></p>
    </section>
</body>

</html>