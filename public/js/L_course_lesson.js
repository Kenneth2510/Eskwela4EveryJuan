$(document).ready(function() {
    // {{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/lesson/$syllabus->syllabus_id/finish") }}

    $('#finishLessonBtn').on('click', function(e) {
        e.preventDefault();

        $('#finishLessonModal').removeClass('hidden');
    })

    $('.cancelFinishLessonBtn').on('click', function(e) {
        e.preventDefault();

        $('#finishLessonModal').addClass('hidden');
    })





    $('#confirmFinishLessonBtn').on('click', function(e) {
        
        var courseID = $(this).data('course-id');
        var learnerCourseID = $(this).data('learner-course-id');
        var syllabusID = $(this).data('syllabus-id');
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag
    
        var url = "/learner/course/content/"+ courseID +"/"+ learnerCourseID +"/lesson/"+ syllabusID +"/finish";

        $.ajax ({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response){
                console.log(response)
                if (response && response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                
                }
            },
            error: function(error) {
                console.log(error);
            }
      })
    })

})