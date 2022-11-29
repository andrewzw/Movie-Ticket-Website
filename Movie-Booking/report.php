<?php
// Only allows access to page if the user has been through the authentication
// page and has the authenticated boolean set in the session.
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: ./login_form.php?error_msg=Unauthenticated");
}

require_once("./db.php");
require_once("./functions/functions.php");

// Defaults to last week time frame and conver to MySQL format
$from = date("Y-m-d H:i:s", strtotime(get_query_param("from", date('d-M-Y', strtotime('-7 days')))));
$to = date("Y-m-d H:i:s", strtotime(get_query_param("to", date('d-M-Y'))));

$finance = mysqli_fetch_assoc($conn->query("SELECT count(order_id), avg(order_cost), max(order_cost) FROM s103574757_db.orders WHERE order_status='FULFILLED' and order_time between '$from' and '$to'"));
$popularity = mysqli_fetch_assoc($conn->query("SELECT max(o.state), max(m.movie_name) FROM s103574757_db.orders o inner join s103574757_db.movies m on m.movie_id = o.movie_id where order_time between '$from' and '$to'"));
$orders = mysqli_fetch_assoc($conn->query("SELECT count(order_id) FROM s103574757_db.orders where order_time between '$from' and '$to'"));


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

    <section id="receiptContainer">
        <h2>Generated report</h2>

        <section id="receiptContent">
            <table id="receiptItems">
                <tbody>
                    <tr>
                        <td>From: <?= $from ?> </td>
                        <td class="alignRight">To: <?= $to ?> </td>
                    </tr>
                </tbody>
            </table>

            <p><b>Finance:</b></p>
            <p>Tickets sold: <?= $finance['count(order_id)'] ?></p>
            <p>Average order cost: <?= $finance['avg(order_cost)'] ?></p>
            <p>Most expensive order: <?= $finance['max(order_cost)'] ?></p>
            <p><small>*Only fulfilled orders are counted</small></p>

            <br>

            <p><b>Popularity:</b></p>
            <p>Most popular state: <?= $popularity['max(o.state)'] ?></p>
            <p>Most popular movie: <?= $popularity['max(m.movie_name)'] ?></p>

            <br>

            <p><b>Orders:</b></p>
            <p>Total Orders in time period: <?= $orders['count(order_id)'] ?> </p>
            <p>Fulfilled orders in time period: <?= $finance['count(order_id)'] ?> </p>
            <p>Average orders per day: <?= $orders['count(order_id)'] / round((strtotime($to) - strtotime($from)) / (60 * 60 * 24)) ?> </p>
        </section>

        <a href="manager.php">Back to dashboard</a>
</body>

</html>