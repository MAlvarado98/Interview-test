# Introduction

I really appretiate this oportunity. This was my first time developing with Laravel and VueJS. It was a funny and very frustrating task learn about Laravel and Vue in 6 days. It was sad I coul'd use Spatie Media Library but surely I'm going to use it in my future projects. Regards!

# Project specifications

## Project WEB routes

Web routes are specified inside **./resources/js/router.js**
Routes that are used by Vue Router.

- **/** - Gets the home page with all products
- **/products/{category]** - Gets all products of specific category
- **/login** - Page to login
- **/register** - Page to register a new user
- **/cart** - Here you can checkout your cart ( You can only access if you're logged in)
- **/editUser** - Page that allows logged user to make modifications to itself
- **/admin** - Page that allows administartor to decide if he wants to edit users or products ( Only logged users with administartor role can access)
- **/admin/users** - Page that allows administrator to CRUD users
- **/admin/products** - Page that allows administartor to CRUD products
- **/products/{id}/{productSlug}** - Page that returns product details and option to add to cart

## Project API routes

API routes are specified inside default API file **./routes/api.php**

- **get(api/products)** - Returns all products
- **get(api/products/{category})** - Returns products by category
- **get(api/{id}/{productSlug})** - Returns an specific product
- **post(api/products)** - Allows to register a new product only if authenticated and role is 2 (administrator)
- **put(api/products/{id})** - Allows to update a product only if authenticated and role is 2 (administrator)
- **delete(api/products/{id})** - Allows to delete product only if authenticated and role is 2 (administrator)

- **post(api/users/login)** - Returns a token and user only if json body is correct and user exists
- **post(api/users/regiser)** - Returns a token and user only if json body is correct and user doesn't exist
- **get(api/users/)** - Returns all users that ar not administrators only if logged in and role is 2
- **post(api/users/)** - Allows to create an user only if logged in and role is 2
- **get(api/users/{id})** - Allows to get an specific uiser only if logged in and role is 2
- **get(api/users/current)** - Allows to current user only if logged in
- **put(api/users/{id})** - Allows to update an user only if logged in and role is 2
- **delete(api/users/{id})** - Allows to delete an user only if logged in and role is 2

- **get(api/cart/)** - Returns all products in cart only if authenticated
- **post(api/cart/)** - Allows to insert into cart only if authenticated
- **put(api/cart/)** - Allows to add or substract products from cart only if authenticated
- **delete(api/cart/{id})** - Allows to delete from cart only if authenticated
- **delete(api/cart/all)** - Allows to delete an item from cart only if authenticated
- **get(api/cart/checkout/submit)** - Allows to submit cart and removes all cart items, couldn't validate information, only if authenticated

## Project issues

Learn about Laravel and Vue fullstack in one week has been a funny experiencie. however, problems have arisen due to my inexperience.

- **No usage of Vuetify**. It's sad not have used Vuetify due to its bueaty. It's very simple and obviously extremely comfortable to use. Sadly, I didn't have the enought experience to use it. If i decided to use it in my project, frontend development would have taken me longer than expected.
- **No usage of Spatie Media Library**. This was the most frustating issue. I have correctly installed the module, made it's public documents and migrations, but it just didn't work. I tried to downgrade its version, hoping it was the issue (It didn't solve it), but I knew it wasn't [because the project meets the requirements](https://docs.spatie.be/laravel-medialibrary/v8/requirements/). The last thig I should've done was reinstall laravel, but because of my lack of experience, I was not going to be able to finish before the deadline if I did it. I know I would easily use this library if this problem haven't presented.
- **Unlogged user can't add products to cart**. This is the worst problem to me, because I know how to do it, but sadly I didn't know this until I saw your example page. At that time I hadn't enough time to make the required changes.