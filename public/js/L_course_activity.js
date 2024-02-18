$(document).ready(function() {
    const modal = $('#confirmationModal');
    const confirmButton = $('#confirmButton');
    const cancelButton = $('#cancelButton');

    // Show the modal
    function showModal() {
        modal.removeClass('hidden');
    }

    // Hide the modal
    function hideModal() {
        modal.addClass('hidden');
    }

    // Show modal when the submit button is clicked
    $('#submitButton').on('click', function(event) {
        event.preventDefault(); // Prevent the default form submission
        showModal();
    });

    // Hide modal when the cancel button is clicked
    cancelButton.on('click', function() {
        hideModal();
    });

    // Handle the actual form submission when the confirm button is clicked
    confirmButton.on('click', function() {
        // Uncomment the line below if you want to submit the form programmatically
        // $('#yourFormId').submit();
        var learnerCourseID = $(this).data('learner-course-id');
        var courseID = $(this).data('course-id');
        var syllabusID = $(this).data('syllabus-id');
        var activityID = $(this).data('activity-id');
        var activityContentID = $(this).data('activity-content-id');


        console.log('learnerCourse ' , learnerCourseID)
        console.log('courseID ' , courseID)
        console.log('syllabusID ' , syllabusID)
        console.log('activityID ' , activityID)
        console.log('activityContentID ' , activityContentID)
        
        var answer = $('#activity_answer').val();

        var answerData = {
            answer: answer
        }
        
        if(answer !== null && answer !== "") {
            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag
            var url = "/learner/course/content/"+ courseID +"/"+ learnerCourseID +"/activity/"+ syllabusID +"/answer/"+ activityID +"/" + activityContentID; 

            $.ajax({
                type: 'POST',
                url: url,
                data: answerData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if (response && response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } 
                    // else {
                    
                    // }
                    // alert('done')
                },
                error: function (xhr, status, error) {
        
                    console.log(xhr.responseText);
                }
            });
        } else {
            hideModal();
            alert("Please enter your answer");
        }
        // For now, just hide the modal
        // hideModal();
    });
});