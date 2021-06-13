<div id="list">

    <div class="list_items">
    <?php

    echo "<a href=\"products.php\" class=\"all\"><h3>All Products</h3></a>";
    foreach ($categories->category as $category) {
        //if category has no parent id - it is primary category
        if(!$category->parent_id){
            echo "<a href=\"products.php?cat=$category->id\" class=\"cat\"><h3>$category->name</h3></a>";
            
            //for that primary category - display all its subcategories
            foreach ($categories->category as $subcategory){
                if(strcmp(($subcategory->parent_id), $category->id) == 0){
                    echo "<a href=\"products.php?subcat=$subcategory->id&cat=$category->id\" class=\"subcat\">$subcategory->name</a><br>";
                }
            }
        }
    }

    ?>
<br></div>
</div>