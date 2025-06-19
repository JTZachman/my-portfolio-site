// Wait for DOM to be fully loaded (safe with defer but this is extra safe)
document.addEventListener('DOMContentLoaded', () => {

  // Mobile menu toggle
  const menuToggle = document.getElementById('menu-toggle');
  const navbarMenu = document.getElementById('navbar-menu');

  menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('open');
    navbarMenu.classList.toggle('open');
  });

  // Example: log to console to confirm it's working
  console.log('Zachman Media site JS loaded 🚀');

  // You can add more functionality below this line:
  // Example:
  // setupContactForm();
  // animateHeroSection();
});

  const navbar = document.querySelector('.navbar');

  let lastScrollY = window.scrollY;

  function handleScroll() {
    if (window.innerWidth > 768) return; // only on mobile

    if (window.scrollY > 10 && window.scrollY > lastScrollY) {
      navbar.classList.add('shrink');
    } else if (window.scrollY < lastScrollY || window.scrollY <= 10) {
      navbar.classList.remove('shrink');
    }

    lastScrollY = window.scrollY;
  }

  window.addEventListener('scroll', handleScroll);