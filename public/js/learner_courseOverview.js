$(document).ready(function() {
    var baseUrl = window.location.href
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('#enrollBtn').on('click', function(e) {
        e.preventDefault();

        $('#enrollCourseModal').removeClass('hidden');
    });

    $('.cancelEnroll').on('click', function(e) {
        e.preventDefault();

        $('#enrollCourseModal').addClass('hidden');
    });

    $("#enrollCourse").on('click', function (e) {
        e.preventDefault();
        var courseID = $(this).data("course-id");

    
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

    $('.cancelUnenroll').on('click', function(e) {
        $('#unenrollCourseModal').addClass('hidden');
    });

    $('#unenrollCourse').on('click',function(e) {
        
        e.preventDefault();

        var lessonCourseID = $(this).data("learner-course-id");

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


    $('#courseDetailsBtn').css({
        'background-color': '#FFFFFF',
        'color': '#025C26',
    });

    $('#courseDetailsBtn').on('click', function(e) {
        e.preventDefault();

        $('#courseInfoArea').removeClass('hidden')
        $('#learnersEnrolledArea').addClass('hidden')
        $('#gradesheetArea').addClass('hidden')
        $('#filesArea').addClass('hidden')

        $(this).css({
            'background-color': '#FFFFFF',
            'color': '#025C26',
        });

        $('#learnersEnrolledBtn , #gradesheetBtn , #courseFilesBtn').css({
            'background-color': '#025C26',
            'color': '#ffffff',
        });
    })

    $('#learnersEnrolledBtn').on('click', function(e) {
        e.preventDefault();

        $('#courseInfoArea').addClass('hidden')
        $('#learnersEnrolledArea').removeClass('hidden')
        $('#gradesheetArea').addClass('hidden')
        $('#filesArea').addClass('hidden')
        $(this).css({
            'background-color': '#FFFFFF',
            'color': '#025C26',
        });

        $('#courseDetailsBtn , #gradesheetBtn , #courseFilesBtn').css({
            'background-color': '#025C26',
            'color': '#ffffff',
        });
    })

    $('#gradesheetBtn').on('click', function(e) {
        e.preventDefault();

        $('#courseInfoArea').addClass('hidden')
        $('#learnersEnrolledArea').addClass('hidden')
        $('#gradesheetArea').removeClass('hidden')
        $('#filesArea').addClass('hidden')
        $(this).css({
            'background-color': '#FFFFFF',
            'color': '#025C26',
        });

        $('#courseDetailsBtn , #learnersEnrolledBtn , #courseFilesBtn').css({
            'background-color': '#025C26',
            'color': '#ffffff',
        });
    })

    $('#courseFilesBtn').on('click', function(e) {
        e.preventDefault();

        $('#courseInfoArea').addClass('hidden')
        $('#learnersEnrolledArea').addClass('hidden')
        $('#gradesheetArea').addClass('hidden')
        $('#filesArea').removeClass('hidden')
        $(this).css({
            'background-color': '#FFFFFF',
            'color': '#025C26',
        });

        $('#courseDetailsBtn , #learnersEnrolledBtn , #gradesheetBtn').css({
            'background-color': '#025C26',
            'color': '#ffffff',
        });
    })


    $('#viewDetailsBtn').on('click', function() {

        $('#courseDetailsModal').removeClass('hidden')
    })

    
    $('.closeCourseDetailsModal').on('click', function() {

        $('#courseDetailsModal').addClass('hidden')
    })



})