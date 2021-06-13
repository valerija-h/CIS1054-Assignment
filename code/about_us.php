<?php
//Title of the current page.
define("TITLE", "About Us | SKULL Gaming");
//Includes the header file.
include('Includes/header.php');
//Load's the employee information database - 'members.xml '
if(file_exists('Includes/members.xml')){
    $employees = simplexml_load_file('Includes/members.xml');
} else {
    exit('File does not exist.');
}
?>
<div id="about">
    <!-- Image and Heading at the top of the page. -->
    <div class="top">
        <img src="Pictures/About_Us/top2.jpg" style="width:100%; opacity:0.5">
        <div class="t-text">
    About Us
    </div></div>
    <!-- ---------- Description of Company ---------- -->
    <div class="description">
        <hr><br>
        <p>
            SKULL Gaming is a gaming hardware and video game retailer that is ready to supply all of your gaming needs.
            We provide our customers with the latest consoles, gaming platforms, video games and accessories.
            We aim to deliver solely products of a high quality standard and our goal is to achieve complete consumer satisfaction.
        </p>
            <h2>Meet the Team!</h2>
        <!-- List of employees and their information extracted from the employee database. -->
        <div class='employees'>
        <?php
        foreach($employees as $employee){
            echo "<div class='employee'>
                  <img src='$employee->img'><hr>
                  <h3>$employee->name</h3>
                  <h4>$employee->position</h4>
                  <p>$employee->description</p></div>";
        } ?>
        </div><p>
            SKULL Gaming was founded by Valerija Holomjova and Deborah Vella in Malta to issue a reliable gaming retailer for all local gamers.
            Both founders are students who are pursuing their studies at the University of Malta and are major gaming enthusiasts.
            SKULL Gaming provides a number of products of top-quality brands, a few of the major popular brands whose products we retail are displayed below.
        </p><br><hr>
    </div>
    <!-- Picture of company logos whose products we have used in our website. -->
    <img src="Pictures/About_Us/Logos.png" style="width:100%">
</div>
<?php
//Includes the footer file.
include('Includes/footer.php');
?>
