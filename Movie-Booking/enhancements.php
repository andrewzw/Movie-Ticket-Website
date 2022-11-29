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
        <h1 class="assignment-related-page-title">Enhancements</h1>

        <details>
            <summary>#1 - Mobile first design</summary>

            With over <a href="https://xd.adobe.com/ideas/process/ui-design/what-is-mobile-first-design/">60% of
                internet traffic coming from mobile phones</a> it is important that websites are designed with smaller
            screens in mind.
            For GOI cinemas we used media queries to change the layout of the website according to screen size
            thresholds.
            This can be seen in the <a href="index.html">Home</a> page with the info cards, in the
            <a href="about.html">About</a> page with the definition list as well as in the
            <a href="enquire.html">Enquire</a> page to change the orientation of form fieldsets.
            We used this to our advantage to hide the GOI logo on screen less than 992px to imporve user experience.
        </details>

        <details>
            <summary>#2 - Lots of animations</summary>

            Animations can be used to attract attention, engage people better, and communicate more clearly and
            effectively than just static websites.
            We have made use of animation on the <a href="index.html">Home</a> page with the title section floating in
            from the top as well as the animated background images and in the <a href="enquire.html">Enquire</a> page to
            scale the form and animate the color of the submit button.
            The code to implement this feature makes use of <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Animations/Using_CSS_animations">CSS
                animations</a> which include setting up keyframes and specifying animation properties like duration,
            delay and direction.
        </details>

        <details>
            <summary>#3 - Rotating image slideshow</summary>

            To add some pizzazz to the <a href="about.html">About</a> page we opted to use a rotating image gallery
            instead of simple static portraits.
            This feature was implemeted with animations (described above) as well as transforms 3D CSS properties.
            Due to this being a complex feature to implement we used a multitude of references including
            <a href="https://www.youtube.com/watch?v=zBx46XOx0B0">this tutorial</a> and
            <a href="https://www.youtube.com/watch?v=j1-Ak3WWV_g">this one</a>.
        </details>

        <details>
            <summary>#4 - This very accordion</summary>

            We wanted to implement dynamic features to our website without using JavaScript.
            After some researach we found out about
            <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details">details disclosure element</a>
            which can be used to make an accordion like dropdown.
            This helps in grouping similiar page contents into a toggleable section which the user can show and hide.
            The default styling for this element doesn't look very good so we had to heavily customized it styling
            (borders, padding and colors) with CSS to fit our theme.
        </details>

        <details>
            <summary>Extra - References</summary>

            <ul>
                <li>Background and other images: <a href="https://unsplash.com" target='_blank'>Unsplash</a></li>
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