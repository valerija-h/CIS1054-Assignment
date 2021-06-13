<?php
define("TITLE", "Home | SKULL Gaming");
include('Includes/header.php');
?>

<div id="index">
    <div id="slideshow">
    <!--Creating a slideshow-->
    <!-- Slideshow container -->
    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="slides fade">
            <div class="numbers">1 / 4</div>
            <img src="Pictures/Index/horizon.jpg" style="width:100%">
        </div>
        <div class="slides fade">
            <div class="numbers">2 / 4</div>
            <img src="Pictures/Index/farcry.jpg" style="width:100%">
        </div>
        <div class="slides fade">
            <div class="numbers">3 / 4</div>
            <img src="Pictures/Index/uncharted.jpg" style="width:100%">
        </div>

        <div class="slides fade">
            <div class="numbers">4 / 4</div>
            <img src="Pictures/Index/gow.jpg" style="width:100%">
        </div>


        <!-- Next and previous buttons -->
        <a class="previous" onclick="changeSlides(-1)">&#171;</a> <!--passes -1 to the function changeSlides-->
        <a class="next" onclick="changeSlides(1)">&#187;</a>  <!--passes 1 to the function changeSlides-->
    </div>
    <br>
    <!-- The circles at the bottom of the slideshow -->
    <div style="text-align:center">
        <span class="dot" onclick="thisSlide(1)"></span>
        <span class="dot" onclick="thisSlide(2)"></span>
        <span class="dot" onclick="thisSlide(3)"></span>
        <span class="dot" onclick="thisSlide(4)"></span>

    </div>

    <script>
        var slideCounter = 1;
        display_Slides_2(slideCounter);

        // Next/previous controls
        function changeSlides(num) {
            display_Slides_2(slideCounter += num); 
        }

        // Thumbnail image controls
        function thisSlide(num) {
            display_Slides_2(slideCounter = num);
        }

        //Changes slides when clicking the next and previous arrows
        function display_Slides_2(num) {
            var i;
            var pic = document.getElementsByClassName("slides"); //get all elements that have a class of slides
            var circles = document.getElementsByClassName("dot");
            
            if (num > pic.length) 
            { slideCounter = 1 } 
            //if the slide number is greater than the amount of slides, set slideCounter equal to 1 to start from 1st picture again.

            if (num < 1) 
            { slideCounter = pic.length } 
            //if slide number is less than 1 set slide index equal to the length of the string pic

            for (i = 0; i < pic.length; i++) { //loops through pictures
                pic[i].style.display = "none"; //hides entire element keeping same dimensions and position
            }

            for (i = 0; i < circles.length; i++) { //loops through dots
                circles[i].className = circles[i].className.replace(" active", ""); //Activating the dots 
            }

            pic[slideCounter - 1].style.display = "block"; //displaying the picture
            circles[slideCounter - 1].className += " active"; //activate dots
        }

        /*Slideshow changing slides by itself*/
        var slideCounter = 0;
        display_Slides_1();

        function display_Slides_1() {
            var i;
            var pic = document.getElementsByClassName("slides");
            var circles = document.getElementsByClassName("dot");

            for (i = 0; i < pic.length; i++) {
                pic[i].style.display = "none";
            }

            for (i = 0; i < circles.length; i++) {
                circles[i].className = circles[i].className.replace(" active", "");
            }

            slideCounter++;
            if (slideCounter > pic.length) { slideCounter = 1 }
            circles[slideCounter - 1].className += " active";
            pic[slideCounter - 1].style.display = "block";
            setTimeout(display_Slides_1, 3000); // Change image every 3 seconds
        }
    </script>
    </div>

    <hr />

    <!--Image and description next to each other-->
    <div class="description">
        <img src="Pictures/Index/gaming.jpg" alt="gaming" width="650" height="300"/>
        <p>
            SKULL Gaming specialises in selling the latest games, gaming systems and consoles at affordable prices and
            is also renowned for excellent and professional after sales service.<br /> <br />
            Your orders are delivered right to your door in the span of 2 working days with a
            &euro;6 delivery charge.  On the other hand, we offer free delivery when spending &euro;150 or more! <br /><br />
            Above all, SKULL's aim is to give our customers the best gaming experience.
        </p>
    </div>

    <hr />

    <!--Displays the categories as picture links that direct the user to the products that fall under the clicked category-->
    <div class="rowpic">
        <?php foreach ($categories->category as $category) {
            if (!$category->parent_id) {
                echo "<div class=\"row1\">
                         <a href='products.php?cat=$category->id'><img src='$category->img'></a>
                         <div class=\"text\">$category->name</div>
                         </div>";
            }
        }
                    ?>
    </div>
</div>

<?php
include('Includes/footer.php');
?>
