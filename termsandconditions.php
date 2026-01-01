<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terms & Conditions - Ethnic Feel</title>
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
    <h1>Terms & Conditions</h1>
    <p>
      Welcome to <strong>Ethnic Feel</strong>. By accessing and using our website, you agree to abide by the
      following terms and conditions. These terms are intended to protect both our customers and our brand while
      ensuring a safe, enjoyable, and transparent shopping experience.
    </p>

    <h1>1. General</h1>
    <p>
      By visiting our store or purchasing from Ethnic Feel, you engage in our “Service” and agree to be bound by
      these Terms & Conditions. We reserve the right to update or change them at any time without prior notice.
    </p>

    <h1>2. Products & Services</h1>
    <p>
      We strive to display the colors, designs, and details of our ethnic collections as accurately as possible.
      However, variations may occur due to screen differences or handcrafted uniqueness. All products are subject
      to availability.
    </p>

    <h1>3. Pricing & Payments</h1>
    <p>
      Prices listed on our website are in INR (₹) unless stated otherwise. Ethnic Feel reserves the right to
      modify prices at any time. Payments must be made through trusted and secure gateways to ensure safe transactions.
    </p>

    <h1>4. Shipping & Delivery</h1>
    <p>
      We aim to deliver your order within the estimated timelines provided during checkout. However, unforeseen delays
      (festivals, logistics issues, weather conditions) may occur. Ethnic Feel is not liable for delays beyond our control.
    </p>

    <h1>5. Returns & Exchanges</h1>
    <p>
      We accept returns or exchanges only if the product is unused, unworn, and in its original condition with tags.
      Customized products or clearance items may not be eligible for return.
    </p>

    <h1>6. Intellectual Property</h1>
    <p>
      All content on Ethnic Feel, including logos, images, designs, and text, are the intellectual property of Ethnic Feel
      and may not be used or reproduced without written permission.
    </p>

    <h1>7. Limitation of Liability</h1>
    <p>
      Ethnic Feel shall not be held responsible for any direct or indirect damages arising from the use of our website
      or products purchased.
    </p>

    <h1>8. Governing Law</h1>
    <p>
      These Terms & Conditions shall be governed in accordance with the laws of India. Any disputes will be subject
      to the jurisdiction of local courts.
    </p>

    <h1>9. Contact Us</h1>
    <p>
      For questions regarding these Terms & Conditions, please reach out through our <strong>Contact Us</strong> page.
    </p>

    <p><strong>By continuing to use Ethnic Feel, you acknowledge and accept these Terms & Conditions.</strong></p>
  </div>
</body>
</html>
