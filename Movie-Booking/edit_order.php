<?php

require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->query("update s103574757_db.orders set order_status = '" . $_POST['status'] . "' where order_id = " . $_POST['id']);

    header('Location: manager.php');
    exit;
}

// Abort if id not set
if (!isset($_GET['id'])) {
    header('Location: manager.php');
    exit;
}

$id = $_GET['id'];
$order = mysqli_fetch_assoc($conn->query("select * from s103574757_db.orders where order_id = " . $id));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="GOI Cinemas - Enhancements" />
    <meta name="keywords" content="HTML,CSS,Javascript" />
    <meta name="author" content="Gang of Islands" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>GOI - Manager</title>
</head>

<body class='managerBG'>
    <?php include_once 'includes/menu.php'; ?>

    <h1 class="assignment-related-page-title">Updating order #<?= $order['order_id'] ?></h1>

    <form id="editForm" action="edit_order.php" method="post">
        <input type="hidden" name="id" value="<?= $order['order_id'] ?>">
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="PENDING" <?= $order['order_status'] == 'PENDING' ? 'selected' : '' ?>>PENDING</option>
            <option value="FULFILLED" <?= $order['order_status'] == 'FULFILLED' ? 'selected' : '' ?>>FULFILLED</option>
            <option value="PAID" <?= $order['order_status'] == 'PAID' ? 'selected' : '' ?>>PAID</option>
            <option value="ARCHIVED" <?= $order['order_status'] == 'ARCHIVED' ? 'selected' : '' ?>>ARCHIVED</option>
        </select>

        <div id='editOptions'>
            <a href="manager.php">Cancel</a>
            <input class="confirmButton" type="submit" value="Save">
        </div>
    </form>
</body>

</html>