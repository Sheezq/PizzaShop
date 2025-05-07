document.addEventListener('DOMContentLoaded', () => {
    const app = document.getElementById('app');
    if (app) {
        requestAnimationFrame(() => {
            app.classList.add('fade-in');
        });

        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');

                if (
                    !href ||
                    href.startsWith('#') ||
                    href.startsWith('http') ||
                    this.target === '_blank' ||
                    this.hasAttribute('download') ||
                    this.hasAttribute('data-no-animation')
                ) return;

                e.preventDefault();

                app.classList.remove('fade-in');
                app.classList.add('fade-out');

                setTimeout(() => {
                    window.location.href = href;
                }, 300);
            });
        });
    }
});
