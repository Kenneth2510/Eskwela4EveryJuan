$(document).ready(function () {
    const nextBtn = $("#nxtBtn");
    const nextBtn2 = $("#nxtBtn2");
    const backBtn = $("#bckBtn");
    const prevBtn = $("#prevBtn");
    const prevBtn2 = $("#prevBtn2");
    const firstForm = $("#first-form");
    const secondForm = $("#resumeForm");
    const thirdForm = $("#security_code");
    const header = $("#ins-head");
    const footer = $("#ins-foot");

    nextBtn.on("click", function (event) {
        event.preventDefault();

        firstForm.addClass("hidden");
        secondForm.removeClass("hidden");
        header.addClass("hidden");
        footer.addClass("hidden");
    });

    nextBtn2.on("click", function (event) {
        event.preventDefault();

        secondForm.addClass("hidden");
        thirdForm.removeClass("hidden");
        header.addClass("hidden");
        footer.addClass("hidden");
    });

    prevBtn.on("click", function (event) {
        event.preventDefault();

        secondForm.addClass("hidden");
        firstForm.removeClass("hidden");
        header.removeClass("hidden");
        footer.removeClass("hidden");
    });

    prevBtn2.on("click", function (event) {
        event.preventDefault();

        thirdForm.addClass("hidden");
        secondForm.removeClass("hidden");
        header.addClass("hidden");
        footer.addClass("hidden");
    });

    backBtn.on("click", function (event) {
        event.preventDefault();

        firstForm.removeClass("hidden");
        secondForm.addClass("hidden");
        header.removeClass("hidden");
        footer.removeClass("hidden");
    });

    const imgSlides = $(".slides");
    const carouselBtn = $("#carouselBtn button");
    let crrntSlide = 0;
    let slideInterval;

    function initCarousel() {
        imgSlides.hide();
        imgSlides.eq(crrntSlide).show();
        carouselBtn.removeClass("bg-slate-500");
        carouselBtn.eq(crrntSlide).addClass("bg-slate-500");
    }

    function showSlide(index) {
        imgSlides.hide();
        imgSlides.eq(index).show();
        carouselBtn.removeClass("bg-slate-500");
        carouselBtn.eq(index).addClass("bg-slate-500");
        crrntSlide = index;
    }

    function nextSlide() {
        const nextSlide = (crrntSlide + 1) % imgSlides.length;
        showSlide(nextSlide);
    }

    function startSlideInterval() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function stopSlideInterval() {
        clearInterval(slideInterval);
    }

    // Automatically switch to the next slide every 5 seconds
    startSlideInterval();

    // Event listener for next button
    $("#l-nextBtn").click(function () {
        nextSlide();
        stopSlideInterval();
        startSlideInterval();
    });

    // Event listener for previous button
    $("#l-prevBtn").click(function () {
        const prevSlide =
            (crrntSlide - 1 + imgSlides.length) % imgSlides.length;
        showSlide(prevSlide);
        stopSlideInterval();
        startSlideInterval();
    });

    // Event listener for carousel buttons
    carouselBtn.each(function (index) {
        $(this).click(function () {
            showSlide(index);
            stopSlideInterval();
            startSlideInterval();
        });
    });

    // Initialize the carousel on page load
    initCarousel();
});
