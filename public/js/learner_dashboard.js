$(document).ready(function() {
    var baseUrl = window.location.href;

    $('#course_carousel_right_btn').on('click', function() {
        var container = $('#courseCardContainer');
        var containerWidth = container.outerWidth();
        container.scrollLeft(container.scrollLeft() + containerWidth);
    });
    
    $('#course_carousel_left_btn').on('click', function() {
        var container = $('#courseCardContainer');
        var containerWidth = container.outerWidth();
        container.scrollLeft(container.scrollLeft() - containerWidth);
    });


    getTotalEnrolledCourse();

    function getTotalEnrolledCourse() {
        var url = baseUrl + "/overviewNum";

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                console.log(response)

                var learnerCourseData = response['learnerCourseData']
                var totalLearnerCourseCount = response['totalLearnerCourseCount']
                var totalLearnerApprovedCourseCount = response['totalLearnerApprovedCourseCount']
                var totalLearnerPendingCourseCount = response['totalLearnerPendingCourseCount']
                var totalLearnerRejectedCourseCount = response['totalLearnerRejectedCourseCount']
                var totalCoursesLessonCount = response['totalCoursesLessonCount']
                var totalCoursesActivityCount = response['totalCoursesActivityCount']
                var totalCoursesQuizCount = response['totalCoursesQuizCount']
                var totalCoursesLessonCompletedCount = response['totalCoursesLessonCompletedCount']
                var totalCoursesActivityCompletedCount = response['totalCoursesActivityCompletedCount']
                var totalCoursesQuizCompletedCount = response['totalCoursesQuizCompletedCount']
                var totalDaysActive = response['totalDaysActive']
                var totalLearnerCourseCompleted = response['totalLearnerCourseCompleted']


                var totalTopicsCompleted = totalCoursesLessonCompletedCount + totalCoursesActivityCompletedCount + totalCoursesQuizCompletedCount

                $('#totalCoursesText').text(totalLearnerCourseCount)
                $('#totalTopicsText').text(totalTopicsCompleted)
                $('#totalDaysActiveText').text(totalDaysActive)

                $('#totalSyllabusCompletedCount').text(totalTopicsCompleted)
                $('#totalLessonsCompletedCount').text(totalCoursesLessonCompletedCount)
                $('#totalActivitiesCompletedCount').text(totalCoursesActivityCompletedCount)
                $('#totalQuizzesCompletedCount').text(totalCoursesQuizCompletedCount)

                $('#completionRate').text(totalLearnerCourseCompleted)

                courseProgressGraph(learnerCourseData);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function courseProgressGraph(learnerCourseData) {

        const statusCounts = {};
        
        learnerCourseData.forEach((learner) => {
            const status = learner.course_progress;
            statusCounts[status] = (statusCounts[status] || 0) + 1;
        });
    
        const labels = Object.keys(statusCounts);
        const dataValues = labels.map((label) => statusCounts[label]);
    
        const dartmouthGreenPalette = [
            '#00693e',
            '#005230',
            '#004224',
        ];
    
        const ctx = $('#courseProgressGraph');
        if (ctx.data('chart')) {
            ctx.data('chart').destroy();
        }
    
        const newChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: dartmouthGreenPalette,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Status',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Data Points',
                        },
                    },
                },
            },
        });
    
        ctx.data('chart', newChart);
    }

    sessionDataGraph();
    function sessionDataGraph() {
        var url = baseUrl + "/sessionData";

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                console.log(response)

                var totalsPerDay = response['totalsPerDay']

                dispSessionDataGraph(totalsPerDay)
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function dispSessionDataGraph(totalsPerDay) {
        // Function to convert seconds to hh:mm:ss format
        function secondsToHMS(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const remainingSeconds = seconds % 60;
    
            const format = (value) => (value < 10 ? `0${value}` : value);
    
            return `${format(hours)}:${format(minutes)}:${format(remainingSeconds)}`;
        }
    
        const labels = totalsPerDay.map(item => item.date);
        const dataValues = totalsPerDay.map(item => parseInt(item.total_seconds));
        const formattedTimeValues = totalsPerDay.map(item => secondsToHMS(parseInt(item.total_seconds)));
    
        const ctx = $('#learnerSessionGraph');
        if (ctx.data('chart')) {
            ctx.data('chart').destroy();
        }
    
        const newChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    borderColor: '#00693e',
                    fill: true,
                    lineTension: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Time (hh:mm:ss)',
                        },
                        ticks: {
                            // Customize y-axis ticks to show formatted time
                            callback: function(value) {
                                return secondsToHMS(value);
                            },
                        },
                    },
                },
            },
        });
    
        ctx.data('chart', newChart);
    }

})