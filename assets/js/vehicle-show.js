document.addEventListener('DOMContentLoaded', () => {

    const track = document.getElementById('carouselTrack');
    if (!track) return;

    const slides = track.children;
    const thumbs = document.querySelectorAll('.thumbBtn');

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');

    let index = 0;
    const total = slides.length;

    function updateCarousel() {

        track.style.transform =
            `translateX(-${index * 100}%)`;

        // highlight active thumb
        thumbs.forEach(t =>
            t.classList.remove('border-blue-500')
        );

        thumbs[index]?.classList.add('border-blue-500');
    }

    nextBtn?.addEventListener('click', e => {
        e.stopPropagation();
        index = (index + 1) % total;
        updateCarousel();
    });

    prevBtn?.addEventListener('click', e => {
        e.stopPropagation();
        index = (index - 1 + total) % total;
        updateCarousel();
    });

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => {
            index = parseInt(thumb.dataset.index);
            updateCarousel();
        });
    });

    updateCarousel();

    if (window.Fancybox) {
        Fancybox.bind("[data-fancybox='gallery']");
    }

});
