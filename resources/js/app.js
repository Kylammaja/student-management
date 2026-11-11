
document.addEventListener('DOMContentLoaded', () => {

    // Mobile Navbar
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggle && mobileMenu) {

        menuToggle.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');

            mobileMenu.classList.toggle('flex', !isHidden);

            menuToggle.setAttribute(
                'aria-expanded',
                String(!isHidden)
            );
        });

        // Close menu after clicking a link
        mobileMenu.querySelectorAll('a').forEach(link => {

            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('flex');

                menuToggle.setAttribute('aria-expanded', 'false');
            });

        });

    }

// STUDENTHUB - SCROLL REVEAL

document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('.reveal');

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    if (
        elements.length === 0 ||
        reduceMotion ||
        !('IntersectionObserver' in window)
    ) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.1
        }
    );

    document.documentElement.classList.add('motion-ready');

    elements.forEach(element => {
        observer.observe(element);
    });
});


});

