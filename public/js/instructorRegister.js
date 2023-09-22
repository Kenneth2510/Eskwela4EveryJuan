$(document).ready(function () {
    const nextBtn = $("#nxtBtn");
    const backBtn = $("#bckBtn");
    const firstForm = $("#first-form");
    const secondForm = $("#resumeForm");
    const header = $("#ins-head");
    const footer = $('#ins-foot')

    nextBtn.on("click", function (event) {
        event.preventDefault();

        firstForm.addClass("hidden");
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
