<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Legacy of Ethnic Feel</title>
  <style>
   /* Ethnic Feel Stylesheet with Background */

body {
  margin: 0;
  padding: 0;
  font-family: "Georgia", serif;
  background-image: url('bglegacy.PNG'); /* Ethnic background */
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  color: #2e2e2e;
  line-height: 1.8;
}

/* Container Styling */
.container {
  background-color: rgba(245, 245, 220, 0.95); /* beige overlay */
  max-width: 950px;
  margin: 200px auto 50px auto; /* 👈 increased space from top */
  padding: 40px;
  border-radius: 14px;
  border: 2px solid #d2a679; /* golden earthy border */
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
  position: relative;
}

/* Decorative accent */
.container::before, 
.container::after {
  content: "";
  position: absolute;
  width: 60px;
  height: 4px;
  background: #d62f65; /* matches heading */
  top: -10px;
  border-radius: 5px;
}
.container::before { left: 30px; }
.container::after { right: 30px; }

/* Headings */
h1 {
  font-family: "Palatino Linotype", "Book Antiqua", serif;
  color: #d62f65; /* ethnic heading color */
  font-size: 30px;
  margin-top: 25px;
  margin-bottom: 15px;
  border-bottom: 2px solid #d2a679;
  display: inline-block;
  padding-bottom: 5px;
}

/* Paragraphs */
p {
  font-size: 18px;
  text-align: justify;
  margin-bottom: 20px;
}

/* Strong emphasis */
p strong {
  color: #a94442;
  font-size: 19px;
}

/* Hover animation */
h1:hover {
  color: #a94442;
  transition: 0.3s ease;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    margin: 140px 20px 20px 20px; /* 👈 reduced but still spacious */
    padding: 20px;
  }
  h1 { font-size: 24px; }
  p { font-size: 16px; }
}
  </style>
</head>
<body>
  <div class="container">
    <h1>The Legacy of Ethnic Feel</h1>
    <p>
      Ethnic Feel was created with a simple vision — to celebrate the richness of culture through style,
      and to keep the beauty of traditions alive in the modern world. Our store is not just a marketplace;
      it is a reflection of heritage, artistry, and identity. Every piece we offer tells a story — 
      a story of roots, craftsmanship, and timeless beauty.
    </p>

    <h1>Our Beginning</h1>
    <p>
      Ethnic Feel started as a passion for bringing people closer to their traditions. We believe that clothing
      is not only about fabric but also about emotion, history, and belonging. Each design is inspired by the
      vibrant spirit of culture and the elegance of ethnic artistry passed down through generations.
    </p>

    <h1>The Essence of Ethnic Feel</h1>
    <p>
      At Ethnic Feel, we embrace the soul of tradition and give it a contemporary expression. Our collections are
      designed to capture the grace of ethnic wear while making it relevant to today’s lifestyle. Whether it is
      handwoven fabric, intricate embroidery, or modern silhouettes with cultural roots, every detail carries
      authenticity and pride.
    </p>

    <h1>More Than a Store</h1>
    <p>
      Ethnic Feel is more than a shopping destination — it is an experience of culture. We aim to create a space
      where people not only discover fashion but also reconnect with their heritage. Each piece reflects the artistry
      of skilled hands and the spirit of communities that have kept traditions alive for centuries.
    </p>

    <h1>Our Legacy, Our Promise</h1>
    <p>
      The legacy of Ethnic Feel lies in its purpose: to preserve, celebrate, and share tradition with the world.
      We honor the past, embrace the present, and inspire the future. With every collection, we carry forward the
      beauty of heritage — so it can be worn, lived, and remembered.
    </p>
    <p><strong>Ethnic Feel is not just clothing. It is culture you can wear, pride you can carry, and a legacy you can pass on.</strong></p>
  </div>
</body>
</html>
