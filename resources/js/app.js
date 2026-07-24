import './bootstrap';

/* ============================================================
 * Restrack — UI Enhancements
 * Scroll reveal, counter animation, navbar shrink, smooth scroll
 * ============================================================ */

document.addEventListener('DOMContentLoaded', () => {
    /* ----- Scroll Reveal ----- */
    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
        revealEls.forEach((el) => io.observe(el));
    }

    /* ----- Counter Animation (data-counter="123") ----- */
    const counters = document.querySelectorAll('[data-counter]');
    if ('IntersectionObserver' in window && counters.length) {
        const counterIO = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const target = parseFloat(el.dataset.counter) || 0;
                const duration = parseInt(el.dataset.duration || '1600', 10);
                const suffix = el.dataset.suffix || '';
                const startedAt = performance.now();

                const tick = (now) => {
                    const progress = Math.min((now - startedAt) / duration, 1);
                    const ease = 1 - Math.pow(1 - progress, 3);
                    const value = target * ease;
                    el.textContent = (Number.isInteger(target) ? Math.round(value) : value.toFixed(1)) + suffix;
                    if (progress < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
                counterIO.unobserve(el);
            });
        }, { threshold: 0.4 });
        counters.forEach((el) => counterIO.observe(el));
    }

    /* ----- Navbar shrink on scroll ----- */
    const nav = document.querySelector('[data-navbar]');
    if (nav) {
        const onScroll = () => {
            if (window.scrollY > 30) nav.classList.add('is-scrolled');
            else nav.classList.remove('is-scrolled');
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ----- Smooth anchor scrolling with offset ----- */
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
        a.addEventListener('click', (e) => {
            const id = a.getAttribute('href');
            if (!id || id === '#') return;
            const target = document.querySelector(id);
            if (!target) return;
            e.preventDefault();
            const y = target.getBoundingClientRect().top + window.scrollY - 80;
            window.scrollTo({ top: y, behavior: 'smooth' });
        });
    });

    /* ----- Tilt effect on .tilt elements ----- */
    document.querySelectorAll('.tilt').forEach((el) => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            el.style.transform = `perspective(900px) rotateX(${-y * 6}deg) rotateY(${x * 6}deg) translateY(-4px)`;
        });
        el.addEventListener('mouseleave', () => {
            el.style.transform = '';
        });
    });
});
