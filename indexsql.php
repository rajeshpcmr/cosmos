<?php
include("configsql.php");
$error = '';

if($db->connect_error){
    die("Connection failed".$db->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO Contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if($db->query($sql) === TRUE){
        echo "Contact details submitted successfully";
        
    } else {
        $error = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Cannot submit the contact details
              </div>';
    }
}

?>


<!DOCTYPE html>
  <head>
    <title>Cosmos | Booking</title>
    <link rel="icon" href="images/cosmos.png">

    <style>
    /* styles.css */

/* Global Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  background-color: #020000;
}

.container {
  max-width: 1100px;
  margin: auto;
  padding: 0 20px;
}

/* Header Styles */
/* header {
  background: ;
  color: #00000000;
  padding: 20px 0;
} */

/* header h1 {
  text-align: center;
  font-size: 2rem;
} */

/* Navigation Styles */
nav {
  text-align: center;
  margin-top: 20px;
}

nav ul {
  list-style: none;
}

nav ul li {
  display: inline-block;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  font-size: 1.2rem;
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

nav ul li a:hover {
  background-color: #1c0cef;
}

 marquee{
      font-size: 30px;
      font-weight: 800;
      color: #8ebf42;
      font-family: sans-serif;
      }
/* Hero Section Styles */
.hero {
  background: url("images/loginbg.jpg");
  padding: 100px 0;
  text-align: center;
  color: #fff;
}

.hero h2 {
  margin-bottom: 20px;
  font-size: 3rem;
}

.hero p {
  font-size: 1.5rem;
  margin-bottom: 30px;
}

.btn {
  display: inline-block;
  background: #333;
  color: #fff;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 100px;
  transition: background-color 0.3s ease;
  font-size: 1.2rem;
}

.btn:hover {
  background: #ef0808;
}

/* About Section Styles */
.about {
  padding: 50px 0;
  background: #fff;
  text-align: center;
}

.about h2 {
  font-size: 2.5rem;
  margin-bottom: 20px;
}

.about p {
  font-size: 1.2rem;
}

/* Services Section Styles */
.services {
  padding: 50px 0;
  background: #f9f9f9;
}

.services h2 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  text-align: center;
}

.service {
  background: #fff;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 5px;
  transition: transform 0.3s ease;
}

.service:hover {
  transform: translateY(-5px);
}

.service h3 {
  font-size: 1.8rem;
  margin-bottom: 10px;
}

.service p {
  font-size: 1.1rem;
}

/* Contact Section Styles */
.contact {
  background: #f9f9f9;
  padding: 50px 0;
}

.contact h2 {
  text-align: center;
  font-size: 2.5rem;
  margin-bottom: 20px;
}

.contact p {
  text-align: center;
  font-size: 1.2rem;
  margin-bottom: 30px;
}

.contact form {
  max-width: 600px;
  margin: auto;
}

.contact form input,
.contact form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.contact form button {
  display: block;
  background: #333;
  color: #fff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
  font-size: 1.2rem;
  margin: auto;
}

.contact form button:hover {
  background: #555;
}

/* Footer Styles */
/* footer {
  background: #333;
  color: #fff;
  text-align: center;
  padding: 20px 0;
  position: fixed;
  bottom: 0;
  width: 100%;
} */

/* Responsive Navigation Styles */
.menu-toggle {
  display: none;
  cursor: pointer;
}

nav ul {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

nav ul.slide {
  flex-direction: column;
  align-items: flex-start;
  position: absolute;
  top: 80px;
  left: 0;
  background-color: #333;
  width: 100%;
  transition: transform 0.3s ease-in-out;
  transform: translateY(-100%);
}

nav ul li {
  display: inline;
  margin-left: 20px;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  font-size: 1.2rem;
}

@media (max-width: 768px) {
  .menu-toggle {
    display: block;
  }

  nav ul {
    display: none;
  }
}

    </style>
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav>
      <div class="container">
        <marquee behaviour="scroll" style="color:white" class="body">Welcome to COSMOS Auditorium Booking</marquee>
        <ul><!--unordered list-->
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a class="btn" href= "./main.php">Login</a>
          <li><a class="btn" href="./user/user_register.php">Register</a>
        </ul>
      </div>
    </nav>
    <br>

    <!-- Hero Section -->
    <section id="home" class="hero">
      <div class="container">
    
        <a href="#services" class="btn">Explore Services</a>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
      <div class="container">
        <h2>About Us</h2>
        <p>

Welcome to our Auditorium Booking System. We are dedicated to make the process of booking auditoriums simple, efficient, and hassle-free.

Our platform was established with the vision of streamlining the booking process for auditoriums across the city. We understand that finding the perfect venue for your event can be a challenging task, and we are here to assist you every step of the way.

We offer a wide range of auditoriums that cater to various events such as concerts, seminars, corporate meetings, and cultural programs. Our user-friendly interface allows you to browse through a variety of options based on location, seating capacity, amenities, and price.

Our team is committed to providing excellent customer service. We work closely with the auditorium owners to ensure that all listed venues meet high standards of comfort and quality.

We believe in transparency and honesty, and we strive to provide accurate and up-to-date information about all the auditoriums listed on our platform. Our secure payment system ensures that your transactions are safe and secure.

Join us in our journey to make auditorium booking a seamless experience. We look forward to serving you.

        </p>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
      <div class="container">
        <h2>Our Services</h2>
        <div class="service">
          <h3>Optimized Operations</h3>
          <p>
            Efficient management ensures smooth coordination of events,staff,resources,minimizing disruptions and maximizing productivity.
          </p>
        </div>
        <div class="service">
          <h3>Enhanced Audience Experience</h3>
          <p>
            A well managed auditorium provides comfortable seating,prompt services and an enjoyable environmet, leaving long-lasting impressions on attendees.
          </p>
        </div>
        <div class="service">
          <h3>Adequate facilities</h3>
          
        </div>
        <!-- Add more services as needed -->
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
      <div class="container">
        <h2>Contact Us</h2>
        <p>
          Ready to embark on your journey with Cosmos Auditorium Booking Reach out to us today for assistance and
          support.
        </p>
        <form id="contact-form" method="post">
          <input type="text" name="name" placeholder="Your Name" />
          <input type="email" name="email" placeholder="Your Email" />
          <textarea name="message" placeholder="Your Message"></textarea>
          <button type="submit">Send Message</button>
        </form>
      </div>
    </section>
    


  </body>
</html>


