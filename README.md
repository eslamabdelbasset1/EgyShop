# A full-featured Online Shop

## Basic User Functionality

- User friendly interface.
- Responsive design.
- Secure and reliable shopping.
- Pleasurable browsing of categorized products.
- Directly buy goods without intermediary service.
- Receive email about order status.
- Checking for most reliable goods rated by other consumers.
- Adding review for products.
- Adding and managing products in cart.
- Searching by name.
- Filter by rates, date, sales, top reviews, reviews count, price.
- Getting related products.
- Scrolling via infinity scroll.
- Following favorite products for discount.
- Receiving email for every change.
- Managing your account.
- Adding profile picture for reviews.
- Automatic image cropping.
- Restoring forgotten password by email.
- Indexing in database for fast search

## Basic Administrator Functionality

- User friendly admin panel.
- Adding super categories, categories, subcategories and specifiactions.
- Creating and editing products.
- Automatic image cropping.
- Adding discounts for certain products .
- User management and moderators.
- Managing reviews.

## Used technologies

- MySQL Database.
- Back-end by Laravel.
- Front-end by HTML, CSS and JS.
- Libraries: Bootstrap, JQuery, Font Awesome, Tostar.
- Others: FlexSlider, laravel intervention image, ImageZoom, Infinity Scroll W3 Slider, Google Fonts, Composer, PHP Mailer, Xampp, htaccess.

## Design patterns

- Front and Back-end division.
- Model View Controller (MVC).
- Data Access Objects (DAO).
- PHP Data Objects, Play Note PHP Object, constructors, classes.
- Folders categorized by namespaces.
- Singletons, autoloader.

## Documentation

- Executionable SQL script /Database SQL.sql to create MagBuy's database.
- The first registered user is Administrator - Role 3 in the database.
- Adminsitrator can change other users into moderators - from role 1 to role 2.
- Moderators can only manage products and orders.
- Every other user is with role 1.
- Administrator can block users.
- Administrators and Moderators can delete reviews.
- Administrators can delete supercategories, categories and subcategories, but doing that deletes
all child categories and sets products subcategory to null which makes them invisible for users.
- Profile editing on optional fields, including profile picture.
- Redirection to address field on checking out without filled address.
- Login redirection on checking out without being logged.
- The forgotten password system uses tokken verification.
- Tokken expires after 10 minutes.
- Email notification for checking out, changing order status and promotions for users who added the
promoted product in favourites.
- Uploaded images must be below 5MB and one of these types - jpg, jpeg, gif, png. 
- Friendly user validation for type and size of image.
- Error 400 Bad Request for adding/editing invalid product image for Admin/Moderators.
- Automatic custom function base on PHP for images are cropping.
- Adding new product, 3 images must be defined.
- Editing product, 3 images must be defined or none.
- You must first create Super category, Category, Subcategory and specifications
before creating new product.
- Have to create specifications for subcategory, before adding product.
- After adding product in certain subcategory, you can not add new specifications for it.
- You can create product for category without specifications for it.
- Responsive design - flexslider goes to simpler slider on lower resolution.
- In stock or not functionality when quantity is 0.
- Most sold filter is by products that have order status 3 (Completed), multiplied by the quantity of
ordered products.
- Restricted directory browsing by .htaccess. 
- Can not add promotion to invisible product.
- **NB: _If you are testing MagBuy on your own hosting service, be sure to approve the new device in MagBuy's central email or use your own for the different email functionalities, otherwise the email service won't work because it is using Gmail and every new device has to be approved for security reasons! You can use different email for different functions (order confirmation, order status, password reset and promotion). The email service code is in the corresponding controllers._**
