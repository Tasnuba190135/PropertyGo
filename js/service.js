//my services javascript file
function toggleContent(contentId, buttonId) {
    const content = document.getElementById(contentId);
    const button = document.getElementById(buttonId);
    
    // Toggle content visibility
    content.style.display = content.style.display === "none" || content.style.display === "" ? "block" : "none";
    
    // Change button text and icon
    if (content.style.display === "block") {
      button.innerHTML = 'See less <span class="fa fa-arrow-up"></span>';
    } else {
      button.innerHTML = 'Read more <span class="fa fa-arrow-right"></span>';
    }
  }

  // Hide the extra content initially
  document.getElementById('rentContent').style.display = 'none';

  //clients review
  let currentTestimonial = 0;
  const testimonials = document.querySelectorAll('.testimonial-card');
  const totalTestimonials = testimonials.length;
  const testimonialsPerPage = 3;
  
  // Show the current set of testimonials (3 at a time) and hide others
  function showTestimonials(index) {
    testimonials.forEach((testimonial, i) => {
      if (i >= index && i < index + testimonialsPerPage) {
        testimonial.style.display = 'block'; // Show the testimonial
      } else {
        testimonial.style.display = 'none'; // Hide the testimonial
      }
    });
  }
  
  // Function to go to the next set of testimonials
  function nextTestimonial() {
    currentTestimonial = (currentTestimonial + testimonialsPerPage) % totalTestimonials; // Loop to the next set
    showTestimonials(currentTestimonial);
  }
  
  // Function to go to the previous set of testimonials
  function prevTestimonial() {
    currentTestimonial = (currentTestimonial - testimonialsPerPage + totalTestimonials) % totalTestimonials; // Loop to previous set
    showTestimonials(currentTestimonial);
  }
  
  // Initialize: show the first set of testimonials on page load
  showTestimonials(currentTestimonial);

  function showPopup() {
    // Display the popup
    document.getElementById("popup").style.display = "flex";
  }
  
  function closePopup() {
    // Hide the popup
    document.getElementById("popup").style.display = "none";
  }
  
  // Optional: Close the popup when clicking outside the popup content
  window.onclick = function(event) {
    const popup = document.getElementById("popup");
    if (event.target === popup) {
      closePopup();
    }
  };

  document.addEventListener('DOMContentLoaded', function () {
    const pages = document.querySelectorAll('.property-page');
    const paginationItems = document.querySelectorAll('.pagination .page-item[data-page]');
    const forwardButton = document.querySelector('.pagination .next');
    const backButton = document.querySelector('.pagination .previous');
    
    let currentPage = 1;
    const totalPages = pages.length;

    function showPage(pageNumber) {
      // Hide all pages
      pages.forEach((page, index) => {
        page.style.display = index + 1 === pageNumber ? 'block' : 'none';
      });

      // Update active state in pagination
      paginationItems.forEach(item => item.classList.remove('active'));
      document.querySelector(`.pagination .page-item[data-page="${pageNumber}"]`).classList.add('active');

      // Enable/Disable navigation buttons
      backButton.classList.toggle('disabled', pageNumber === 1);
      forwardButton.classList.toggle('disabled', pageNumber === totalPages);
    }

    // Add click event to pagination numbers
    paginationItems.forEach(item => {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        currentPage = parseInt(item.dataset.page);
        showPage(currentPage);
      });
    });

    // Forward button functionality
    forwardButton.addEventListener('click', function (e) {
      e.preventDefault();
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
      }
    });

    // Back button functionality
    backButton.addEventListener('click', function (e) {
      e.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    });

    // Initialize by showing the first page
    showPage(currentPage);
  });


  
    