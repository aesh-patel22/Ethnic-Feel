<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Privacy Policy | Ethnic Feel</title>
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
  margin: 200px auto 50px auto; /* 👈 extra top space like legacy */
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
    <h1>Privacy Policy</h1>
    <p>
      At <strong>Ethnic Feel</strong>, we respect your privacy and are committed to protecting your personal
      information. This Privacy Policy explains how we collect, use, and safeguard your data when you interact
      with our website or store.
    </p>

    <h1>Information We Collect</h1>
    <p>
      We may collect personal details such as your name, email address, phone number, billing/shipping address,
      and payment details when you make a purchase or sign up for our services. Additionally, we may gather
      non-personal information like browser type, device details, and site usage patterns to improve our website.
    </p>

    <h1>How We Use Your Information</h1>
    <p>
      The information we collect is used to process your orders, provide customer support, enhance your
      shopping experience, and keep you updated with offers and promotions (if you choose to receive them).
    </p>

    <h1>Data Security</h1>
    <p>
      We implement strict security measures to protect your personal data from unauthorized access,
      alteration, or disclosure. However, please note that no method of data transmission over the internet
      is 100% secure.
    </p>

    <h1>Sharing of Information</h1>
    <p>
      Ethnic Feel does not sell, rent, or trade your personal information with third parties. We only share
      your data with trusted service providers necessary for order fulfillment, payment processing, and delivery.
    </p>

    <h1>Your Rights</h1>
    <p>
      You have the right to access, update, or delete your personal information. If you wish to opt out of
      promotional communications, you can contact us anytime, and we will respect your choice.
    </p>

    <h1>Updates to Privacy Policy</h1>
    <p>
      We may update this Privacy Policy occasionally to reflect changes in our practices or legal requirements.
      Please review this page regularly to stay informed.
    </p>

    <p><strong>By using our website, you agree to this Privacy Policy and the way we handle your data.</strong></p>
  </div>
</body>
</html>
