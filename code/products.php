<?php
//Title of the current page.
define("TITLE", "Products | SKULL Gaming");
//Includes the header file.
include 'Includes/header.php';
//Includes a list of links to product categories.
include 'Includes/list.php';
/* ---------------- Displaying Products ---------------- */
    //If 'subcat' appears in the link, displays all the products of the specific subcategory.
    if(isset($_GET['subcat'])){
        echo"<div id=\"products\">";
        //Removes any unwanted characters and extracts the string after 'subcat' from the link.
        $subcategory_choice =strip_bad_chars($_GET['subcat']);
        //Accessing each product in the products database.
        foreach($products->product as $product){
            //If the product has the same category id from the link.
            if(strcmp(($product->category_id), $subcategory_choice) == 0){
                //Displays some of the details of the product.
                echo"<div class=\"item\">
                     <a href='products.php?prod=$product->id'><img src='$product->img'></a><br>
                     <h1>$product->name</h1>
                     <h2>€ ".number_format((float)$product->price, 2, '.', ',')."</h2></div>";
            }
        } echo"</div>";
    //If only 'cat' appears in the link, displays all the products of the specific category.
    } elseif (isset($_GET['cat'])){
        echo"<div id=\"products\">";
        //Removes any unwanted characters and extracts the string after 'cat' from the link.
        $category_choice =strip_bad_chars($_GET['cat']);
        //Accessing each category in the products database.
        foreach($categories->category as $category){
            //If a subcategory has the same parent category id as the category id from the link.
            if(strcmp(($category->parent_id), $category_choice) == 0){
                //Accessing each product in the database.
                foreach($products->product as $product){
                    //Displays the products of that subcategory.
                    if(strcmp(($product->category_id), $category->id) == 0){
                        //Displays some of the details of the product.
                        echo"<div class=\"item\">
                             <a href='products.php?prod=$product->id'><img src='$product->img'></a><br>
                             <h1>$product->name</h1>
                             <h2>€ ".number_format((float)$product->price, 2, '.', ',')."</h2></div>";
                    }
                }
            }
        } echo"</div>";
    //If only 'prod' appears in the link, displays all the products of the specific category.
    } elseif (isset($_GET['prod'])) {
        echo"<div id=\"product\">";
        //Removes any unwanted characters and extracts the string after 'prod' from the link.
        $product_choice =strip_bad_chars($_GET['prod']);
        //Accessing each product in the products database.
        foreach($products->product as $product){
            //If the product has the same product id from the link.
            if(strcmp(($product->id), $product_choice) == 0){
                //Displays all of the details of the product.
                echo "<div class=\"item\">
                      <h3>$product->name</h3><br>
                      <img src='$product->img'>
                      <h2>€ $product->price</h2>
                      <p>$product->description</p>
                      <button onclick=\"goBack()\">Go Back</button>
                      <form class=\"cart_form\" action=\"cart.php?action=add&prod=$product->id\" method=\"post\">
                          <input name=\"quantity\" placeholder=\"Quantity\" type=\"text\" required>
                          <button type=\"submit\" name=\"cart_submit\">Add to cart</button>
                      </form></div>";
            }
        }echo"</div>";
    } else {
    //Displays all the products in the database.
        echo"<div id=\"products\">";
        //Accessing each product in the products database.
        foreach($products->product as $product){
                //Displays some of the details of the product.
                echo"<div class=\"item\">
                     <a href='products.php?prod=$product->id'><img src='$product->img'></a><br>
                     <h1>$product->name</h1>
                     <h2>€ ".number_format((float)$product->price, 2, '.', ',')."</h2></div>";
        }echo"</div>";
    }
//Includes footer file.
include 'Includes/footer.php';
?>



