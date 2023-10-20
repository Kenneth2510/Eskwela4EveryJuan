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
})