$(document).ready(() => {
    $("#learnerNextBtn").on("click", (event) => {
        event.preventDefault();

        $("#learnerPersonalInfo").addClass("hidden");
        $("#learnerBusinessInfo").removeClass("hidden");
    });

    $("#learnerBackBtn").on("click", (event) => {
        event.preventDefault();

        $("#learnerPersonalInfo").removeClass("hidden");
        $("#learnerBusinessInfo").addClass("hidden");
    });
});
