$(document).ready(function () {
    const nextBtn = $("#nxtBtn");
    const backBtn = $("#bckBtn");
    const firstForm = $("#first-form");
    const secondForm = $("#resumeForm");

    nextBtn.on("click", function (event) {
        event.preventDefault();

        firstForm.addClass("hidden");
        secondForm.removeClass("hidden");
    });

    backBtn.on("click", function (event) {
        event.preventDefault();

        firstForm.removeClass("hidden");
        secondForm.addClass("hidden");
    });
});
