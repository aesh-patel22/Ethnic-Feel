<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Return & Exchange Policy - Ethnic Feel</title>
  <style>
   /* Ethnic Feel Stylesheet with Return Background */

body {
  margin: 0;
  padding: 0;
  font-family: "Georgia", serif;
  background-size: cover;
    background-image: url('bglegacy.PNG');
  background-position: center;
  background-attachment: fixed;
  color: #2e2e2e;
  line-height: 1.8;
}

/* Container Styling */
.container {
  background-color: rgba(255, 248, 240, 0.95); /* soft beige overlay */
  max-width: 950px;
  margin: 200px auto 50px auto; 
  padding: 40px;
  border-radius: 14px;
  border: 2px solid #c68c53; /* earthy-golden */
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
  background: #6d3f20; 
  top: -10px;
  border-radius: 5px;
}
.container::before { left: 30px; }
.container::after { right: 30px; }

/* Headings */
h1 {
  font-family: "Palatino Linotype", "Book Antiqua", serif;
  color: #6d3f20; 
  font-size: 30px;
  margin-top: 25px;
  margin-bottom: 15px;
  border-bottom: 2px solid #c68c53;
  display: inline-block;
  padding-bottom: 5px;
}

/* Paragraphs */
p {
  font-size: 18px;
  text-align: justify;
  margin-bottom: 20px;
}

/* List Styling */
ul {
  text-align: left;
  font-size: 18px;
  margin-bottom: 20px;
}
ul li {
  margin-bottom: 12px;
}

/* Strong emphasis */
p strong {
  color: #8b0000;
  font-size: 19px;
}

/* Hover animation */
h1:hover {
  color: #8b0000;
  transition: 0.3s ease;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    margin: 140px 20px 20px 20px; 
    padding: 20px;
  }
  h1 { font-size: 24px; }
  p, ul li { font-size: 16px; }
}
  </style>
</head>
<body>
  <div class="container">
    <h1>Return & Exchange Policy</h1>
    <p>
      At <strong>Ethnic Feel</strong>, we want you to love what you buy. If you are not satisfied with your purchase, we offer a simple and fair return & exchange policy. Please read the terms carefully:
    </p>

    <h1>Eligibility for Returns</h1>
    <ul>
      <li>Items must be unused, unworn, and in their original condition with all tags attached.</li>
      <li>Returns must be initiated within <strong>7 days</strong> of delivery.</li>
      <li>Customized or tailored products are not eligible for return or exchange.</li>
    </ul>

    <h1>Exchange Policy</h1>
    <ul>
      <li>Exchanges can be made for size or design, subject to stock availability.</li>
      <li>If the requested product is unavailable, you may opt for store credit.</li>
    </ul>

    <h1>Return Process</h1>
    <ul>
      <li>To initiate a return, please contact our customer support with your order details.</li>
      <li>Once approved, securely pack the item and ship it to the address provided by our team.</li>
      <li>Refunds will be processed within 7–10 business days after we receive the returned item.</li>
    </ul>

    <p><strong>Note:</strong> Shipping costs are non-refundable. Customers are responsible for return shipping unless the product received was defective or incorrect.</p>

    <p><strong>Our promise:</strong> At Ethnic Feel, we stand for trust and tradition. We aim to ensure every experience with us is positive and respectful of your time and trust.</p>
  </div>
</body>
</html>
