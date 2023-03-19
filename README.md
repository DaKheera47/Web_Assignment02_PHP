# PHP Student ECommerce Project

This project serves as a simple example of a PHP application. It is a simple ecommerce site that allows users to browse products, add them to a cart, and checkout.

The database is a simple MySQL database with only a few different tables. The database is stored on the vesta server and is accessible via phpMyAdmin.

Here are a few of the features of the webapp:
1. The user can browse products and add them to a cart.
2. The checkout prices have a discount applied based on if an offer was chosen or not.
3. The checkout price is calculated after adding a shipping cost and tax. (The tax is 21%, and the shipping cost is 10% of the total price.)
4. Every effort was made to sanitize user input.
5. Every effor was made to prevent the page from reloading when a user clicks a button, which would cause the page to flash.