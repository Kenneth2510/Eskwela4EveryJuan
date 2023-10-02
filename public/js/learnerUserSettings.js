$(document).ready(function () {
    $("#showLearnerPersonal").on("click", () => {
        $("#learnerPersonal").toggleClass("hidden");
    });
    $("#showLearnerLogin").on("click", () => {
        $("#learnerLogin").toggleClass("hidden");
    });
    $("#showLearnerBusiness").on("click", () => {
        $("#learnerBusiness").toggleClass("hidden");
    });
});
