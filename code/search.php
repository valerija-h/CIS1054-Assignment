<?php
//Title of the current page.
define("TITLE", "Products | SKULL Gaming");
//Includes the header file.
include 'Includes/header.php';
//Includes a list of links to product categories.
include 'Includes/list.php';
//If the search button has been successfully activated.
if (isset($_POST['search_submit'])) {
    //Extracts string from the search input field and removes whitespaces and other unnecessary characters.
    $search = trim($_POST['search']);
    //Variable is false if no such products exist.
    $found = false;
}
?>
<div id="products">
<?php
//Accessing each product in the database.
foreach ($products->product as $product) {
    //If the $search variable is a substring in the products name (case-insensitive).
            if (stripos($product->name, $search) !== false) {
                //Signifying at least one similar product has been found.
                $found = true;
                //Displays the details of the product.
                echo "<div class=\"item\">
                         <a href='products.php?prod=$product->id'><img src='$product->img'></a><br>
                         <h1>$product->name</h1>
                         <h2>€ ".number_format((float)$product->price, 2, '.', ',')."</h2>
                         </div>";
            }
}
//Executes no similar products were found.
if($found == false){
    //Displays a message that no such products were found on the page.
    echo "<h1 class='warning'>No products known as \"$search\" were found.</h1>";
}
?> </div> <?php
//Includes the footer file.
include 'Includes/footer.php';
?>
