# Building a Dynamic Website using PHP

For the assessment of the 'Principles of Web Application Architecture' unit, based on the principles discussed throughout the course as well as knowledge gained through individual online-learning, students were asked to group up and build a <b>dynamic website</b> for a business of their choice while fulfilling the following requirements (`assignment.pdf`):
<ul>
  <li>generic information about the business (e.g. address, opening hours) and the people running it</li>
  <li>a form allowing users to contact the business (e.g. send query or complaint) whiich should be sent to the business owner containing all details on the form</li>
  <li>a list of products sold by company and individual product pages with more details</li>
  <li>a search facility for products (based on their names)</li>
  <li>a <b>shopping cart feature</b> and <b>checkout page</b>:
    <ul>
      <li>the shopping cart requires the use of session management technology</li>
      <li>user should be able to modify their cart (e.g. delete items) on checkout</li>
      <li>an email with customer/cart details should be sent to business owner after checkout</li>
      <li>a payment facility</li>
    </ul>
  </li>
  <li>a good user experience (via proper use of CSS and JS)</li>
  <li>product pages (and product-details) should be dynamically generated based on a structured data file (e.g. XML, CSV) to allow non-technical users to modify their site conttent independently</li>
</ul>

## Our Solution
For the project, our team created a website for a company called SKULL Gaming, through which this company can sell their products such as gaming systems, consoles, peripherals and games. This application is created for the benefit video gaming enthusiasts who are keen on buying the latest gaming technologies out in the market. 

The customers can access multiple pages which can be accessed from the navigation bar or other links found throughout the website. The pages are:
<li><b>Home page</b>: Welcomes the user with a slideshow, description of company and links for products</li>
<li><b>About Us page</b>: gives a more in-depth description of the company and the team</li>
<li><b>Contact Us page: a form is used to allow the user to send a message to SKULL Gaming company. At the bottom the company’s address, emails and telephone numbers are printed.</li>
<li><b>Products page</b>: lists all products, provides links to different categories of products on the left-hand side of screen</li>
<li><b>Product page</b>: shows the details of the chosen product from the Products page. Displays a go back button, add to cart button and a field to specify the quantity in. this page is used also when customer searches for a specific item.</li>
<li><b>Shopping Cart page</b>: lists all products to be purchased together with their details. Allows the user to change quantity if need be. Buttons are provided to remove all items, remove one item and to checkout.</li>
<li><b>Checkout page</b>: lists all products to be purchased together with their details and total and overall prices. Text fields are outputted so that user enters his required personal data. Confirm order button and go back button are provided.</li>

SKULL Gaming has access to the databases in which products’ details, employees’ details and company details are stored. As a result, SKULL Gaming can alter, add and deleted their information without the need of any knowledge about code. The website generates information dynamically and therefore, any changes made in the databases from the company side will result in a change of information on the client-side of the website. Also, with every purchase made, the company is notified with an email.

The <b>DRY</b> principle has been implemented in the website by including the header file, footer file, navigation bar file and more instead of re-copying the code. These types of files can be found in the `Includes` folder.

<p align="center">
  <img src="https://github.com/valerija-h/ICS2208-Assignment/blob/main/screenshots/product.png" width="40%"/>
  <img src="https://github.com/valerija-h/ICS2208-Assignment/blob/main/screenshots/product-details.png" width="40%"/>
</p>
<p align="center"><b>Figure 1</b> - Example full-page screenshots of the website on the product (left) and product-details (right) pages</p>
