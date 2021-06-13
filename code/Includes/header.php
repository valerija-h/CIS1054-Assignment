<?php
//To start a new session or resume an existing session.
session_start();

//Defining the company name as a constant for the footer.
define("COMPANY", "SKULL Gaming");
//Setting the timezone.
date_default_timezone_set('Malta/Europe');

//An array of website pages.
include('array.php');

//Loading the products database.
if(file_exists('Includes/products.xml')){
    $product_page = simplexml_load_file('Includes/products.xml');
} else {
    exit('File does not exist.');
}
//Variables used to access all products/categories in the database.
$categories = $product_page->categories;
$products = $product_page->products;

//Function used to remove unwanted characters. Used as a safety for links(URL).
function strip_bad_chars($input){
    $output = preg_replace("/[^a-zA-Z0-9_-]/", "", $input);
    return $output;
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Setting the title of the page. -->
    <title><?php echo TITLE; ?></title>
    <!-- ------------ Stylesheets ------------ -->
    <!--For Main-->
    <link rel="stylesheet" href="Stylesheet/style.css?">
    <!--For Index-->
    <link rel="stylesheet" href="Stylesheet/index.css?">
    <!--For Navigation Bar-->
    <link rel="stylesheet" href="Stylesheet/nav.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--For google icons usage-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        //Function to go back to previous page.
        function goBack() {
            window.history.back()
        }
    </script>
</head>
<body>
<!-- Company Logo -->
<div id="banner">
<img src="Pictures/Header/skull.png" alt="Skull Gaming" class="center" width="100" >
</div>
<!-- Navigation Bar -->
<?php include('Includes/nav.php') ?>