const toggleActiveClass = () => {
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
  const loc = window.location.href;

  navLinks.forEach((link) => {
    if (loc.includes(link.getAttribute("href"))) {
      link.classList.toggle("active");
    }
  });
};

const toggleActiveClass_two = () => {
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
  const loc = window.location.pathname; // Use pathname instead of href

  navLinks.forEach((link) => {
    // Remove "active" class from all links
    link.classList.remove("active");

    // Add "active" class to the link that matches the current path
    if (loc === link.getAttribute("href")) {
      link.classList.add("active");
    }
  });
};