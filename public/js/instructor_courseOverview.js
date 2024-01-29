$(document).ready(function() {
    var baseUrl = window.location.href

    getTotalEnrolledCourse();

    function getTotalEnrolledCourse() {
        var url = baseUrl + "/overviewNum";

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                console.log(response)
                var enrolleeProgress = response['enrolleeProgress']

                courseProgressGraph(enrolleeProgress);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function courseProgressGraph(enrolleeProgress) {

        const statusCounts = {};
        
        enrolleeProgress.forEach((learner) => {
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
    
        const ctx = $('#learnerProgressChart');
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
                    label: 'Number of Learners',
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

})