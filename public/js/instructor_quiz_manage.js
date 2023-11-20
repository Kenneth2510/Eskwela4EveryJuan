$(document).ready(function() {
    getQuizInfo();
    quizReferenceData = {};
    syllabusData = {}
    quizInfoData = {}

    isEditing = 0;

    function getQuizInfo() {
        var baseUrl = window.location.href;
        var url = baseUrl + "/json";

        $.ajax ({
            type: "GET",
            url: url,
            dataType: 'json',
            success: function (response){
                console.log(response)

                quizInfoData = response['quizInfo']
                quizReferenceData = response['quizReference']
                syllabusData = response['syllabusData']

                // console.log(quizReferenceData)

                displayReference(quizReferenceData, syllabusData);
                
            },
            error: function(error) {
                console.log(error);
            }
      })

    }
    

    function displayReference(quizReferenceData, syllabusData) {

        
        var referenceDisp = ``;
        console.log(quizReferenceData)
        if(quizReferenceData !== null ) {
        for (let i = 0; i < quizReferenceData.length; i++) {
            var reference_title = quizReferenceData[i]['topic_title'];
            var syllabus_id  = quizReferenceData[i]['syllabus_id'];

            

                referenceDisp += `
                <tr>             
                    <td class="w-4/5">
                        <select class="w-4/5 m-5 h-14 referenceRow" name="" id="" disabled>
                        <option value="${syllabus_id}">${reference_title}</option>
                `;
                for (let x = 0; x < syllabusData.length; x++) {
                    var x_syllabus_id = syllabusData[x]['syllabus_id'];
                    // var x_topic_id = syllabusData[x]['topic_id'];
                    var x_topic_title = syllabusData[x]['topic_title'];
                    // var category = syllabusData[x]['category'];
                    var course_id = syllabusData[x]['course_id'];
                    

                    referenceDisp += `
                    <option value="${x_syllabus_id}">${x_topic_title}</option>
                    `;
                }
                            
                
                referenceDisp += `
                        </select>
                    </td>
                    <td class="w-1/5">
                        <button class="hidden px-3 py-1 mx-2 font-semibold text-white bg-green-600 rounded-xl editReferenceBtn hover:bg-green-900">Edit</button>
                        <div class="flex hidden editReference_clickedBtns">
                            <button class="px-3 py-1 mx-2 font-semibold text-white bg-green-600 rounded-xl saveReferenceBtn hover:bg-green-900">Save</button>
                            <button class="px-3 py-1 mx-2 font-semibold text-white bg-red-600 rounded-xl deleteReferenceBtn hover:bg-red-900">Delete</button>
                            <button class="px-3 py-1 mx-2 font-semibold text-white bg-red-600 rounded-xl cancelReferenceBtn hover:bg-red-900">Cancel</button>
                        </div>
                    </td>
                </tr>
                `;
                    
            }
        } else {
            referenceDisp += `
                <tr>
                    <td rowspan="3">No Criterias Found</td>
                </tr>
            `;
        }

        $('.referenceTable').empty();
        $('.referenceTable').append(referenceDisp);
        

        // per reference row
    $('.editReferenceBtn').on('click', function(e) {
        e.preventDefault();

        const rowData = $(this).closest('tr');
        rowData.find('.editReference_clickedBtns').toggleClass('hidden');
        rowData.find('.referenceRow').prop('disabled', function(i, v) {
            return !v;
        });

        $(this).addClass('hidden');
    });

    $('.saveReferenceBtn').on('click', function(e) {
        e.preventDefault();
    
        const rowData = $(this).closest('tr');
        const selectedIndex = $(this).closest('tr').index();
        const selectedSyllabusId = rowData.find('.referenceRow').val();
        const selectedTopicTitle = rowData.find('.referenceRow option:selected').text();
    
        // Update the quizReferenceData array with the selected syllabus ID and topic title
        quizReferenceData[selectedIndex].syllabus_id = selectedSyllabusId;
        quizReferenceData[selectedIndex].topic_title = selectedTopicTitle;
    
        // Hide the buttons and disable the dropdown after saving
        rowData.find('.editReference_clickedBtns').addClass('hidden');
        rowData.find('.referenceRow').prop('disabled', true);
        rowData.find('.editReferenceBtn').removeClass('hidden');
        console.log(quizReferenceData)
    });
    

    $('.deleteReferenceBtn').on('click', function(e) {
        e.preventDefault();
    
        const rowData = $(this).closest('tr');
        const selectedIndex = rowData.index();
    
        // Remove the corresponding entry from the quizReferenceData array
        quizReferenceData.splice(selectedIndex, 1);
    
        // Remove the entire row from the table after deletion
        rowData.remove();
        console.log(quizReferenceData);
    });
    
    
    
    $('.cancelReferenceBtn').on('click', function(e) {
        e.preventDefault();

        const rowData = $(this).closest('tr');
        rowData.find('.editReference_clickedBtns').addClass('hidden');
        rowData.find('.referenceRow').prop('disabled', true);

        rowData.find('.editReferenceBtn').removeClass('hidden');
    });

    if (isEditing == 0) {

        $('#editQuizInfoBtn').removeClass('hidden');
        $('#editQuizInfo_clickedBtns').addClass('hidden');
        
        $('.editReferenceBtn').addClass('hidden');
        $('#addNewReference').addClass('hidden');

    } else {

        $('#editQuizInfoBtn').addClass('hidden');
        $('#editQuizInfo_clickedBtns').removeClass('hidden');
        
        $('.editReferenceBtn').removeClass('hidden');
        $('#addNewReference').removeClass('hidden');
        
    }

    }








     //edit whole quiz info
     $('#editQuizInfoBtn').on('click', function(e) {
        e.preventDefault();

        // alert('test')
        $('#editQuizInfoBtn').addClass('hidden');
        $('#editQuizInfo_clickedBtns').removeClass('hidden');
        
        $('.editReferenceBtn').removeClass('hidden');
        $('#addNewReference').removeClass('hidden');

        
        // $('#saveQuizInfoBtn').removeClass('hidden');

        isEditing = 1;
     })
 
     $('#saveQuizInfoBtn').on('click', function(e) {
        e.preventDefault();


        console.log(quizReferenceData);
    let loopCounter = 0; // Initialize loop counter outside the loop

    for (let i = 0; i < quizReferenceData.length; i++) {
        const quiz_reference_id = quizReferenceData[i]['quiz_reference_id'];
        const quiz_id = quizReferenceData[i]['quiz_id'];
        const course_id = quizReferenceData[i]['course_id'];
        const syllabus_id = quizReferenceData[i]['syllabus_id'];

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var baseUrl = window.location.href;

        var data = {
            quiz_id: quiz_id,
            course_id: course_id,
            syllabus_id: parseInt(syllabus_id, 10),
        };

        if (loopCounter === 0) {
            var url = baseUrl + "/" + quiz_id + "/update";

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    // Handle success if needed
                    if(quizReferenceData.length === loopCounter++) {
                        window.location.reload();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
            loopCounter++;
        } else {
            var url = baseUrl + "/" + quiz_id + "/add";
          
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    // Handle success if needed
                     
                    if(quizReferenceData.length === loopCounter++) {
                        window.location.reload();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
            loopCounter++;
        }
    }

        // alert('test')
        $('#editQuizInfoBtn').removeClass('hidden');
        $('#editQuizInfo_clickedBtns').addClass('hidden');
        
        $('.editReferenceBtn').addClass('hidden');
        $('#addNewReference').addClass('hidden');

        
        // $('#saveQuizInfoBtn').removeClass('hidden');

        isEditing = 0;

        // add ajax to save everything
     })

     $('#addNewReference').addClass('hidden');
    //adding new reference
    $('#addNewReference').on('click', function(e) {
        e.preventDefault();
        var syllabusDataDisp = ``;

        // $('#addNewReference_clickedBtns').removeClass('hidden');
        $('#addNewReference').addClass('hidden');

        var newRow = $('<tr>');

        
        syllabusDataDisp += `
        <select class="w-4/5 m-5 h-14 referenceRow" name="" id="">`;

        for (let x = 0; x < syllabusData.length; x++) {
            var x_syllabus_id = syllabusData[x]['syllabus_id'];
            // var x_topic_id = syllabusData[x]['topic_id'];
            var x_topic_title = syllabusData[x]['topic_title'];
            // var category = syllabusData[x]['category'];

            var course_id = syllabusData[x]['course_id'];
            

            syllabusDataDisp += `
            <option data-syllabus-id="${x_syllabus_id}" value="${x_topic_title}">${x_topic_title}</option>
            `;
        }
        
        syllabusDataDisp += `
        </select>
        `;

        newRow.append($('<td>').append(syllabusDataDisp));


        var saveBtn = $('<button class="px-3 py-1 mx-2 font-semibold text-white bg-green-600 rounded-xl saveReferenceBtn hover:bg-green-900">Save</button>')
        var deleteBtn = $('<button class="px-3 py-1 mx-2 font-semibold text-white bg-red-600 rounded-xl cancelReferenceBtn hover:bg-red-900">Cancel</button>')

        newRow.append($('<td>').append(saveBtn).append(deleteBtn));

        $('.referenceTable').append(newRow);

        saveBtn.on('click', function() {
            const referenceTitle = $(this).closest('tr').find('.referenceRow').val();
            const syllabusID = $(this).closest('tr').find('.referenceRow option:selected').data('syllabus-id');
   
            if(referenceTitle !== null && referenceTitle !== '' && referenceTitle !== null && referenceTitle !== '') {
// Handle saving the criteria and score to your array (activityCriteriaData)
            // You can use $(this) to access the specific Save button clicked
            // Add your code to save the data in the array
            temp_id = 'none';
            const reference = {
                quiz_reference_id: temp_id,
                quiz_id: quizInfoData['quiz_id'],
                course_id: course_id,
                syllabus_id: syllabusID,
                topic_title: referenceTitle,
            }

            console.log(reference)

            quizReferenceData.push(reference);
            displayReference(quizReferenceData, syllabusData)
            $('#addNewReference').removeClass('hidden');
            }
        });

        deleteBtn.on('click', function() {
            // Handle deleting the new row if needed
            newRow.remove();
            
            $('.editCriteria_clickedBtn').removeClass('hidden');
            $('#addNewReference').removeClass('hidden');
        });
    })

    // $('#saveAddNewReferenceBtn').on('click', function(e) {
    //     // add to the array
    // })

    // $('#cancelAddNewReferenceBtn').on('click', function(e) {
    //     e.preventDefault();

    //     $('#addNewReference_clickedBtns').addClass('hidden');
    //     $('#addNewReference').removeClass('hidden');
    // })



    // view responses
    $('#viewResponsesBtn').on('click', function(e) {

    })
})