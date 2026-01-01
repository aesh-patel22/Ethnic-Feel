<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping Policy - Ethnic Feel</title>
  <style>
   /* Ethnic Feel Stylesheet with Shipping Background */

body {
  margin: 0;
  padding: 0;
  font-family: "Georgia", serif;
  background-image: url('bglegacy.png'); /* Ethnic shipping background */
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  color: #2e2e2e;
  line-height: 1.8;
}

/* Container Styling */
.container {
  background-color: rgba(250, 245, 230, 0.95); /* warm beige overlay */
  max-width: 950px;
  margin: 200px auto 50px auto;
  padding: 40px;
  border-radius: 14px;
  border: 2px solid #c89f65; /* golden earthy border */
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
  background: #8b2f4d; /* ethnic accent color */
  top: -10px;
  border-radius: 5px;
}
.container::before { left: 30px; }
.container::after { right: 30px; }

/* Headings */
h1 {
  font-family: "Palatino Linotype", "Book Antiqua", serif;
  color: #8b2f4d;
  font-size: 30px;
  margin-top: 25px;
  margin-bottom: 15px;
  border-bottom: 2px solid #c89f65;
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
  color: #6b1f35;
  font-size: 19px;
}

/* Hover animation */
h1:hover {
  color: #6b1f35;
  transition: 0.3s ease;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    margin: 140px 20px 20px 20px;
    padding: 20px;
  }
  h1 { font-size: 24px; }
  p { font-size: 16px; }
}
  </style>
</head>
<body>
  <div class="container">
    <h1>Shipping Policy</h1>
    <p>
      At Ethnic Feel, we aim to ensure that your chosen pieces of tradition reach you on time, safely and beautifully packed. 
      Our shipping process is designed with care, keeping in mind the trust you place in us.
    </p>

    <h1>Processing Time</h1>
    <p>
      All orders are processed within <strong>2-4 business days</strong>. During festive seasons or new collection launches, 
      processing may take slightly longer, but we always strive to dispatch your order at the earliest.
    </p>

    <h1>Domestic Shipping</h1>
    <p>
      We offer reliable shipping across India through trusted courier partners. Delivery time typically ranges from 
      <strong>5-7 business days</strong>, depending on your location. Remote areas may take slightly longer.
    </p>

    <h1>International Shipping</h1>
    <p>
      Ethnic Feel proudly ships worldwide. International delivery timelines may vary between 
      <strong>10-20 business days</strong>, subject to customs and regional regulations.
    </p>

    <h1>Shipping Charges</h1>
    <p>
      - Domestic orders above <strong>₹2000</strong> are eligible for free shipping.<br>
      - International shipping charges are calculated at checkout based on destination and package weight.
    </p>

    <h1>Delays & Responsibility</h1>
    <p>
      While we do our best to ensure timely deliveries, unforeseen delays due to weather, strikes, or customs 
      are beyond our control. However, our team will always assist you in tracking and resolving any shipping concerns.
    </p>

    <h1>Our Promise</h1>
    <p>
      Each package from Ethnic Feel carries not just clothing, but also heritage and care. 
      We promise to deliver your orders with love, ensuring they reach you safely.
    </p>

    <p><strong>Ethnic Feel – Delivering tradition to your doorstep, with trust and pride.</strong></p>
  </div>
</body>
</html>
