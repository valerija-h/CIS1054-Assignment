<?php
define("TITLE", "Products | SKULL Gaming");
include 'Includes/header.php';
//Includes list of links to products on the left
include 'Includes/list.php';

function has_header_injection($str) {
    return preg_match("/[\r\n]/", $str); //in case an attacker injects other headers into the message
}

if(isset($_POST['payment_submit'])){ //if user clicked on confirm order button
    //gets the customer details
    $name = $_POST['name'];  
    $email = $_POST['email'];
    $credit_no = $_POST['card_no'];
    $address = $_POST['address_1']."\n".$_POST['address_2']."\n";
    $address .= $_POST['city']."\n".$_POST['country']." ".$_POST['post_code'];
    $total = $_POST['charge'];

    //If header injections are found kill the script.
    if(has_header_injection($name) || has_header_injection($email)){
        die();
    }

    //company email
    $company_email = "skullgaming.malta@gmail.com";

    $subject = "Order Placement by $email";

    $details = "Below are the order details:\n\n"."Address:\n".$address."\nCredit Number:\n".$credit_no."\nProducts:\n";

    $cart_size=sizeof($_SESSION['cart']);

    for($counter=0; $counter<$cart_size; $counter++) {
        foreach ($products->product as $product) {
            if(array_key_exists("$product->id" ,$_SESSION['cart'][$counter])) { //if product id exists in the cart store the quantity inside the variable $quantity
                $quantity = $_SESSION['cart'][$counter]["$item_id"];

                $details .= "Product ID: " .$product->id. "\nQuantity: ".$quantity."\n";
                //concatenate the product id and quantity with the details already stored above.
                }
        }
        }


    $details .= "\nOverall price order: ".number_format((float)$total, 2, '.', ','); //concatinate with the details, the overall price correct to 2 decimal places 
    $msg = $name." -- ".$email." has made a delivery.\n\n".$details; //msg using customer's name and email.  The details are outputted all
    $msg = wordwrap($msg,200); //when it reaches the length of 200 split the msg in new lines

    //Custom Built Headers.
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $headers .= "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= "X-MSMail-Priority: High\r\n\r\n";

    //Sends the e-mail - prebuilt function.
    mail($company_email, $subject, $msg, $headers); 
    //sends it to the company with the previously defined subject and the message to be sent 

    //removes all contents from the cart
    session_unset($_SESSION);
    session_destroy($_SESSION);
    $_SESSION['cart'] = array(); //create new Session

    ?>
<div id="checkout">
    <div class="display">
        <br><br><h2>Thank you for shopping with us!</h2>
    </div>
</div>
<?php }//end of if
else{
if(isset($_POST['checkout_submit'])){?> <!--If the user clicked checkout button in the cart page-->
<div id="checkout">
    <div class="display">
        <h1>Checkout Summary</h1>
        <button onclick="goBack()" class="all">Go Back</button>
        <div class="grid-container">
            <!--Will output products in shopping cart in the form of a table.  the Column headers are specified below-->
            <div class="grid-item"><h2>Product</h2></div>
            <div class="grid-item"><h2>Name</h2></div>
            <div class="grid-item"><h2>Unit Price</h2></div>
            <div class="grid-item"><h2>Quantity</h2></div>
            <div class="grid-item"><h2>Total Price</h2></div>

    <?php $cart_size=sizeof($_SESSION['cart']); 
    $overall_price = 0; //starting from 0 euros and accumulate price later

    for($counter=0; $counter<$cart_size; $counter++) { //loop through cart
        foreach ($products->product as $product) { //for each product, if its id exists in the cart execute code below
            if(array_key_exists("$product->id" ,$_SESSION['cart'][$counter])) {

                $quantity = (float) $_POST["$product->id"];
                //update cart quantity for email
                $_SESSION['cart'][$counter]["$item_id"] = $quantity;
                $total_price = (float) ($quantity)*((float) $product->price); //multiplies quantity of product with its price to gain the total price for that product
                $overall_price += (float) $total_price; //add the last calculated price to the contents inside the overall price

                //output Product details 
                echo "   <div class=\"grid-item\"><img src='$product->img'></div>
                         <div class=\"grid-item\"><h3>$product->name</h3></div>
                         <div class=\"grid-item\"><h3>€ ".number_format((float)$product->price, 2, '.', ',')."</h3></div>
                         <div class=\"grid-item\"><h3>$quantity</h3></div>
                         <div class=\"grid-item\"><h3>€ ".number_format((float)$total_price, 2, '.', ',')."</h3></div>";
            }
        }
    }?>
</div>
        <h4>Overall Price: € <?php echo number_format((float)$overall_price, 2, '.', ',');?></h4>
        <h2>Please fill out the form details below.</h2>
        <!--The code below creates text boxes for the user to enter the required details-->
        <form class="payment_form" action="" method="post">
            <p><label for="name">Full Name:</label>
                <input name="name" type="text" required></p>
            <p><label for="email">E-mail:</label>
                <input name="email"  type="email" required><br></p>
            <p><label for="card_no">Card number:</label>
                <input name="card_no" type="text" required><br></p>
            <div class="address">
            <p><label for="address_1">Address Line 1:</label>
                <input name="address_1" type="text" required><br></p>
            <p><label for="address_2">Address Line 2:</label>
                <input name="address_2" type="text" required><br></p>
            <p><label for="city">City</label>
                <input name="city"  type="text" required><br></p>
            <p><label for="country">Country:</label>
                <input name="country"  type="text" required><br></p>
            <p><label for="post_code">Postal Code:</label>
                <input name="post_code"  type="text" required><br></p>
            </div>
            <input type="hidden" name="charge" value='<?php echo $overall_price; ?>'>
            <button type="submit" name="payment_submit" class="all">Confirm Order</button> 
            <!--The button activates the submitting payment and sending an email procedure-->
        </form>
</div>
</div>

<?php }}
include 'Includes/footer.php';
?>
