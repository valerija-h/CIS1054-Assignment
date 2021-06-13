<?php
//Title of the current page.
define("TITLE", "Contact Us | SKULL Gaming");
//Includes the header file.
include('Includes/header.php');
//Load's the company information database - 'company.xml'.
if(file_exists('Includes/company.xml')){
    $company = simplexml_load_file('Includes/company.xml');
} else {
    exit('File does not exist.');
}
//Simple function to check for header injections.
function has_header_injection($str) {
    return preg_match("/[\r\n]/", $str);
}
?>
<div id="contact">
    <div class="s1">
        <h2>Contact Us</h2>
        <?php
        //Executes if the submit form button was pressed by the user.
        if(isset($_POST['form_submit'])){
            //Gathering data from the user's HTML form and storing it in variables.
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            $mail_from = $_POST['email'];
            $message = $_POST['message'];

            //If header injections are found kill the script.
            if(has_header_injection($name) || has_header_injection($mail_from) || has_header_injection($subject))
                die();

            //Declaring a variable containing the company e-mail.
            $mail_to = "skullgaming.malta@gmail.com";

            //Constructing the message that will be sent to the company e-mail with the form details.
            $txt = "You have recieved an e-mail from ".$name." -- ".$mail_from.".\n\n".$message;
            $txt = wordwrap($txt,150); //Wraps the message so that it has max 150 characters per line.

            //Constructing the header content for the e-mail.
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "From: " . $name . " <" . $mail_from . ">\r\n";
            $headers .= "X-Priority: 1\r\n";
            $headers .= "X-MSMail-Priority: High\r\n\r\n";

            //Sends the e-mail to the company.
            mail($mail_to, $subject, $txt, $headers);
            ?>
            <!-- Displays message to user if form was submitted. -->
            <p>Thank you for contacting us. We will be leaving a reply shortly...</p>
            <button onclick="goBack()">Go Back</button>
        <?php
            //If the submit button was not pressed, the HTML form is displayed.
        }else{
            ?>
            <!-- -------------- Contact Form -------------- -->
        <form class="contact-form" action="" method="post">
            <p><label for="name">Full Name:</label>
                <input name="name" placeholder="Full name" type="text" required></p>
            <p><label for="email">E-mail:</label>
                <input name="email" placeholder="E-mail" type="email" required><br></p>
            <p><label for="subject">Subject:</label>
                <input name="subject" placeholder="Subject" type="text" required><br></p>
            <p><textarea name="message" placeholder="Please enter the message here..." required></textarea></p>
            <button type="submit" name="form_submit">Send</button>
        </form>
    <?php }?>
    </div>
    <hr>
    <br><br><br>
    <div class="s2">
        <!-- -------------- Company Information -------------- -->
        <!-- Each section below acquires information about the company from the company.xml database. -->
        <h2> Contact Information</h2><br>
        <div class="box"><br>
            <img src="Pictures/Contact_Us/location.png" alt="Location"><br>
            <h3>Address</h3>
            <div class="textbox">
                <!-- Displays the company address. -->
                <p><?php echo $company->{'address'}->location."<br>"?></p>
                <p class="boxh">Opening Hours</p>
                <!-- Displays the company opening hours. -->
                <p><?php echo $company->{'address'}->hours?></p>
            </div><br>
        </div>
        <div class="box"><br>
            <img src="Pictures/Contact_Us/email.png" alt="E-mail"><br>
            <h3>E-mail</h3>
            <div class="textbox">
                <!-- Displays the company e-mails. -->
                <?php foreach($company->{'emails'}->email as $email){
                    echo "<p class=\"boxh\">$email->name</p>";
                    echo "<p>$email->contact</p>";
                }?>
            </div>
        </div>
        <div class="box"><br>
            <img src="Pictures/Contact_Us/phone.png" alt="Phone"><br>
            <h3>Phone</h3>
            <div class="textbox">
                <!-- Displays the company phone numbers. -->
                <?php foreach($company->{'phones'}->phone as $phone){
                    echo "<p class=\"boxh\">".$phone->name."</p>";
                    echo "<p>$phone->number</p>";
                }?>
            </div>
        </div>
    </div>
    <br><br>
</div>
<?php
//Includes the footer file.
include('Includes/footer.php');
?>

