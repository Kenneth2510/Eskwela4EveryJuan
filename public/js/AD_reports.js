$(document).ready(function() {

    var baseUrl = window.location.href;



    $('#reportCategory').on('change', function(e) {
        e.preventDefault();

        var category = $(this).val();


        if (category === "Users") {
            $('#listUsersArea').removeClass('hidden')

            
            $('#userSessionDataArea').addClass('hidden')
            $('#sessionDataArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#courseGradesheetArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
            $('#learnerPerformanceArea').addClass('hidden')

        } else if (category === "Session") {
            $('#sessionDataArea').removeClass('hidden')

            
            $('#userSessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#courseGradesheetArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
            $('#learnerPerformanceArea').addClass('hidden')

        } else if (category === "UserSession") {
            $('#userSessionDataArea').removeClass('hidden')

            
            $('#sessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#courseGradesheetArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
            $('#learnerPerformanceArea').addClass('hidden')

        } else if (category === "Courses") {
            $('#listCourseArea').removeClass('hidden')

            
            $('#userSessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#sessionDataArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#courseGradesheetArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
            $('#learnerPerformanceArea').addClass('hidden')

        } else if (category === "Enrollees") {
            $('#listCourseEnrolleesArea').removeClass('hidden')

            
            $('#userSessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#sessionDataArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#courseGradesheetArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
            $('#learnerPerformanceArea').addClass('hidden')

        } else if (category === "CourseGradesheets") {
            $('#courseGradesheetArea').removeClass('hidden')

            
            $('#userSessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#sessionDataArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
            $('#learnerPerformanceArea').addClass('hidden')
            
        } else if (category === "CoursePerformances") {
            $('#coursePerformanceArea').removeClass('hidden')

            
            $('#userSessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#sessionDataArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#courseGradesheetArea').addClass('hidden')
            $('#learnerPerformanceArea').addClass('hidden')

        } else if (category === "LearnerGradesheets") {
            $('#learnerPerformanceArea').removeClass('hidden')

            
            $('#userSessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#sessionDataArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#courseGradesheetArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
        } else {
            alert('please choose a category')

            $('#learnerPerformanceArea').addClass('hidden')
            
            
            $('#userSessionDataArea').addClass('hidden')
            $('#listUsersArea').addClass('hidden')
            $('#sessionDataArea').addClass('hidden')
            $('#listCourseArea').addClass('hidden')
            $('#listCourseEnrolleesArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
            $('#coursePerformanceArea').addClass('hidden')
        }
    })


    $('#userSessionCategory').on('change', function() {
        var category = $(this).val();

        if(category === 'Learners') {
            $('#userSessionLearnerArea').removeClass('hidden')
            $('#userSessionInstructorArea').addClass('hidden')
        } else {
            $('#userSessionLearnerArea').addClass('hidden')
            $('#userSessionInstructorArea').removeClass('hidden')
        }
    })

})