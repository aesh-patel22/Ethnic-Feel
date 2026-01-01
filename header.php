

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons for vector icons -->
    <script src="https://cdn.jsdelivr.net/npm/lucide-v0.292.0@0/dist/lucide.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="header.css">
  <style>
     body {
            font-family: 'Inter', sans-serif;
            background-color: beige;
        }
        /* Custom styles for the wishlist heart icon */
        .wishlist-icon {
            transition: transform 0.2s ease-in-out;
        }
        .wishlist-icon:hover {
            transform: scale(1.1);
        }
        .product-image {
            width: 100%; 
            height: auto;
            object-fit: cover;
            transition: transform 0.5s ease-in-out;
        }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      font-family: 'Helvetica Neue', sans-serif;
      height: 100%;
      width: 100%;
      overflow-x: hidden;
    }

    .hero {
      position: relative;
      height: 100vh;
      width: 100%;
      background-image: url('9326ab50-338a-4ffe-a4e4-5cc48d02973c.png');
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      min-height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    nav {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 10;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
      background-color: beige;
      color: black;
      transition: background-color 0.4s, color 0.4s;
	  justify-content:center;
	  backdrop-filter: blur(0px);
    }

    nav:hover {
  background-color: beige; /* Deep pink with transparency */
  backdrop-filter: blur(15px);
  color: black;
    }

    nav:hover .logo,
nav:hover .nav-links a,
nav:hover .search-icon,
header:hover .search-box,
nav:hover .icons i,
nav:hover .search-box::placeholder {
  color: black !important;
}

nav:hover .search-box {
  background: rgba(255, 255, 255, 0.7);
  color: black;
}

/* Optional: Ensure input caret and text typed are visible */
.search-box {
  caret-color: black;
}
	.main-header {
  width: 100%;
  padding: 12px 40px;
  background: transperant;
}

	.header-container {
	  display: flex;
	  justify-content: space-between;
	  align-items: center;
	  flex-wrap: wrap;
	  max-width: 1440px;
	  margin:auto;
	}

.icons {
    margin-left: 30px; /* Add space between ETHNIC FEEL and first icon */
    display: flex;
    align-items: center;
    gap: 15px; /* Space between icons */
}
  .main-header .icons a:hover{
    color:black;
  }
.main-header:hover .icons a {
    color: black; /* Change icon color to pink on header hover */
}
	.logo1 {
	  display: flex;
	  align-items: center;
	  gap: 10px;
	  font-weight: bold;
	  font-size: 24px;
	  letter-spacing: 1px;
	  color: #F5F5DC;
	  transition: all 0.3s ease;
	  height: 60px;
    color:black;
	}
	.logo-images {
  width: 50px;
  height: 60px;
  position: relative;
}

.logo-images .main-logo {
  width: 100%;
  height: 100%;
  object-fit: contain;
  transition: filter 0.4s ease;
}
	.header-right {
	  display: flex;
	  align-items: center;
	  gap: 1.5rem;
	  margin:10px;
    justify-self:end;
	}
	.search-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}
	.search-box {
	  padding: 8px 12px 8px 34px;
  font-size: 14px;
  border: none;
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.4);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  outline: none;
  color:black;
  width:160px;
  z-index:1;
}
	.search-icon {
  position: absolute;
  top: 50%;
  left: 10px;
  transform: translateY(-50%);
  color: black;
  font-size: 16px;
  z-index:2;
}

	.icons i {
	  font-size: 18px;
	  cursor: pointer;
	  color: black;
	}
   .icons a {
            color: black;
            transition: color 0.2s ease-in-out;
        }

	/* Stacked images container */
	



	header:hover .logo-hover {
	  opacity: 1;
	}

	header:hover .logo-default {
	  opacity: 0;
	}

	/* Brand name style */
/* This is the main container for the navigation links */
.nav-links {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
  margin: 0;
  border-bottom: 1px solid #ccc; /* Add a bottom border to the entire nav bar */
  color:black;
}

/* This is the container for each individual category link */
.nav-links li {
  position: relative; /* This is important for positioning the underline */
  padding: 10px 15px; /* Adjust padding as needed */
  cursor: pointer;
}

/* This is the link itself */
.nav-links a {
  text-decoration: none;
  color: black; /* The default color of the text */
  font-weight: 500;
  font-size: 14px;
  text-transform: uppercase;
  transition: color 0.3s ease;
}

/* This is the underline that appears on hover */
.nav-links li::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 2px; /* Thickness of the underline */
  background-color: transparent; /* Initially, it's transparent */
  transition: background-color 0.3s ease;
}

/* This is the hover effect. The underline becomes visible. */
.nav-links li:hover::after,
.nav-links li.active::after {
  background-color: black; /* Color of the underline on hover */
}

/* You can also change the text color on hover */
.nav-links li:hover a,
.nav-links li.active a {
  color: beige;
}

/* Optional: To indicate the active/current page */
.nav-links li.active a {
  font-weight: bold; /* Make the active link bold */
}
 .sub-categories {
            flex: 1;
            color:black;
        }

        .sub-categories h4 {
            font-size: 1.3em;
            font-weight: normal;
            text-transform: uppercase;
            margin-bottom: 20px;
            border-bottom: 1px solid #dcdcdc;
            padding-bottom: 5px;
            color:black;
        }

        .sub-categories ul {
            list-style: none;
            padding: 0;
        }
        
        .sub-categories ul li a {
            text-decoration: none;
            color: #555;
            display: block;
            padding: 8px 0;
            font-size:1.1em;
            font-family: Trebuchet MS, sans-serif;
        }
        .sub-categories ul li {
  border-bottom: none;
}
        

         .image-gallery {
            /* Increased flex to make the image gallery take up more space */
            flex: 3;
            display: flex;
            gap: 30px;
            justify-content: space-between; /* Spreads the images out */
        }
        .image-item {
            text-align: center;
        }
        
        .image-item img {
            max-width: 100%; /* Keep this to ensure responsiveness */
            height: auto; /* Keep this to maintain aspect ratio */
            display: block;
            /* Add or adjust these properties to change the size */
            width: 250px; /* Example: set a specific width */
            height: 350px; /* Example: set a specific height */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .image-item img:hover {
            transform: scale(1.03);
        }
        
        .image-item p {
            margin-top: 10px;
            font-size: 1em;
            color: #555;
            text-transform: uppercase;
            font-family: Trebuchet MS, sans-serif;
        }
                .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 150vw;
            background-color: beige;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            z-index: 1000;
            text-align: left;
            padding: 40px;
            box-sizing: border-box;
        }

        .nav-links li:hover .dropdown-menu {
            display: block;
        }
        .dropdown-content {
            display: flex;
            /* Changed to space-between to spread content and cover the available space */
            justify-content: space-between; 
            max-width: 1500px;
            margin: 0 auto;
            gap: 40px;
        }
          
</style>
</head>
<body>

  <nav class="main-header">
 <div class="header-container">
    <!-- Logo Section -->
    <div class="logo1">
      <div class="logo-images">
        <img class="main-logo" src="logo.png" alt="ETHNICFEEL Logo">
      </div>
      <div class="logo">ETHNIC FEEL</div>
    </div>

           <!-- Search and Icons section
            <div class="header-right">
                Search wrapper -->
                <!-- <div class="search-wrapper">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" class="search-box" placeholder="Search">
                </div> -->

                <!-- Icon group -->
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
                            
                            <p>LEHENGA SETS</p>
                            </a>
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
      </nav>

</body>
</html>