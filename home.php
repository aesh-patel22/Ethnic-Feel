<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ethnic Feel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons for vector icons -->
    <script src="https://cdn.jsdelivr.net/npm/lucide-v0.292.0@0/dist/lucide.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="homestyle.css">
</head>
<body>

  <header class="main-header">
 <div class="header-container">
    <!-- Logo Section -->
    <div class="logo1">
      <div class="logo-images">
        <img class="main-logo" src="logo.png" alt="ETHNICFEEL Logo">
      </div>
      <div class="logo">ETHNIC FEEL   </div>
    </div>

          <!-- Search and Icons section
            <div class="header-right">
                Search wrapper -->
                <!-- <div class="search-wrapper">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" class="search-box" placeholder="Search">
                </div> -->

                <!-- Icon group -->
                <div class="icons">
                  <a href="cart.php" aria-label="Cart">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </a>

                    <a href="profile.php" aria-label="Account">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </a>
                    
                </div>
            </div>
        </div>


    <ul class="nav-links">
      <li><a href="home.php">Home</a></li>
 <li class="has-dropdown"><a href="#">WOMENSWEAR</a>
            <div class="dropdown-menu">
                <div class="dropdown-content">
                    <div class="sub-categories">
                        <h4>WOMENSWEAR</h4>
                        <ul>
                            <li><a href="lehenga.php">LEHENGA SETS</a></li>
                            <li><a href="saree.php">SAREES</a></li>
                            <li><a href="gown.php">GOWNS</a></li>
                            <li><a href="fusionwear.php">FUSION WEAR</a></li>
                        </ul>
                    </div>
                    <div class="image-gallery">
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="lehenga.php">
                            <img src="IMAGES\WOMEN\LEHENGA\l4.jpg" alt="Autumn/Winter 2024">
                            </a>
                            <p>LEHENGA SETS</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="saree.php">
                            <img src="IMAGES\WOMEN\SAREE\s3.jpg" alt="Heritage">
                            </a>
                            <p>SAREES</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="gown.php">
                            <img src="IMAGES\WOMEN\GOWNS\g19.jpg" alt="Weddings">
                            </a>
                            <p>GOWNS</p>
                        </div>
                         <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="fusionwear.php">
                            <img src="IMAGES/WOMEN/FUSION/f13.jpg" alt="Weddings">
                            </a>
                            <p>FUSION WEAR</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>


 <li class="has-dropdown"><a href="#">MENSWEAR</a>
                  <div class="dropdown-menu">
                <div class="dropdown-content">
                    <div class="sub-categories">
                        <h4>MENSWEAR</h4>
                        <ul>
                            <li><a href="kurta.php">KURTA</a></li>
                            <li><a href="sherwani.php">SHERWANI</a></li>
                            <li><a href="waistcoat.php">WAISTCOAT</a></li>
                        </ul>
                    </div>
                    <div class="image-gallery">
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="kurta.php">
                            <img src="IMAGES\MEN\KURTA\k3.jpg" alt="Autumn/Winter 2024">
                            </a>
                            <p>KURTA</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="sherwani.php">
                            <img src="IMAGES\MEN\SHERWANI\sh12.jpg" alt="Heritage">
                            </a>
                            <p>SHERWANI</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                            <a href="waistcoat.php">
                            <img src="IMAGES\MEN\WAISTCOAT\w1.jpg" alt="Weddings">
                            </a>
                            <p>WAISTCOAT</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
     <li class="has-dropdown"><a href="#">EF VOWS</a>
                  <div class="dropdown-menu">
                <div class="dropdown-content">
                    <div class="sub-categories">
                        <h4>EF VOWS</h4>
                        <ul>
                            <li><a href="heritage.php">HERITAGE</a></li>
                            <li><a href="contemporary.php">CONTEMPORARY</a></li>
                            <li><a href="white.php">WHITE WEDDING</a></li>
                            <li><a href="vows.php">VOWS</a></li>
                        </ul>
                    </div>
                    <div class="image-gallery">
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="heritage.php">
                            <img src="IMAGES\EF VOWS\HERITAGE\h1.jpg" alt="Autumn/Winter 2024">
                            </a>
                            <p>HERITAGE</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="contemporary.php">
                            <img src="IMAGES\EF VOWS\CONTEMPORARY\c1.jpg" alt="Heritage">
                            </a>
                            <p>CONTEMPORARY</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                            <a href="white.php">
                            <img src="IMAGES\EF VOWS\WHITE WEDDING\w7.jpg"alt="Weddings">
                            </a>
                            <p>WHITE WEDDING</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                            <a href="vows.php">
                            <img src="IMAGES\EF VOWS\VOWS\v1.jpg" alt="Weddings">
                            </a>
                            <p>VOWS</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
 <li class="has-dropdown"><a href="#">ACCESSORIES</a>
                  <div class="dropdown-menu">
                <div class="dropdown-content">
                    <div class="sub-categories">
                        <h4>ACCESSORIES</h4>
                        <ul>
                            <li><a href="belt.php">BELT</a></li>
                            <li><a href="bags.php">BAGS</a></li>
                            <li><a href="jewelry.php">JEWELRY</a></li>
                        </ul>
                    </div>
                    <div class="image-gallery">
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="belt.php">
                            <img src="IMAGES\ACCESSORIES\BELT\b2.jpg" alt="Autumn/Winter 2024">
                            </a>
                            <p>BELT</p>
                        </div>
                        <div class="image-item">
                            <!-- Placeholder image, replace with your own URLs -->
                             <a href="bags.php">
                             <img src="IMAGES\ACCESSORIES\BAGS\bg14.jpg" alt="Heritage">
                            </a>
                            <p>BAGS</p>
                        </div>
                        <div class="image-item"> 
                            <!-- Placeholder image, replace with your own URLs -->
                            <a href="jewelry.php">
                            <img src="IMAGES\ACCESSORIES\JEWELRY\j2.jpg" alt="Weddings">
                            </a>
                            <p>JEWELRY</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
      
    </ul>
  </header>

  <section class="hero">
    <img src="home.jpg">
    <!-- <video autoplay muted loop playsinline>
      <source src="video.mp4" type="video/mp4">
    </video> -->

    
	  </section>
	<section class="curated-section">
  <h2>CURATED THIS SEASON</h2>
  <p>A blend of classic silhouettes and our signature shine, embodied by enigmatic sequins.</p>
