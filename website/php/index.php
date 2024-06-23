<?php
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: sign-in.php");
    exit(); 
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add_to_cart') {
    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];
    $book_author = $_POST['book_author'];
    $book_price = $_POST['book_price'];
    $book_image = $_POST['book_image'];
    $item = [
        'id' => $book_id,
        'title' => $book_title,
        'author' => $book_author,
        'price' => $book_price,
        'image' => $book_image,
        'quantity' => 1
    ];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Check if the item already exists in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $book_id) {
            $cart_item['quantity']++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BookHeaven - Your one-stop online bookstore with up to 75% off on a wide range of books. Discover new arrivals, featured books, and special deals.">
    <title>Online-Book-Store</title>
    <link rel="shortcut icon" href="../images/open-book.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- header section -->
<header class="header">
    <div class="header-1">
        <a href="#" class="logo"><i class="fas fa-book"></i>BookHeaven </a>
        <form action="https://www.google.com/search" class="search-form">
            <input type="search" name="q" placeholder="search here.." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>
        <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <ul>
                <li><a href="../html/favorite.html" class="fas fa-heart "></a></li>
                <li><a href="cart.php" class="fa-solid fa-cart-shopping "></a></li>
                <li>
                    <div class="dropdown">
                        <a href="#" class="fa-solid fa-user dropbtn" ></a>
                        <div class="dropdown-content">
                            <a href="#"><b><?php echo $_SESSION['user_name']; ?></b></a>
                            <a href="profile.php" style="font-size:20px;">Edit</a> <hr>
                            <a href="/website/html/help.html" style="font-size:20px;"> Get-Help</a>  <hr>
                            <a href="/website/php/logout.php" style="font-size:20px;">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>           
        </div>
    </div>
    <div class="header-2">
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#featured">Featured</a>
            <a href="#arrivals">Arrivals</a>
            <a href="#reviews">Reviews</a>
            <a href="#blogs">Blogs</a>
        </nav>
</header> 
<nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#featured" class="fas fa-list"></a>
    <a href="#arrivals" class="fas fa-tags"></a>
    <a href="#reviews" class="fas fa-comments"></a>
    <a href="#blogs" class="fas fa-blog" ></a>
</nav>
<!-- home section -->
 <section class="home" id="home">
    <div class="row">
        <div class="content">
            <h3>upto 75%off</h3>
            <p>"Indulge in the magic of books with our online bookstore, offering up to 75% off. Immerse yourself in captivating stories at irresistible prices."</p>
            <a href="#" class="btn">shop now</a>
        </div>
        <div class="swiper book-slider">
            <div class="swiper-wrapper">
                <a href="#" class="swiper-slide"><img src="../images/book1.jpeg" alt=""></a>
                <a href="#" class="swiper-slide"><img src="../images/book2new.jpg" alt=""></a>
                <a href="#" class="swiper-slide"><img src="../images/book3new.jpg" alt=""></a>
                <a href="#" class="swiper-slide"><img src="../images/book4.jpg" alt=""></a>
                <a href="#" class="swiper-slide"><img src="../images/book5.jpg" alt=""></a>
                <a href="#" class="swiper-slide"><img src="../images/book12.jpg" alt=""></a>
            </div>
        </div>
    </div>
 </section>
<!-- offer icon section -->
 <section class="icon-container">
    <div class="icons">
        <i class="fas fa-plane"></i>
        <div class="content">
            <h3>free shipping</h3>
            <p>order over ₹100</p>
        </div>
    </div>
    <div class="icons">
        <i class="fas fa-lock"></i>
        <div class="content">
            <h3>secure payment</h3>
            <p>100 secure payment</p>
        </div>
    </div>
    <div class="icons">
        <i class="fas fa-redo-alt"></i>
        <div class="content">
            <h3>easy returns</h3>
            <p>10 days returns</p>
        </div>
    </div>
    <div class="icons">
        <i class="fas fa-headset"></i>
        <div class="content">
            <h3>24/7 support</h3>
            <p>call us anytime</p>
        </div>
    </div>
 </section>
<!-- featured section -->
<section class="featured" id="featured">
    <h1 class="heading"><span>featured books</span></h1>
    <div class="swiper featured-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book1.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>The Fall</h3>
                    <div class="price">₹159<span>₹209</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="1">
                        <input type="hidden" name="book_title" value="The Fall">
                        <input type="hidden" name="book_author" value="Jared Muralt">
                        <input type="hidden" name="book_price" value="₹159">
                        <input type="hidden" name="book_image" value="../images/book1.jpeg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book2new.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Always Isn't Forever</h3>
                    <div class="price">₹159<span>₹209</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="2">
                        <input type="hidden" name="book_title" value="Always Isn't Forever">
                        <input type="hidden" name="book_author" value="J.C. Cervantes">
                        <input type="hidden" name="book_price" value="₹159">
                        <input type="hidden" name="book_image" value="../images/book2new.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book3new.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Waves</h3>
                    <div class="price">₹199<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="3">
                        <input type="hidden" name="book_title" value="Waves">
                        <input type="hidden" name="book_author" value="Ingrid Chabbert and Carole Maurel">
                        <input type="hidden" name="book_price" value="₹199">
                        <input type="hidden" name="book_image" value="../images/book3new.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book4.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Power Of Now</h3>
                    <div class="price">₹159<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="4">
                        <input type="hidden" name="book_title" value="The Power Of Now">
                        <input type="hidden" name="book_author" value="Eckhart Tolle">
                        <input type="hidden" name="book_price" value="₹159">
                        <input type="hidden" name="book_image" value="../images/book4.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book5.jpg" alt="">
                </div>
                <div class="content">
                    <h3>We Were Restless Things</h3>
                    <div class="price">₹199<span>₹2099</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="5">
                        <input type="hidden" name="book_title" value="We Were Restless Things">
                        <input type="hidden" name="book_author" value="Cole Nagamatsu">
                        <input type="hidden" name="book_price" value="₹199">
                        <input type="hidden" name="book_image" value="../images/book5.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book12.jpg" alt="">
                </div>
                <div class="content">
                    <h3>You've Reached Sam</h3>
                    <div class="price">₹159<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="6">
                        <input type="hidden" name="book_title" value="You've Reached Sam">
                        <input type="hidden" name="book_author" value="Jared Muralt">
                        <input type="hidden" name="book_price" value="₹159">
                        <input type="hidden" name="book_image" value="../images/book12.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book7new.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Not Here To Be Liked</h3>
                    <div class="price">₹199<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="7">
                        <input type="hidden" name="book_title" value="Not Here To Be Liked">
                        <input type="hidden" name="book_author" value="Jared Muralt">
                        <input type="hidden" name="book_price" value="₹199">
                        <input type="hidden" name="book_image" value="../images/book7new.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book14.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Ody Ssey</h3>
                    <div class="price">₹199<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="8">
                        <input type="hidden" name="book_title" value="The Ody Ssey">
                        <input type="hidden" name="book_author" value="Jared Muralt">
                        <input type="hidden" name="book_price" value="₹199">
                        <input type="hidden" name="book_image" value="../images/book14.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book11.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Defining Decade</h3>
                    <div class="price">₹190<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="9">
                        <input type="hidden" name="book_title" value="The Defining Decade">
                        <input type="hidden" name="book_author" value="Jared Muralt">
                        <input type="hidden" name="book_price" value="₹190">
                        <input type="hidden" name="book_image" value="../images/book11.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book15.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Lost Boy</h3>
                    <div class="price">₹159<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="10">
                        <input type="hidden" name="book_title" value="Lost Boy">
                        <input type="hidden" name="book_author" value="Jared Muralt">
                        <input type="hidden" name="book_price" value="₹159">
                        <input type="hidden" name="book_image" value="../images/book15.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="icons">
                    <a href="#" class="fas fa-search"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="../images/book18.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Majesties</h3>
                    <div class="price">₹180<span>₹299</span></div>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="book_id" value="11">
                        <input type="hidden" name="book_title" value="The Majesties">
                        <input type="hidden" name="book_author" value="Jared Muralt">
                        <input type="hidden" name="book_price" value="₹180">
                        <input type="hidden" name="book_image" value="../images/book18.jpg">
                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<!-- news letter section -->
<section class="newsletter">
    <form action="#" method="post">
        <h3 style="color: black;"><b>Subscribe for latest updates</b></h3>
        <input type="email" name="email" placeholder="Enter your email" id="emailaddress" class="box" required>
        <input type="submit" value="Subscribe" class="btn">
    </form>
</section>
 <!-- books arrival section -->
<section class="arrivals" id="arrivals">
    <h1 class="heading"><span>new arrivals</span></h1>
    <div class="swiper arrivals-slider">
        <div class="swiper-wrapper">
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book6.jpg" alt="">
                </div>
                <div class="content">
                    <h3>How Innovation Works</h3>
                    <div class="price">₹155 <span>₹299</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book2new.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Always Isn't Forever</h3>
                    <div class="price">₹159 <span>₹205</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book3new.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Waves</h3>
                    <div class="price">₹199 <span>₹299</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book4.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Power OF Now</h3>
                    <div class="price">₹158 <span>₹299</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book15.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Lost Boy</h3>
                    <div class="price">₹154 <span>₹205</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="swiper arrivals-slider">
        <div class="swiper-wrapper">
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book11.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Defining Decade</h3>
                    <div class="price">₹199 <span>₹299</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book7new.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Not Here To Be Liked</h3>
                    <div class="price">₹158 <span>₹299</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book14.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Ody SSey</h3>
                    <div class="price">₹154 <span>₹299</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book18.jpg" alt="">
                </div>
                <div class="content">
                    <h3>The Majesties</h3>
                    <div class="price">₹199 <span>₹299</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="../images/book10.jpg" alt="">
                </div>
                <div class="content">
                    <h3>How To Stop Worrying & Strt Living</h3>
                    <div class="price">₹555 <span>₹699</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
<!-- deal section -->
<section class="deal">
    <div class="content">
        <h3>deal of the day</h3>
        <h1>upto 50% off</h1>
        <p>"Indulge in the magic of books with our online bookstore, offering up to 50% off. Immerse yourself in captivating stories at irresistible prices."</p>
        <a href="#" class="btn">shop now</a>
    </div>
    <div class="image">
        <img src="../images/deal2.avif" alt="">
    </div>
</section>
<!-- review section -->
<section class="reviews" id="reviews">
    <h1 class="heading"><span>client's reviews</span></h1>
    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide box">
                <img src="../images/arudhatiroy.jpeg" alt="">
                <h3>Arundhati Roy</h3>
                <p>"Explore new worlds without ever leaving your seat. Our online bookstore brings stories to life with just a click. Dive into captivating narratives and let your imagination soar!"</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            <div class="swiper-slide box">
                <img src="../images/vikram seth.webp" alt="">
                <h3>Vikram Seth</h3>
                <p>"Discover a treasure trove of knowledge at your fingertips. From classics to contemporary bestsellers, our online bookstore offers a diverse collection to satisfy every reader's appetite."</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            <div class="swiper-slide box">
                <img src="../images/rknarayan.jpeg" alt="">
                <h3>R.K.Narayan</h3>
                <p>"Book lovers unite! Join our community of avid readers and embark on literary adventures together. Share recommendations, discuss plot twists, and celebrate the magic of storytelling."</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            <div class="swiper-slide box">
                <img src="../images/ChetanBhagat.jpg" alt="">
                <h3>Chetan Bhagat</h3>
                <p>"ransform your reading experience with convenience and ease. Our online bookstore delivers your favorite titles straight to your device, allowing you to indulge in literary escapades anytime, anywhere"</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            <div class="swiper-slide box">
                <img src="../images/kushwantsingh.webp" alt="">
                <h3>Kushwant Singh</h3>
                <p>"Escape the ordinary and journey into the extraordinary. With our online bookstore, the possibilities are endless. Immerse yourself in gripping narratives and embark on unforgettable literary voyages."</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="review-form">
        <h3>Leave a Review</h3>
        <form action="review.php" method="post">
            <textarea class="textbox" name="reviewText" rows="4" cols="50" placeholder="Write your review here..." required></textarea>
            <input type="hidden" name="bookId" value="1"> <!-- Change to the actual book ID dynamically -->
            <button type="submit" class="btn">Submit Review</button>
        </form>
    </div>
</section>
<!-- blog section -->
<section class="blogs" id="blogs">
    <h1 class="heading"><span>our blogs</span></h1>
    <div class="swiper blog-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide box">
                <div class="image">
                    <img src="../images/itadori.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Itadori</h3>
                    <p>"As an avid reader, I'm always on the hunt for my next literary fix, and this online bookstore never disappoints. The reviews and recommendations help me make informed choices, and the seamless checkout process makes shopping a delight."</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="image">
                    <img src="../images/luffy.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Luffy</h3>
                    <p>"This online bookstore is a book lover's paradise! The customer service is top-notch, and the quality of the books is exceptional. I love being able to support independent authors while indulging in my passion for reading"</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="image">
                    <img src="../images/izuku.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Izuku</h3>
                    <p>"I've been using this online bookstore for years, and it's become my go-to destination for all things book-related. The search filters make it easy to find exactly what I'm looking for, and the competitive prices keep me coming back time and time again.""</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="image">
                    <img src="../images/gojo.webp" alt="">
                </div>
                <div class="content">
                    <h3>Gojo</h3>
                    <p>"What sets this online bookstore apart is its dedication to customer satisfaction. Not only do they offer a vast selection of books, but they also go above and beyond to ensure that every purchase exceeds expectations. I couldn't be happier with my shopping experience"</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
            <div class="swiper-slide box">
                <div class="image">
                    <img src="../images/masomi.webp" alt="">
                </div>
                <div class="content">
                    <h3>Masaomi</h3>
                    <p>"I recently discovered this online bookstore, and I'm already hooked! The intuitive layout makes it easy to navigate, and the personalized recommendations help me discover new authors and genres. Plus, the fast shipping means I never have to wait long to dive into my next read"</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer section -->
<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>our locations</h3>
            <a href="#"><i class="fas fa-map-marker-alt"></i> india</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> USA</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> russia</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> france</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> japan</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> africa</a>
        </div>
        <div class="box">
            <h3>quick links</h3>
            <a href="#"><i class="fas fa-arrow-right"></i> home</a>
            <a href="#"><i class="fas fa-arrow-right"></i> featured</a>
            <a href="#"><i class="fas fa-arrow-right"></i> arrivals</a>
            <a href="#"><i class="fas fa-arrow-right"></i> reviews</a>
            <a href="#"><i class="fas fa-arrow-right"></i> blog</a>
        </div>
        <div class="box">
            <h3>extra links</h3>
            <a href="#"><i class="fas fa-arrow-right"></i> account info</a>
            <a href="#"><i class="fas fa-arrow-right"></i> ordered items</a>
            <a href="#"><i class="fas fa-arrow-right"></i> privacy policy</a>
            <a href="#"><i class="fas fa-arrow-right"></i> payment</a>
            <a href="#"><i class="fas fa-arrow-right"></i> our services</a>
        </div>
        <div class="box">
            <h3>contact info</h3>
            <a href="#"><i class="fas fa-phone"></i> +91 7067966946</a>
            <a href="#"><i class="fas fa-envelope"></i> vishwaschourasiya@gmail.com</a>
            <img src="../images/world-map.jpg" class="map" alt="">
        </div>
    </div>
    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
    </div>
    <div class="credit">created by <span>Vishwas Chourasiya</span> | all rights reserve</div>
</section>
<div class="loader-container">
    <img src="../images/loader.gif" alt="">
</div>
<!-- Add this before the closing </body> tag -->
<div id="cartModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalBookDetails">
            <!-- Book details will be injected here -->
        </div>
        <div id="paymentOptions">
            <h3>Payment Options</h3>
            <form action="payment.php" method="post">
                <input type="hidden" id="modalBookId" name="bookId">
                <input type="hidden" id="modalBookTitle" name="bookTitle">
                <input type="hidden" id="modalBookPrice" name="bookPrice">
                <button type="submit" class="btn">Proceed to Payment</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="../script/script.js"></script>
<script str="../script/dropdown.js"></script>
</body>
</html>