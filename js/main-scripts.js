document.addEventListener('DOMContentLoaded', function () {
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

    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("back-to-top").style.display = "block";
        } else {
            document.getElementById("back-to-top").style.display = "none";
        }
    }

    document.getElementById('back-to-top').addEventListener('click', function (e) {
        e.preventDefault();
        if ('scrollBehavior' in document.documentElement.style) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        }
    });
});


