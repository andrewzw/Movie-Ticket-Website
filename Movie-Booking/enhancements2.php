<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="GOI Cinemas - Enhancements" />
    <meta name="keywords" content="HTML,CSS,Javascript" />
    <meta name="author" content="Gang of Islands" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>GOI Cinemas - Enhancements</title>
</head>

<body id='enhancementsBG'>
    <?php include_once 'includes/menu.php'; ?>


    <section id="enhancementContainer">
        <h1 class="assignment-related-page-title">PHP Enhancements</h1>

        <details>
            <summary>#1 - Manager login form (+logout)</summary>

            This enhancement puts the manager page behind an authentication form meaning only authorized individuals are allowed to acces it.
            The control flow for authentication is as follows:
            <ol>
                <li>Retrieve login form data via POST variables</li>
                <li>Query database to see if a user exists with the given password</li>
                <li>If not refresh the page and show an error message (passed in via query parameters)</li>
                <li>If the user exists redirect to the manager page and set the authenticaed flag in the session to true</li>
                <li>This session flag can be queried to see if the user is logged in and skip reauthenication.</li>
                <li>The logout button sets this flag to false and clears the session</li>
            </ol>

            This enhancement improves upon the requirements by providing security and the potential for future manager functionality depending on the user role.
        </details>

        <details>
            <summary>#2 - Extra manager reporting functionality </summary>

            This enhancement allows the manager to generate a report based on complex queries in a certain time range (e.g., July 2022 - Oct 2022). Managers will be able to see information such as the most popular movie, average number of orders per day, etc.

            When the manager requests the report, the server will execute a number of queries to retrieve the data from the database and display the results in a table, this organizes the data and allow managers to only view the data relevant to the business operation.
        </details>

        <details>
            <summary>#3 - Linking mutliple tables using foreign keys</summary>

            This enhancement utilizes our database to collaborate the 'orders' table with other tables such as 'contact_method', 'movies', and 'options' to remove redundancy when storing data.

            Creating different tables for different categories of data helps to create accuracy when inserting data as it eliminates data duplication and helps with flexibility as it easier to handle the increasing number of customer data.
            Relational databases also improve the readibility and ease of usage which allows developers to carry out complex queries.
        </details>

        <details>
            <summary>#4 - Autopopulating products page from database</summary>

            For this enhancement we are populating the products page from the database. In the database we have records of each product we offer for example, Black Panther. The images for these records are hosted online and the reference to that image is saved into the database. Doing it this way means that adding a product does not require us to add another section in the html. Instead, we can just add a new record into the database. This cuts down on extra code. The process for populating the products page is as follows:
            <ol>
                <li>Query the database and fetch all the movies </li>
                <li>Loop over all the rows and,</li>
                <li>Display all data in the movie card.</li>
            </ol>
        </details>

        <details>
            <summary>Extra - References</summary>

            <ul>
                <li>Background and other images: <a href="https://unsplash.com" target='_blank'>Unsplash</a></li>
                <li><a href="https://fedingo.com/how-to-prevent-direct-access-to-php-file/" target='_blank'>Denying direct access</a></li>
                <li>Movie descriptions and images:</li>
                <ul>
                    <li>
                        <a href="https://playandgo.com.au/top-gun-maverick-movie-review/">Top Gun</a>
                    </li>
                    <li>
                        <a href="https://www.imdb.com/title/tt10648342/">Thor</a>
                    </li>
                    <li>
                        <a href="https://www.orcasound.com/2022/06/11/paws-of-fury-the-legend-of-hank-new-trailer-and-poster-available/">Paws</a>
                    </li>
                    <li>
                        <a href="https://www.sonypictures.my/movies/bullet-train">Bullet Train</a>
                    </li>
                    <li>
                        <a href="https://www.imdb.com/title/tt9114286/">Black Panther</a>
                    </li>
                    <li>
                        <a href="https://www.imdb.com/title/tt1630029/">Avatar</a>
                    </li>
                </ul>
                <li>Learning resources</li>
                <ul>
                    <li><a href="https://www.w3schools.com/css/css_navbar.asp">W3 Navigation bar</a></li>
                    <li><a href="https://css-tricks.com/snippets/css/a-guide-to-flexbox">CSS Flexbox</a></li>
                    <li><a href="https://dev.to/webdeasy/top-20-css-buttons-animations-f41">Animated button gradient</a></li>
                </ul>
            </ul>
        </details>
    </section>

    <?php include_once 'includes/footer.php'; ?>
</body>

</html>