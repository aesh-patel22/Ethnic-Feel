<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethnic Feel - Product Gallery</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    </style>
</head>
<?php
include 'header.php';
?>
<body class="bg-beige text-black">

    <!-- Main container for the product gallery -->
    <div class="mt-32 py-8 px-4 md:px-8">
        
        <!-- Product Grid Container -->
        <!-- This grid will automatically adjust the number of columns based on screen size -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            
            <!-- Start of Product Card 1 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <!-- Product Image -->
                    <img src="IMAGES\WOMEN\FUSION\f1.jpg"
                         alt="Crystal Fishtail Skirt Set" 
                         class="product-image rounded-t-xl group-hover:scale-105">

                    <!-- Overlay for "New Arrivals" and Wishlist -->
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <!-- New Arrivals Tag -->
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <!-- Wishlist Heart Icon (SVG) -->
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Product Details below the card -->
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Crystal Fishtail Skirt Set</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 799,900
                    </span>
                </div>
            </div>
            <!-- End of Product Card 1 -->

            <!-- Start of Product Card 2 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f2.jpg"
                         alt="Floral Fishtail Skirt & Corset" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Floral Fishtail Skirt & Corset</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 809,900
                    </span>
                </div>
            </div>
            <!-- End of Product Card 2 -->

            <!-- Start of Product Card 3 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f17.jpg"
                         alt="Kanjivaram Concept Saree" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Kanjivaram Concept Saree</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 909,900
                    </span>
                </div>
            </div>
            <!-- End of Product Card 3 -->

            <!-- Start of Product Card 4 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f4.jpg"
                         alt="Embellished Fishtail Skirt and Bustier" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Embellished Fishtail Skirt and Bustier</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 484,900
                    </span>
                </div>
            </div>
            <!-- End of Product Card 4 -->
            
            <!-- Start of Product Card 5 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <!-- Product Image -->
                    <img src="IMAGES\WOMEN\FUSION\f5.jpg"
                         alt="Crystal Fishtail Skirt Set" 
                         class="product-image rounded-t-xl group-hover:scale-105">

                    <!-- Overlay for "New Arrivals" and Wishlist -->
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <!-- New Arrivals Tag -->
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <!-- Wishlist Heart Icon (SVG) -->
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Product Details below the card -->
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Crystal Fishtail Skirt Set</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 650,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 5 -->

            <!-- Start of Product Card 6 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f24.jpg"
                         alt="Floral Fishtail Skirt & Corset" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Floral Fishtail Skirt & Corset</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 690,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 6 -->

            <!-- Start of Product Card 7 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f23.jpg"
                         alt="Kanjivaram Concept Saree" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Kanjivaram Concept Saree</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 920,250
                    </span>
                </div>
            </div>
            <!-- End of Product Card 7 -->

            <!-- Start of Product Card 8 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f22.jpg"
                         alt="Embellished Fishtail Skirt and Bustier" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                    </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Embellished Fishtail Skirt and Bustier</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 674,600
                    </span>
                </div>
            </div>
            <!-- End of Product Card 8 -->
             <!-- Start of Product Card 9 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f9.jpg"
                         alt="Product 9" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 1</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 750,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 9 -->

            <!-- Start of Product Card 10 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f10.jpg"
                         alt="Product 10" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 2</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 850,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 10 -->

            <!-- Start of Product Card 11 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f11.jpg"
                         alt="Product 11" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 3</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 950,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 11 -->

            <!-- Start of Product Card 12 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f20.jpg"
                         alt="Product 12" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 4</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 680,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 12 -->

            <!-- Start of Product Card 13 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f13.jpg"
                         alt="Product 13" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 5</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 720,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 13 -->

            <!-- Start of Product Card 14 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f14.jpg"
                         alt="Product 14" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 6</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 900,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 14 -->

            <!-- Start of Product Card 15 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f21.jpg"
                         alt="Product 15" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 7</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 890,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 15 -->

            <!-- Start of Product Card 16 -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden relative group">
                    <img src="IMAGES\WOMEN\FUSION\f16.jpg"
                         alt="Product 16" 
                         class="product-image rounded-t-xl group-hover:scale-105">
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                            NEW ARRIVALS
                        </span>
                        <button aria-label="Add to wishlist" class="wishlist-icon p-2 bg-white rounded-full shadow-md">
                            <svg class="w-6 h-6 text-gray-400 hover:text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A5.4 5.4 0 017.5 3c2.24 0 4.24 1.15 5.5 3.06A5.4 5.4 0 0116.5 3c3.5 0 5.5 3.1 5.5 7.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                    </div>
                <div class="mt-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">New Lehengas 8</h3>
                    <span class="text-sm md:text-base font-bold text-[#D62F65]">
                        INR 820,000
                    </span>
                </div>
            </div>
            <!-- End of Product Card 16 -->
        </div>
    </div>
</body>
</html>
