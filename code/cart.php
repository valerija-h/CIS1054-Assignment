<?php
define("TITLE", "Products | SKULL Gaming");
include 'Includes/header.php';
//Includes list of links to products on the left
include 'Includes/list.php';


function new_add_qty_cart($item_id,$item_qty){ //called when the added item isn't already in cart
 //this function adds the item id and its corresponding quantity to the cart Session
    array_push($_SESSION['cart'],array( $item_id => (int)$item_qty));
   
}

function add_qty_cart($item_id,$item_qty, $counter){

    $cart_size = count($_SESSION['cart']);

    for($counter =0; $counter<$cart_size; $counter++) {
        if(!$_SESSION['cart'][$counter][$item_id]){
            continue;  //program jumps to iteration
        }
        $_SESSION['cart'][$counter][$item_id] += $item_qty; //adds the newly entered quantity to the last stored quantity of a particular product.
    }
}


switch($_GET['action']){
    case"add":  //executes when user chooses add to cart
        //if the form was posted, execute the following code
        if(isset($_POST['cart_submit'])) {

            $item_id = strip_bad_chars($_GET['prod']); //removes unwanted characters in case someone tries to hack and alter the script.  function found in header.php
            $item_qty = $_POST['quantity'];

            //does not let the user buy more than 20 products from the same item.
            if($item_qty > 20){
                echo "<div 
                <div id= \"cart\">
                <div class=\"display\">
                <h1>Quantity cannot be greater than 20<h1>
                </div>
                </div>";
                goBack();
            }

            header('Location: cart.php');
             //changes the url to direct it to cart.php without any extra data so when it is refreshed it won't use the data passed through the add to cart.

            //if the session 'cart' isn't empty
            if (!empty($_SESSION['cart'])) {
                $flag = 0; //It will later stay set to 0 if item id is never found inside the cart

                //go through cart session
                $cart_size = count($_SESSION['cart']);  
                for($counter =0; $counter<$cart_size; $counter++) {
                    if (!$_SESSION['cart'][$counter]["$item_id"]){
                        continue; //jump to iteration
                    }
                    $flag = 1;  //set $flag equal to 1 when the item id already exists in the cart
                }

                if($flag == 0){
                    new_add_qty_cart($item_id, $item_qty); //calls the function that adds a product that was never added before
                } else {
                    add_qty_cart($item_id, $item_qty, $counter); //calls the function that adds only the quantity to an already existing product inside the cart
                }
               
            } else {
                //else create an array for session cart and add the product
                $_SESSION['cart'] = array();
                new_add_qty_cart($item_id, $item_qty);
            }
        }
        break; //end of 1st case

    case "remove":  //executes if user chooses to remove an item for the cart

        //gets passed product product id and quantity and removes extra characters for safe practices
        $item_id= strip_bad_chars($_GET['prod']);
        $item_qty= strip_bad_chars($_POST['qty']);
        $cart_size = sizeof($_SESSION['cart']);
        $counter=0;

          header('Location: cart.php');  //It redirects the user to cart.php page on refresh

        do
        {   //find the array with that product id
          
            if($_SESSION['cart'][$counter][$item_id]) {
                array_splice($_SESSION['cart'],$counter,1); //Remove the elements from the Session, found in the index pointed by $counter and removes 1 element
                break; //break the loop when element is removed
            }

            $counter++; //if the product id is not found increment the $counter to loop through the rest of the elements
        }while($counter<$cart_size);    //loop as long as $counter is less than the $cart_size
        break;  //end of 2nd case

        case "remove_all":
        //removes all contents from the cart
        session_unset($_SESSION);
        session_destroy($_SESSION); //destroys the Session not just the data
        $_SESSION['cart'] = array(); //recreate an empty Session

        break;  //end of 3rd case
}

$cart_size = sizeof($_SESSION['cart']);
?>

<!--DISPLAYS THE CART AND OPTIONS TO REMOVE OR SUBMIT-->
<div id="cart">
    <div class="display">
        <h1>My Shopping Cart</h1>
        <?php if($cart_size !== 0){ ?>
            <form class="checkout_form" action="checkout.php" method="post">
                <!--directs the website to checkout.php if submit is clicked-->
                <button type="submit" name="checkout_submit" class="all" >Checkout</button>
                <!--directs the website to cart.php if submit is clicked passing remove_all which is then used inside a switch case-->
                <button onclick= "window.location.href='cart.php?action=remove_all'" class="all" type="button" >Remove all items</button>
   <?php
   for($counter=0; $counter<$cart_size; $counter++) {   //loops through Session to output contents
	foreach ($products->product as $product) {
        if(array_key_exists("$product->id" ,$_SESSION['cart'][$counter])) { //check if the fetched product id exists inside the Session.  If it exists, output its details
            $quantity = $_SESSION['cart'][$counter]["$product->id"];
                        echo "<div class=\"item\">
                         <img src='$product->img'>
                         <h3>$product->name</h3><br>
                         <h2>Price per unit: € ".number_format((float)$product->price, 2, '.', ',')."</h2>
                         <h2>Quantity: <input name=\"$product->id\" value=\"$quantity\" type=\"text\"></h2>
                         <button onclick= \"window.location.href='cart.php?action=remove&prod=$product->id'\" type=\"button\">Remove Item</button>
                         </div>";
        }
	}
   }

?> </form>
        <?php }else{?>
        <br><br><br><br>
        <h4>The shopping cart is empty.</h4>    <!--If cart size is equal to 0 notify the user that the cart is empty-->
    <?php } ?>

    </div>
</div>

<?php include 'Includes/footer.php';
?>
