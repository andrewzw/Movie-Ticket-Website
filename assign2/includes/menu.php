<?php

// Only put logout when in manager pages
$logout = in_array(basename($_SERVER['PHP_SELF']), array("manager.php", "report.php", "edit_order.php")) ? "<a href='logout.php'>Logout</a>" : "";

echo
"
<nav>
    <a href='index.php'>Home</a>
    <a href='product.php'>Products</a>
    <a href='login_form.php'>Manager</a>
    <a href='about.php'>About</a>
    <a href='enhancements2.php'>Enhancements</a>
    <a target='_blank' href='https://youtu.be/q_vfkndt-6U'>Video</a>
    "
    .
    $logout
    .
    "
    <div class='logoContainer'>
        <a href='index.php'>
                <img src='./images/preview/Logo.png' alt='Logo'>
        </a>
    </div>
</nav>
";
