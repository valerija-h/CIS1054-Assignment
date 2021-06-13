<?php include ('nav.css');?>

<div id="nav">
<ul>
    <!--Inputs every page as a link in the header-->
    <?php
    foreach($nav as $item){  //elements fetched from array.php
        //If the link is the product page -- creates dynamic drop down bar elements based on products in XML document.
        if($item[link] == "products.php"){

            echo "<li class=\"dropdown\"><a href=\"$item[link]\" >$item[name]</a>";
            echo "<div class=\"dropdown-content\">";
            echo "<div class=\"row\">";

            foreach ($categories->category as $category){
                if(!$category->parent_id){ //if the category does not have a parent id, it means that it is the Parent.
                    echo "<div class=\"column\">";
                    echo "<a href=\"products.php?cat=$category->id\"><h3>$category->name</h3></a>"; //display the category name 
                 
                    foreach ($categories->category as $subcategory) { 
                        if(strcmp(($subcategory->parent_id), $category->id) == 0) { //if the id in the sub category pointing to its parent, mathces the id of the category display the subcategory's name
                            echo "<a href=\"products.php?subcat=$subcategory->id&cat=$category->id\">$subcategory->name</a>";
                        }
                    } echo "</div>";
                }
            }
            echo "</div>";
            echo "</div>";
            echo"</li>";
        } else {
            //Else displays each main web page in navigation bar from the arrays.php file.
            echo "<li><a href=\"$item[link]\">$item[name]</a></li>";
        }
    }

        //Cart icon links to cart.php
    echo "<div style=\"float:right\"><a href=\"cart.php\"><i class=\"material-icons\" >&#xe8cc;</i></a></div>";

    ?>
    
    <!--Search Container links to search.php-->
    <div class="search-container">
        <form method="post" action="search.php">
            <input type="text" placeholder="Search..." name="search" required>
            <button type="submit" name="search_submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</ul>
</div>
