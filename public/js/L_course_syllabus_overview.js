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

    
})