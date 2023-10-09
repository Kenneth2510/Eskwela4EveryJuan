$(document).ready(() => {
    $("#hamburgerSettings").on("click", (event) => {
        event.preventDefault();

        $("li h1").toggleClass("md:block");
        $("button h1").toggleClass("hidden");

        $("#instructorSidebar").toggleClass("md:w-1/4 lg:w-2/12 w-full");
    });
});
