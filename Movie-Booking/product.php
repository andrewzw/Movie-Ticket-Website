<?php

require_once("./db.php");

$movies = $conn->query("select * from s103574757_db.movies");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="GOI Cinemas - Product" />
    <meta name="keywords" content="Movie, Movie Tickets" />
    <meta name="author" content="Gang of Islands" />
    <link rel="stylesheet" href="./styles/style.css">
    <title>GOI Cinemas - Movies</title>
</head>

<body id="enquiryBG">

    <?php include_once 'includes/menu.php'; ?>
    <section id="productHead">
        <h1>Movies</h1>
        <p><strong>At GOI</strong></p>
    </section>

    <div class="topMovies">
        <h2>Top 3 Movies</h2>
        <ol>
            <li>
                <div class="boxTopMovies">BULLET TRAIN</div>
            </li>
            <li>
                <div class="boxTopMovies">AVATAR THE WAY OF WATER</div>
            </li>
            <li>
                <div class="boxTopMovies">THOR: LOVE AND THUNDER</div>
            </li>
        </ol>
    </div>

    <aside>
        <h2>NOTICE</h2>
        <p>Effective from 11.59pm on Friday April 22 2022 customers will no longer be required to check-in
            using
            the Victorian Services App or to show proof of vaccination status. Furthermore, cinema staff are no
            longer required to wear a face mask when serving customers following a change in COVID-safe guidance
            from the Victorian state government. Customers are not required to wear a facemask when attending
            the venue. - <a href="index.html">GOI Cinemas</a>
        </p>
    </aside>

    <div id="moviesContainer">
        <?php while ($row = mysqli_fetch_assoc($movies)) { ?>
            <section class="movieCard">
                <img class="movieImg" src="<?= $row['image_ref'] ?>.jpeg" alt="<?= $row['movie_name'] ?>">
                <h2>
                    <?= $row['movie_name'] ?>
                </h2>
                <p>
                    <?= $row['movie_desc'] ?>
                </p>
                <table class="movieShowTimes">
                    <tr>
                        <th>Day</th>
                        <th>Timing</th>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td>5.30pm</td>
                    </tr>
                    <tr>
                        <td>Sunday</td>
                        <td>10.30am</td>
                    </tr>
                </table>
                <h4>Captions</h4>
                <ul>
                    <li>English</li>
                    <li>Arabic</li>
                    <li>Chinese</li>
                </ul>

                <!-- NOTE: Feature selection has been moved to the payments page -->

                <a href='payment.php?movie_id=<?= $row['movie_id'] ?>'>
                    <div class="movieBookTicket">
                        Book a ticket!
                    </div>
                </a>
            </section>
        <?php } ?>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>

</html>