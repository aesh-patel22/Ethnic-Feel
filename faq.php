<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQs - Ethnic Feel</title>
  <style>
/* Ethnic Feel FAQ Styles */

body {
  margin: 0;
  padding: 0;
  font-family: "Georgia", serif;
  background-image: url('bglegacy.png'); /* FAQ ethnic background */
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  color: #2e2e2e;
  line-height: 1.8;
}

/* Container */
.container {
  background-color: rgba(255, 250, 245, 0.95);
  max-width: 950px;
  margin: 200px auto 50px auto;
  padding: 40px;
  border-radius: 14px;
  border: 2px solid #b48a4e; /* earthy border */
  box-shadow: 0px 8px 18px rgba(0,0,0,0.15);
  position: relative;
}

/* Decorative lines */
.container::before, 
.container::after {
  content: "";
  position: absolute;
  width: 70px;
  height: 4px;
  background: #7a1c34;
  top: -10px;
  border-radius: 5px;
}
.container::before { left: 25px; }
.container::after { right: 25px; }

/* Headings */
h1 {
  font-family: "Palatino Linotype", "Book Antiqua", serif;
  color: #7a1c34;
  font-size: 32px;
  margin-top: 20px;
  margin-bottom: 15px;
  border-bottom: 2px solid #b48a4e;
  display: inline-block;
  padding-bottom: 5px;
}

/* Questions */
h2 {
  color: #8b2f4d;
  font-size: 22px;
  margin-top: 25px;
  margin-bottom: 10px;
  font-weight: bold;
}

/* Answers */
p {
  font-size: 18px;
  text-align: justify;
  margin-bottom: 20px;
}

/* Strong text */
p strong {
  color: #5a1527;
}

/* Hover effect */
h2:hover {
  color: #5a1527;
  transition: 0.3s ease;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    margin: 140px 20px 20px 20px;
    padding: 20px;
  }
  h1 { font-size: 26px; }
  h2 { font-size: 20px; }
  p { font-size: 16px; }
}
  </style>
</head>
<body>
  <div class="container">
    <h1>Frequently Asked Questions</h1>

    <h2>1. What makes Ethnic Feel unique?</h2>
    <p>
      At Ethnic Feel, each piece is a celebration of tradition, craftsmanship, and cultural roots. 
      We blend heritage with modern designs to create timeless ethnic wear.
    </p>

    <h2>2. How do I know my size?</h2>
    <p>
      We provide a <strong>size guide</strong> with detailed measurements for every collection. 
      If you’re still unsure, our support team will help you choose the perfect fit.
    </p>

    <h2>3. Do you ship internationally?</h2>
    <p>
      Yes! Ethnic Feel ships worldwide. International orders usually take <strong>10-20 business days</strong> 
      depending on customs clearance.
    </p>

    <h2>4. Can I return or exchange a product?</h2>
    <p>
      Absolutely. You can request a return or exchange within <strong>7 days of delivery</strong>. 
      Please refer to our Return & Exchange Policy for full details.
    </p>

    <h2>5. How can I track my order?</h2>
    <p>
      Once your order is shipped, you will receive a <strong>tracking ID</strong> via email/SMS 
      which you can use to track your package in real time.
    </p>

    <h2>6. Are your products handmade?</h2>
    <p>
      Many of our products feature <strong>handwoven fabrics, hand embroidery, and artisanal work</strong>, 
      crafted with love by skilled artisans across India.
    </p>

    <h2>7. How can I contact customer support?</h2>
    <p>
      You can reach us through the <strong>Contact Us</strong> page or email us at 
      <strong>support@ethnicfeel.com</strong>. Our team is always happy to help!
    </p>

    <p><strong>Ethnic Feel – Your questions answered with care, your traditions delivered with pride.</strong></p>
  </div>
</body>
</html>
