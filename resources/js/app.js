import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

Alpine.data('swiper', function (options = {}) {

    const el = this.$el;

    el.classList.add('swiper', 'swiper-container')

    const swiper = new Swiper(this.$el, {
        modules: [Navigation, Pagination, Autoplay],

        on: {
            init: () => {
                el.classList.remove('swiper-cloak')
            },
        },


        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },



        slidesPerView: 6,
        spaceBetween: 30,
        // loop: true,
        autoplay: {
            delay: 5000,

        },
        freeMode: true,
        paginationClickable: true,
        watchSlidesProgress: true,
        ...options,
    });

    return {
        swiper
    }
})



Livewire.start()
