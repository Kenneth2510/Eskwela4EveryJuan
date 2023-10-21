$(document).ready(function() {
    $('#enrollBtn').on('click', function(e) {
        e.preventDefault();

        $('#enrollCourseModal').removeClass('hidden');
    });

    $('#cancelEnroll').on('click', function(e) {
        e.preventDefault();

        $('#enrollCourseModal').addClass('hidden');
    });

    $("#enrollCourse").submit(function (e) {
        e.preventDefault();
        var courseID = $(this).data("course-id");
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag
    
        $.ajax({
            type: 'POST',
            url: '/learner/course/enroll/' + courseID,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                if (response && response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                
                }
            },
            error: function (xhr, status, error) {
    
                console.log(xhr.responseText);
            }
        });
        });

    $('#unenrollBtn').on('click', function(e) {
        e.preventDefault();

        $('#unenrollCourseModal').removeClass('hidden');
    });

    $('#cancelUnenroll').on('click', function(e) {
        $('#unenrollCourseModal').addClass('hidden');
    });

    $('#unenrollCourse').submit(function(e) {
        
        e.preventDefault();

        var lessonCourseID = $(this).data("learner_course-id");
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag
        // console.log('/learner/course/unenroll/' + lessonCourseID);
        $.ajax({
            type: 'POST',
            url: '/learner/course/unEnroll/' + lessonCourseID,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                if (response && response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                
                }
            },
            error: function (xhr, status, error) {
    
                console.log(xhr.responseText);
            }

        })
    })


    $('#unenrollBtn2').on('click', function(e) {
        e.preventDefault();

        $('#unenrollCourseModal2').removeClass('hidden');
    });

    $('#cancelUnenroll2').on('click', function(e) {
        $('#unenrollCourseModal2').addClass('hidden');
    });

    $('#unenrollCourse2').submit(function(e) {
        
        e.preventDefault();

        var lessonCourseID = $(this).data("learner_course-id");
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag
        // console.log('/learner/course/unenroll/' + lessonCourseID);
        $.ajax({
            type: 'POST',
            url: '/learner/course/unEnroll/' + lessonCourseID,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                if (response && response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                
                }
            },
            error: function (xhr, status, error) {
    
                console.log(xhr.responseText);
            }

        })
    })

        $('#display_info_btn').on('click', function() {
            $('#learner_course_info').removeClass('hidden');
            $('#learner_enrolled_learners').addClass('hidden');
            $('#enrollment_summary').addClass('hidden');
        });
        $('#enrolled_learners_btn').on('click', function() {
            $('#learner_course_info').addClass('hidden');
            $('#learner_enrolled_learners').removeClass('hidden');
            $('#enrollment_summary').addClass('hidden');
        });
        $('#enrollment_summary_btn').on('click', function() {
            $('#learner_course_info').addClass('hidden');
            $('#learner_enrolled_learners').addClass('hidden');
            $('#enrollment_summary').removeClass('hidden');
        })
    
    //  $("#showDeleteModal").click(function () {
    //             $("#deleteCourseModal").removeClass("hidden");
    //         });
        
    //         $("#cancelDelete").click(function () {
    //             $("#deleteCourseModal").addClass("hidden");
    //         });
    //      $("#deleteCourse").submit(function (e) {
    //         e.preventDefault();
    //         var courseID = $(this).data("course-id");
    //         var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag
    
    //         $.ajax({
    //             type: 'POST',
    //             url: '/instructor/course/delete/' + courseID,
    //             headers: {
    //                 'X-CSRF-TOKEN': csrfToken
    //             },
    //             success: function (response) {
    //                 if (response && response.redirect_url) {
    //                     window.location.href = response.redirect_url;
    //                 } else {
                    
    //                 }
    //             },
    //             error: function (xhr, status, error) {
       
    //                 console.log(xhr.responseText);
    //             }
    //         });
    //         });
    
    
        // $('#enrolleeForm').on('submit', function(e) {
        //     e.preventDefault(); // Prevent the default form submission
    
        //     // Gather form data
        //     var courseID = $(this).data("course-id");
        //     var formData = $(this).serialize();
    
        //     // Make an AJAX request
        //     $.ajax({
        //         type: 'GET', // Use the appropriate HTTP method
        //         url: '/instructor/course/manage/' . courseID, // Set your form action URL
        //         data: formData, // Include the form data
        //         success: function(response) {
        //             // Handle the response here, e.g., update the table with new data
        //             // You can replace the table content with the new data received from the server
        //             $('#learner_table').html(response);
        //         },
        //         error: function(error) {
        //             // Handle errors if any
        //             console.log(error);
        //         }
        //     });
        // });
})