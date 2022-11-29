<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="GOI Cinemas - Enquire" />
    <meta name="keywords" content="HTML,CSS,Javascript" />
    <meta name="author" content="Gang of Islands" />
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>GOI Cinemas - Payment</title>
</head>

<!-- Follow PHP convention of snake_case for input name and HTML convention of camelCase for labelling -->

<body id="enquiryBG">
    <?php include_once 'includes/menu.php'; ?>

    <div id="enquiryContainer">
        <form id="enquiryForm" method='post' action="process_order.php" novalidate>
            <fieldset class="formFieldset">
                <legend>Your Details</legend>
                <!-- Forward the movie id through post -->
                <input type="text" name="movie_id" value="<?= $_GET['movie_id'] ?>" hidden>

                <div class="formGroup">
                    <label for="firstName">First Name: </label>
                    <input type="text" name="first_name" id="firstName" pattern="[A-Za-z]{1,25}" placeholder="First Name" required />
                </div>

                <div class="formGroup">
                    <label for="lastName">Last Name: </label>
                    <input type="text" name="last_name" id="lastName" pattern="[A-Za-z]{1,25}" placeholder="Last Name" required />
                </div>

                <div class="formGroup">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="name@email.com " required />
                </div>

                <div class="formGroup">
                    <label for="phone">Phone: </label>
                    <input type="text" name="phone" id="phone" pattern="[0-9]{10}" placeholder="0123456789" required />
                </div>

                <div class="formGroup">
                    <label for="street">Street: </label>
                    <input type="text" name="street" id="street" maxlength="40" placeholder="Street Name" required />
                </div>

                <div class="formGroup">
                    <label for="state">State: </label>
                    <select name="state" id="state">
                        <option value="">Please Select</option>
                        <option value="NSW">New South Wales</option>
                        <option value="VIC" selected>Victoria</option>
                        <option value="WA">Western Australia</option>
                        <option value="TAS">Tasmania</option>
                        <option value="NT">Northern Territory</option>
                        <option value="ACT">Australian Capital Territory</option>
                        <option value="QLD">Queensland</option>
                        <option value="SA">South Australia</option>
                    </select>
                </div>

                <div class="formGroup">
                    <label for="postCode">Post code: </label>
                    <input type="text" name="post_code" id="postCode" pattern="[0-9]{4}" placeholder="0123" required />
                </div>

                <div class="formGroup">
                    <label for="contactMethod">Contact Method: </label>
                    <select name="contact_method_id" id="contactMethod">
                        <option value="1" selected="selected">Phone</option>
                        <option value="2">Email</option>
                        <option value="3">Post</option>
                    </select>
                </div>

                <!-- Submits an id corresponding to the contact_method database table -->
                <div class="formGroup">
                    <label for="options">Product Options: </label>
                    <select name="option_id" id="options">
                        <option value="1" selected="selected">Adult tickets $15</option>
                        <option value="2">Senior tickets $10</option>
                        <option value="3">Child tickets $8</option>
                    </select>
                </div>

                <div class="formGroup">
                    <label for="ticketQuantity">Ticket quantity: </label>
                    <input type="text" name="tickets_quantity" id="ticketQuantity" pattern="[0-9]{4}" placeholder="1" required />
                </div>
            </fieldset>

            <fieldset class="formFieldset">
                <legend>Payment Details</legend>

                <div class="formGroup">
                    <label for="card">Accepted Cards</label>
                    <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                    </div>
                </div>

                <div class="formGroup">
                    <label for="ccType">Card Type: </label>
                    <select name="cc_type" id="ccType">
                        <option value="visa" selected>Visa</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="americanExpress">American Express</option>
                    </select>
                </div>

                <div class="formGroup">
                    <label for="ccName">Name on Card </label>
                    <input type="text" name="cc_name" id="ccName" placeholder="Name" />
                </div>

                <div class="formGroup">
                    <label for="ccNum">Credit card number</label>
                    <input type="text" name="cc_num" id="ccNum" placeholder="1111-2222-3333-4444">
                </div>

                <div class="formGroup">
                    <label for="expMonth">Expiry Month</label>
                    <select name="exp_month" id="expMonth">
                        <option value="01" selected>01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>

                <div class="formGroup">
                    <label for="expYear">Expiry Year</label>
                    <select name="exp_year" id="expYear">
                        <option value="22" selected>22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                    </select>
                </div>

                <div class="formGroup">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123">
                </div>

                <div class="enquirySubmitBtn">
                    <input type="submit" value="Make Payment">
                </div>
            </fieldset>

            <div id="enquiryFormImg">
                <p>Payment</p>
            </div>
        </form>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>

</html>