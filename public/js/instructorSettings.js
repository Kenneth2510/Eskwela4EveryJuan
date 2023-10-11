$(document).ready(() => {
    $("#hamburgerSettings").on("click", (event) => {
        event.preventDefault();

        $("li h1").toggleClass("md:block");
        $("button h1").toggleClass("hidden");

        $("#insSideCont").toggleClass("w-full md:w-1/3 lg:w-2/12 w-1/4");
        // $("#insDashCont").toggleClass("md:w-3/4 lg:w-9/12");
    });
});