</section>


  <section class="category-grid">
  <div class="category-card" onclick="this.classList.toggle('clicked')">
    <a href="lehenga.php">
    <img src="IMAGES\WOMEN\LEHENGA\l6.jpg" alt="Lehengas">
      </a>
    <div class="category-name">LEHENGAS</div>
  </div>
  <div class="category-card" onclick="this.classList.toggle('clicked')">
    <a href="fusionwear.php">
    <img src="IMAGES\WOMEN\FUSION\f21.jpg" alt="Fusion Wear">
      </a>
    <div class="category-name">FUSION WEAR</div>
  </div>
  <div class="category-card" onclick="this.classList.toggle('clicked')">
        <a href="sherwani.php">
    <img src="IMAGES\MEN\SHERWANI\sh12.jpg" alt="Sherwanis">
</a>
    <div class="category-name">SHERWANIS</div>
  </div>
  <div class="category-card" onclick="this.classList.toggle('clicked')">
    <a href="saree.php">
    <img src="IMAGES\WOMEN\SAREE\s5.jpg" alt="Sarees">
</a>
    <div class="category-name">SAREES</div>
  </div>
</section>
	<section class="curated-section">
  <h2>ETHNIC FEEL VOWS</h2>
  <p>Rooted in tradition and led by love, I choose you—today and in every tomorrow.</p>
</section>
<section class="vows-banner">
<div class="image-row">
  <img src="IMAGES\EF VOWS\VOWS\v10.jpg" alt="Image 1">
  <img src="IMAGES\EF VOWS\VOWS\v9.jpg" alt="Image 2">
  <img src="IMAGES\EF VOWS\VOWS\v11.jpg" alt="Image 3">
</div>

</section>
<section class="hero-section">
  <div class="hero-panel hero-left">
    <img src="IMAGES\MEN\SHERWANI\sh11.jpg" alt="New Man" />
    <div class="hero-text">
      <h2>MEN IN ETHNIC</h2>
      <a href="sherwani.php" class="hero-btn">EXPLORE</a>
    </div>
  </div>
  <div class="hero-panel hero-right">
    <img src="accessories.jpg" alt="Accessories" />
    <div class="hero-text">
      <h2>ACCESSORIES</h2>
      <a href="belt.php" class="hero-btn">EXPLORE</a>
    </div>
  </div>
</section>
<footer class="footer">
    <div class="footer-container">
        <!-- Newsletter Section -->
        <div class="footer-column">
            <h3>Newsletter</h3>
            <p class="newsletter-text">Sign up to our newsletter to receive exclusive offers.</p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="E-mail">
                <button type="submit" class="subscribe-btn">Subscribe</button>
            </form>
        </div>

        <!-- Info Section -->
        <div class="footer-column">
            <h3>Info</h3>
            <ul>
                <li><a href="legacy.php">Legacy</a></li>
                <li><a href="#">Store Locator</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Track My Order</a></li>
            </ul>
        </div>

        <!-- Support Section -->
        <div class="footer-column">
            <h3>Support</h3>
            <ul>
                <li><a href="termsandconditions.php">Terms & Conditions</a></li>
                <li><a href="privacypolicy.php">Privacy Policy</a></li>
                <li><a href="returnpolicy.php">Returns & Exchange Policy</a></li>
                <li><a href="shippolicy.php">Shipping Policy</a></li>
                <li><a href="faq.php">FAQ's</a></li>
            </ul>
        </div>

        <!-- Keep in Touch Section -->
        <div class="footer-column">
            <h3>Keep in Touch</h3>
            <p class="contact-info">Call/WhatsApp: +91 9427327949</p>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2025 - ETHNIC FEEL OFFICIAL | MANAGED BY VAIDYA'S</p>
    </div>

  
</footer>



<script>
  window.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
</script>
<script>
  // Select the hero section and the images
  const heroSection = document.querySelector('.hero-section');
  const leftImage = document.querySelector('.hero-left img');
  const rightImage = document.querySelector('.hero-right img');

  // Setup Intersection Observer
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Trigger animations
        leftImage.classList.remove('animate-left'); // reset
        rightImage.classList.remove('animate-right');

        void leftImage.offsetWidth; // force reflow
        void rightImage.offsetWidth;

        leftImage.classList.add('animate-left');
        rightImage.classList.add('animate-right');
      }
    });
  }, { threshold: 0.5 });

  observer.observe(heroSection);
</script>



</body>
</html>
