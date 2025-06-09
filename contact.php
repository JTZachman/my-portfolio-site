<?php include('includes/header.php'); ?>
<?php include('includes/nav.php'); ?>
<main>
  <section id="contact" class="contact">
  <h3>Contact Me</h3>
  <p>Let's bring your project to life. Reach out anytime — I'll get back to you as soon as possible.</p>

  <form action="#" method="post">
  <input type="text" name="name" placeholder="Your Name" required />
  <input type="email" name="email" placeholder="Your Email" required />
  <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
  <button type="submit">Send Message</button>
</form>

<!--

  <form action="send_contact.php" method="POST" class="contact-form">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="6" required></textarea>

    <button type="submit">Send Message</button>
  </form> -->
</section>
</main>
<?php include('includes/footer.php'); ?>