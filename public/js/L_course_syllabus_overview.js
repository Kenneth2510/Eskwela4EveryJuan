$(document).ready(function() {
    var syllabusData = {};


    $("#showSyllabusBtn").click(function() {
        // Toggle the visibility of the modal
        var courseID = $(this).data("course-id");
        $("#syllabusModal").toggleClass("hidden");
        getSyllabusData(courseID);
      });
    
      // Click event for the close button within the modal
      $("#removeModalBtn").click(function() {
        // Toggle the visibility of the modal
        $("#syllabusModal").toggleClass("hidden");
      });


      function getSyllabusData(courseID) {
        // alert(courseID);

        var url ="/learner/course/manage/"+ courseID +"/view_syllabus"
        $.ajax ({
            type: "GET",
            url: url,
            dataType: 'json',
            success: function (response){
                console.log(response)
                // displaySyllabus(response['syllabus'])
                syllabusData = response['syllabus']
                // console.log(syllabusData)
                reDisplaySyllabus(syllabusData)
            },
            error: function(error) {
                console.log(error);
            }
      })
    }

    function reDisplaySyllabus(syllabusData) {
        var syllabusRowDisp = ``;
        var location_selection_main = ``;
        var location_selection_sub =``;
        // console.log(syllabusData);
        var j = 1;
        for (let i = 0; i < syllabusData.length; i++) {
            const syllabus_id = syllabusData[i]['syllabus_id'];
            const topic_title = syllabusData[i]['topic_title'];
            const category = syllabusData[i]['category'];
            console.log(syllabusData[i])

            syllabusRowDisp += `
            <tr>
            <td><input type="text" class="rowtopic_id" value="` + j++ + `" disabled></td>
            <td><input type="text" class="rowtopic_title w-5/6" value="${topic_title}" disabled></td>
            <td>
                <select class="rowTopicType block w-full px-4 py-2 mt-2 rounded-md border border-gray-300 focus:ring focus:ring-seagreen focus:ring-opacity-50" disabled>
                    <option value="LESSON" ${category === 'LESSON' ? 'selected' : ''}>LESSON</option>
                    <option value="ACTIVITY" ${category === 'ACTIVITY' ? 'selected' : ''}>ACTIVITY</option>
                    <option value="QUIZ" ${category === 'QUIZ' ? 'selected' : ''}>QUIZ</option>
                </select>
            </td>
        </tr>
            `;

            location_selection_sub += `
            <option value="`+ topic_title +`">AFTER `+ topic_title +`</option>
            `;

            location_selection_main = `
                <option value="START">At the Beginning</option>
            `+ location_selection_sub +`
                <option value="END">In the End</option>
            `;
            
        }
        $('#syllabusTableBody').empty();
        $('#syllabusTableBody').append(syllabusRowDisp);
    }



    
    getLearnerData()

    function getLearnerData() {
        var url = `/learner/learnerData`;
            $.ajax({
                type: "GET",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    console.log(response);

                    var learner = response['learner']
                    // init_chatbot(learner);
                    getCourseData(learner)

                    $('.loaderArea').addClass('hidden');
                    $('.mainchatbotarea').removeClass('hidden');


                },
                error: function(error) {
                    console.log(error);
                }
            });
    }

    function getCourseData(learner) {
        var course_id = $('#showSyllabusBtn').data("course-id")
        var url = `/chatbot/courseData/${course_id}`;
        $.ajax({
            type: "GET",
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
    
                var courseData = response['course']
                $('.submitQuestion').on('click', function(e) {
                    e.preventDefault()
                    var learner_id = learner['learner_id']
                    var question = $('.question').val();
                    var course = courseData['course_name']
                    var lesson = 'ALL'
            
            
                    displayUserMessage(question, learner)
                    $('.botloader').removeClass('hidden')
                    var chatData = {
                        question: question,
                        course: course,
                        lesson: lesson,
                    }
            
                    var url = `/chatbot/chat/${learner_id}`;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: chatData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log(response);
                            displayBotMessage(response)
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                })
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    

    function displayUserMessage(question, learner) {
        var userMessageDisp = ``;
        var profile = learner['profile_picture']
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();

        minutes = minutes < 10 ? '0' + minutes : minutes;

        var timeString = hours + ':' + minutes;
    
        userMessageDisp += `
        
        <div class="mx-3 chat chat-end">
            <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                <img class="bg-red-500" alt="" src="/storage/${profile}" />
                </div>
            </div>
            <div class="mx-3 chat-header">
                You
            </div>
            <div class="whitespace-pre-wrap chat-bubble chat-bubble-primary">${question}</div>
            <div class="opacity-50 chat-footer">
            ${timeString}
            </div>
        </div>
        `;

        $('.chatContainer').append(userMessageDisp);
    }


    function displayBotMessage(response) {

        var message = response['message']

        var botMessageDisp = ``
        botMessageDisp += `
        
        <div class="chat chat-start">
            <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                <img class="bg-white" alt="" src="/storage/app/public/images/chatbot.png" />
                </div>
            </div>
            <div class="chat-bubble ">${message}</div>
        </div>
        `;

        $('.botloader').addClass('hidden')
        $('.chatContainer').append(botMessageDisp);
    }
    
})