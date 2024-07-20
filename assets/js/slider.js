document.addEventListener('DOMContentLoaded', function() {
    let sliderView = document.querySelector('.wpoop-slider--view > ul'),
        sliderViewSlides = document.querySelectorAll( '.wpoop-slider--view__slides' ),
        leftArrow = document.querySelector('.testimonial-arrow__left'),
        rightArrow = document.querySelector('.testimonial-arrow__right'),
        sliderLength = sliderViewSlides.length;

    const slideMe = ( sliderViewItems, activeItem ) => {
        // activeItem.classlist.remove('is-active')

        // sliderViewItems.classlist.add('is-active')
        sliderView.setAttribute('style', 'transform: translateX(-'+ sliderViewItems.offsetLeft+'px)')
    }

    let beforeSliding = i => {

        let activeItem = document.querySelector('.wpoop-slider--view__slides.is-active'),
            currentItem = Array.from(sliderViewSlides).indexOf(activeItem) + i,
            nextItem = currentItem + i,
            sliderViewItems = document.querySelector(`.wpoop-slider--view__slides:nth-child(${nextItem})`);

        if ( nextItem > sliderLength ) {
            sliderViewItems = document.querySelector(`.wpoop-slider--view__slides:nth-child( 1 )`);
        }

        if ( nextItem === 0 ) {
            sliderViewItems = document.querySelector(`.wpoop-slider--view__slides:nth-child( ${sliderLength} )`);
        }

        slideMe( sliderViewItems, activeItem );

    }


    leftArrow.addEventListener('click', () => beforeSliding( 0 ) )
    rightArrow.addEventListener('click', () => beforeSliding( 1 ) )
})