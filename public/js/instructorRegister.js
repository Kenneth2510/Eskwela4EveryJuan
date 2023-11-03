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
});
