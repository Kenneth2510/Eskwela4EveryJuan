$(document).ready(function () {
    $("#nextAddCourse").on("click", function (event) {
        event.preventDefault();

        $("#firstCreateCourse").addClass("hidden");
        $("#secondCreateCourse").removeClass("hidden");
    });

    $("#backCreateCourse").on("click", function (event) {
        event.preventDefault();

        if ($("#firstCreateCourse").hasClass("hidden")) {
            $("#firstCreateCourse").removeClass("hidden");
            $("#secondCreateCourse").addClass("hidden");
        } else {
            window.location.replace("/instructor/courses");
        }
    });

    $("#fileInput").on("change", function () {
        var files = $("#fileInput").prop("files");
        let filename = $.map(files, (val) => {
            return val.name;
        });

        console.log("Filename:");
        console.log(filename);

        $("#uploadedFileName").append(
            "<li class='border-b-2'>" + filename + "</li>",
        );
    });
});
