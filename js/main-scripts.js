document.addEventListener('DOMContentLoaded', function() {
    const watchEls = document.querySelectorAll('.watch-in-view');

    function checkVisibility() {
      watchEls.forEach(watchEl => {
        const rect = watchEl.getBoundingClientRect();
        const isInView = (
          rect.top >= 0 &&
          rect.left >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
          rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );

        if (isInView && !watchEl.classList.contains('in-view')) {
          watchEl.classList.add('in-view');
        }
      });
    }

    // Check on initial load
    checkVisibility();

    // Check on scroll
    window.addEventListener('scroll', checkVisibility);

    // Optionally, check on resize as well
    window.addEventListener('resize', checkVisibility);
  });