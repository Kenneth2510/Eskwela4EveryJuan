$(document).ready(function () {
    var lessons = [];
    var lessonCount = 0;

    function displayLessons() {
        $("#lesson_body").empty();
        lessons.forEach(function (lesson) {
            var newRow =
                `
            <tr class="border-b-2 border-black">
                                <td class="text-center">` +
                lesson["id"] +
                `</td>
                                <td class="flex items-center justify-between">
                                    <input class="edit_row" data-id="` +
                lesson["id"] +
                `" type="text" disabled value="` +
                lesson["lesson_name"] +
                `">
                                    <div class="">
                                        <button type="button" class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400 edit-lesson" data-id="` +
                lesson["id"] +
                `">Edit</button>
                                        <button type="button" class="hidden h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400 delete-lesson" data-id="` +
                lesson["id"] +
                `">Delete</button>
                                    </div>
                                </td>
                            </tr>
            `;

            $("#lesson_body").append(newRow);
        });
    }

    $("#addLesson_start").on("click", function (e) {
        e.preventDefault();
        $("#addLesson_form").removeClass("hidden");
        $("#lesson_name").focus();
        $("#addLesson_start").addClass("hidden");
        $("#addLesson_button").removeClass("hidden");
        $("#addLesson_type").removeClass("hidden");

        $("#selectTypeParent").addClass("hidden");

        // $("#selectTypeParent").removeClass("hidden");
    });

    // $("#selectTypeCloseBtn").on("click", (e) => {
    //     e.preventDefault();

    //     $("#selectTypeParent").addClass("hidden");
    // });

    // $("#selectTypeParent").on("click", (e) => {
    //     if (!$(e.target).is("#selectTypeChild")) {
    //         $("#selectTypeParent").toggleClass("hidden");
    //     }
    // });

    // $("#selectTypeChild").on("click", (e) => {
    //     e.stopPropagation();
    // });

    // $("#selectTypeConfirmBtn").on("click", (e) => {
    //     e.preventDefault();

    //     $("#addLesson_form").removeClass("hidden");
    //     $("#lesson_name").focus();
    //     $("#addLesson_start").addClass("hidden");
    //     $("#addLesson_button").removeClass("hidden");

    //     $("#selectTypeParent").addClass("hidden");
    // });

    $("#addLesson_cancel").on("click", function (e) {
        e.preventDefault();

        $("#addLesson_form").addClass("hidden");
        $("#addLesson_start").removeClass("hidden");
        $("#addLesson_button").addClass("hidden");
        $("#addLesson_type").addClass("hidden");
    });

    $("#addLesson_now").on("click", function (e) {
        e.preventDefault();

        var lessonName = $("#lesson_name").val();

        if (lessonName.trim() !== "") {
            lessonCount++;

            var newLesson = {
                id: lessonCount,
                lesson_name: lessonName,
            };

            lessons.push(newLesson);
            lessonName = "";
            $("#lesson_name").val("");
        }

        $("#addLesson_form").addClass("hidden");
        $("#addLesson_start").removeClass("hidden");
        $("#addLesson_button").addClass("hidden");
        $("#addLesson_type").addClass("hidden");

        displayLessons();

        // console.log(lessons);
    });

    //     $('#nextAddCourse').on('click', function(e) {
    //         e.preventDefault();

    //         $('#secondCreateCourse').removeClass('hidden');
    //         $('#firstCreateCourse').addClass('hidden');
    //     })

    //     $('#returnTo_first').on('click', function(e) {
    //         $('#secondCreateCourse').addClass('hidden');
    //         $('#firstCreateCourse').removeClass('hidden');
    //     })

    // $('#edit-lesson[data-id="' + lesson.id + '"]').on('click', function(e) {
    //     e.preventDefault(); // Prevent the default form submission
    //     alert('Edit lesson with ID ' + lesson.id);
    // });

    $("#lesson_body").on("click", ".edit-lesson", function (e) {
        e.preventDefault();

        var lessonId = $(this).data("id");

        var row = $(this).closest("tr");
        var inputField = row.find('input[type="text"]');

        inputField.removeAttr("disabled");
        inputField.focus();

        $(this).replaceWith(
            '<button class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400 save-lesson" data-id="' +
                lessonId +
                '">Save</button>',
        );
    });

    $("#lesson_body").on("click", ".save-lesson", function (e) {
        e.preventDefault();

        var lessonId = $(this).data("id");

        var row = $(this).closest("tr");
        var inputField = row.find('input[type="text"]');

        var updatedLessonName = inputField.val();

        var lessonIndex = lessons.findIndex(function (lesson) {
            return (lesson.id = lessonId);
        });

        if (lessonIndex !== -1) {
            lessons[lessonIndex].lesson_name = updatedLessonName;

            inputField.attr("disabled", "disabled");

            $(this).replaceWith(
                '<button class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400 edit-lesson" data-id="' +
                    lessonId +
                    '">Edit</button>',
            );
        }
    });

    $("#lesson_body").on("click", ".delete-lesson", function (e) {
        e.preventDefault();

        var lessonId = $(this).data("id");

        var lessonIndex = lessons.findIndex((lesson) => lesson.id === lessonId);

        if (lessonIndex !== -1) {
            lessons.splice(lessonIndex, 1);

            lessons.forEach((lesson, index) => {
                lesson.id = index + 1;
            });

            $(this).closest("tr").remove();
        }
    });

    $("#addCourse").submit(function (e) {
        e.preventDefault();

        var course_name = $("#course_name").val();
        var course_description = $("#course_description").val();
        var course_difficulty = $("#course_difficulty").val();

        if (
            course_name === "" ||
            course_description === "" ||
            course_difficulty === ""
        ) {
            alert("Please fill all fields");

            if (course_name === "") {
                var errorMsg = `
                    <span class="text-red-600">*Please enter a Course Name*</span>
                    `;

                $("#course_name").before(errorMsg);
            }
            if (course_description === "") {
                var errorMsg = `
                    <span class="text-red-600">*Please enter a Course Description*</span>
                    `;

                $("#course_description").before(errorMsg);
            }
            if (course_difficulty === null || course_difficulty === "") {
                var errorMsg = `
                    <span class="text-red-600">*Please select a Course Difficulty*</span>
                    `;

                $("#course_difficulty").before(errorMsg);
            }
        } else {
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "/instructor/courses/create",
                data: formData,
                contentType: false,
                processData: false,
                async: false,
                success: function (response) {
                    if (response && response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } else {
                    }
                },
            });
        }
    });
});
