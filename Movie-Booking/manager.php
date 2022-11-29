<?php
// Only allows access to page if the user has been through the authentication
// page and has the authenticated boolean set in the session.
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: ./login_form.php?error_msg=Unauthenticated");
}

require_once("./db.php");
require_once("./functions/functions.php");

$sort = get_query_param("sort", "desc");
$name = get_query_param("name", ""); // empty means get all
$prod = get_query_param("prod", ""); // empty means get all
$status = get_query_param("status", ""); // empty means get all

$query = "
    select * from s103574757_db.orders o 
    inner join s103574757_db.movies m
    on o.movie_id=m.movie_id";

// Whether or not we have two where clauses
$add_and = false;

if ($name != "") {
    $query .= " where (o.first_name like '%$name%' or o.last_name like '%$name%')";
    $add_and = true;
}

if ($status != "") {
    if ($add_and)
        $query .= " and";
    else
        $query .= " where";

    $query .= " o.order_status = '$status'";

    $add_and = true;
}

if ($prod != "") {
    if ($add_and)
        $query .= " and";
    else
        $query .= " where";

    $query .= " o.movie_id = $prod";
}

$query .= " order by o.order_cost $sort";

$orders = $conn->query($query);
$movies = $conn->query("select * from s103574757_db.movies");

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

    <h1 class="assignment-related-page-title">Manager</h1>

    <form action="manager.php" method="get">
        <div id="searchOptionsContainer">
            <div class="formGroup">
                <label for="name">Customer name: </label>
                <input type="text" name="name" id="name" value="<?= $name ?>">
            </div>

            <div class="formGroup">
                <label for="sort">Sort order cost: </label>
                <select name="sort" id="sort">
                    <option value="desc" <?= $sort === "desc" ? 'selected' : '' ?>>Descending</option>
                    <option value="asc" <?= $sort === "asc" ? 'selected' : '' ?>>Ascending</option>
                </select>
            </div>

            <div class="formGroup">
                <label for="prod">Product:</label>
                <select name="prod" id="prod">
                    <option value="" selected>-- ALL --</option>
                    <?php while ($row = mysqli_fetch_assoc($movies)) { ?>
                        <option value="<?= $row['movie_id'] ?>" <?= $row['movie_id'] === $prod ? 'selected' : '' ?>>
                            <?= $row['movie_name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="formGroup">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="" selected>-- ALL --</option>
                    <option value="PENDING" <?= $status == 'PENDING' ? 'selected' : '' ?>>PENDING</option>
                    <option value="FULFILLED" <?= $status == 'FULFILLED' ? 'selected' : '' ?>>FULFILLED</option>
                    <option value="PAID" <?= $status == 'PAID' ? 'selected' : '' ?>>PAID</option>
                    <option value="ARCHIVED" <?= $status == 'ARCHIVED' ? 'selected' : '' ?>>ARCHIVED</option>
                </select>
            </div>

            <input class='confirmButton' type="submit" value="Search">
        </div>
    </form>


    <?php if ($orders->num_rows == 0) { ?>
        <p class="notFoundMsg">No entries were found.</p>
    <?php } else { ?>
        <table id="managerSearchTable">
            <tr>
                <th>ID</th>
                <th>Date of order</th>
                <th>Product</th>
                <th>Total cost</th>
                <th>Customer name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
                <tr>
                    <td><?= $row['order_id']; ?></td>
                    <td><?= $row['order_time']; ?></td>
                    <td><?= $row['movie_name']; ?></td>
                    <td><?= $row['order_cost']; ?></td>
                    <td><?= $row['first_name'] . " " . $row['last_name']; ?></td>
                    <td><?= $row['order_status']; ?></td>
                    <td>
                        <!-- Send the user to the edit page (which fetches order data via order_id) -->
                        <a class="editLink" href="edit_order.php?id=<?= $row['order_id'] ?>">Edit</a>

                        <!-- Delete order by posting to delete_order.php. We need to use a form because JS is not allowed :( -->
                        <form id='deleteForm' action="delete_order.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['order_id'] ?>">
                            <input <?= $row['order_status'] !== 'PENDING' ? "disabled" : "" ?> class="deleteButton" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>


    <div id="reportOptionsContainer">
        <h2>Generate report</h2>

        <form action="report.php" method="get">
            <div class="multiLineForm">
                <div class="formGroup">
                    <label for="from">From: </label>
                    <input type="date" name="from" id="from" required>
                </div>

                <div class="formGroup">
                    <label for="to">To: </label>
                    <input type="date" name="to" id="to" required>
                </div>
            </div>

            <input class='confirmButton' type="submit" value="Generate report">
        </form>
    </div>

</body>

</html>