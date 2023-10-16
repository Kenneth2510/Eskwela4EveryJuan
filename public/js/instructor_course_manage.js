$(document).ready(function() {

    $('#edit_info_btn').on('click', function() {
        $('#course_info').removeClass('hidden');
        $('#enrolled_learners').addClass('hidden');
        $('#course_summary').addClass('hidden');
    });
    $('#enrolled_learners_btn').on('click', function() {
        $('#course_info').addClass('hidden');
        $('#enrolled_learners').removeClass('hidden');
        $('#course_summary').addClass('hidden');
    });
    $('#course_summary_btn').on('click', function() {
        $('#course_info').addClass('hidden');
        $('#enrolled_learners').addClass('hidden');
        $('#course_summary').removeClass('hidden');
    })

    $('#editCourse').on('click', function(e) {
        e.preventDefault();

        $('#course_name').prop('disabled', false);
        $('#course_name').focus();
        $('#course_description').prop('disabled', false);
        $('#course_difficulty').prop('disabled', false);

        $('#cancelEditCourse').removeClass('hidden');
        $('#saveEditCourse').removeClass('hidden');
        $('#editCourse').addClass('hidden');
    });

    $('#cancelEditCourse').on('click', function(e) {
        e.preventDefault();

        $('#course_name').prop('disabled', true);
        $('#course_description').prop('disabled', true);
        $('#course_difficulty').prop('disabled', true);

        $('#cancelEditCourse').addClass('hidden');
        $('#saveEditCourse').addClass('hidden');
        $('#editCourse').removeClass('hidden');
    })

    $('#updateCourse').submit(function(e) {

        e.preventDefault();
        const courseName = $('#course_name').val();
        const courseDescription = $('#course_description').val();
        const courseDifficulty = $('#course_difficulty').val();

        if(courseName === '' ||
            courseDescription === '' ||
            courseDifficulty === '') {
                alert("Please fill all fields");

                if(courseName === '') {
                    var errorMsg = `
                    <span class="text-red-600">*Please enter a Course Name*</span>
                    `;

                    $('#course_name').before(errorMsg);
                }
                if (courseDescription === '') {
                    var errorMsg = `
                    <span class="text-red-600">*Please enter a Course Description*</span>
                    `;

                    $('#course_description').before(errorMsg);
                }
                if (courseDifficulty === null || courseDifficulty === '') {
                    var errorMsg = `
                    <span class="text-red-600">*Please select a Course Difficulty*</span>
                    `;

                    $('#course_difficulty').before(errorMsg);
                } 
        } else {
            var formData = new FormData(this);

            var courseID = $(this).data("course-id");

            $.ajax({
                type: 'POST',
                url: '/instructor/course/manage/' + courseID,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response && response.redirect_url) {
                        window.location.href= response.redirect_url
                    } else {
                        
                    }
                }
            });
        }
    })

 $("#showDeleteModal").click(function () {
            $("#deleteCourseModal").removeClass("hidden");
        });
    
        $("#cancelDelete").click(function () {
            $("#deleteCourseModal").addClass("hidden");
        });
     $("#deleteCourse").submit(function (e) {
        e.preventDefault();
        var courseID = $(this).data("course-id");
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag

        $.ajax({
            type: 'POST',
            url: '/instructor/course/delete/' + courseID,
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

})