$(document).ready(function() {
    var lessonData = {};
    // console.log(lessonData)
    // Select all <p> elements with the class .lesson_content_input_disp
    var pElements = $('.lesson_content_input_disp');
    var iElements = $('.lesson_content_input');
        
    // Use the filter function to select only those with newline characters
    var pElementsWithNewlines = pElements.filter(function() {
        return $(this).text().includes('\n');
    });

    var iElementsWithNewlines = iElements.filter(function() {
        return $(this).text().includes('\n');
    });
    
    // Apply white-space: pre to the selected elements
    pElementsWithNewlines.css('white-space', 'pre');
    iElementsWithNewlines.css('white-space', 'pre');
    // overall edit button
    $('#editLessonBtn').on('click', function(e) {
        e.preventDefault();
        $('#editBtns').removeClass('hidden');
        $('#editLessonBtn').addClass('hidden');

        $('#edit_lesson_title').removeClass('hidden');

        $('.edit_lesson_content').removeClass('hidden');

        $('#lessonAddContent').removeClass('hidden');


        const courseID = $(this).data('course-id');
        const syllabusID = $(this).data('syllabus-id');
        const topicID = $(this).data('topic_id');

        var url = "/instructor/course/content/"+ courseID +"/"+ syllabusID +"/lesson/"+ topicID +"/json";

        console.log(url)

        $.ajax ({
            type: "GET",
            url: "/instructor/course/content/"+ courseID +"/"+ syllabusID +"/lesson/"+ topicID +"/json",
            dataType: 'json',
            success: function (response){
                // console.log(response)
                lessonData = response['lessonContent']
                // console.log(lessonData)
                reDisplayLesson(lessonData);
            },
            error: function(error) {
                console.log(error);
            }
      })
    });

    function reDisplayLesson(lessonData) {
        var displayLesson = ``;

        for (let i = 0; i < lessonData.length; i++) {
            
            lessonData[i]['lesson_content_order'] = i + 1;

            const lesson_content_id = lessonData[i]['lesson_content_id'];
            const lesson_id = lessonData[i]['lesson_id'];
            const lesson_content_title = lessonData[i]['lesson_content_title'];
            const lesson_content = lessonData[i]['lesson_content'];
            const lesson_content_order = lessonData[i]['lesson_content_order'];
            const picture = lessonData[i]['picture'];
            

            displayLesson += `
                <div data-content-order="${lesson_content_order}" class="px-10 lesson_content_area my-2 mb-8 w-full">
                    <button class="edit_lesson_content hidden">
                        <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg>
                    </button>
                    
                    <input type="text" class="lesson_content_title_input text-2xl font-bold border-none w-10/12" disabled name="lesson_content_title_input" id="" value="${lesson_content_title}">
                    
                    <p class="lesson_content_input_disp text-xl w-full min-w-full max-w-full" style="white-space: pre;">${lesson_content}</p>
                    <textarea name="lesson_content_input" id="" class="hidden text-xl lesson_content_input w-full min-w-full max-w-full h-32" style="white-space: ${lesson_content.includes('\n') ? 'pre' : 'normal'};" disabled>${lesson_content}</textarea>

                    ${picture !== null ? `
                    <div id="lesson_content_img" class="flex justify-center w-full h-[400px] my-4 rounded-lg shadow">
                        <div class="w-full h-[400px] overflow-hidden rounded-lg">
                            <img src="{{ asset("storage/${picture}") }}" class="object-contain w-full h-full" alt="">
                        </div>
                    </div>
                    
                    
                    <div id="edit_lesson_content_picture_btns" style="position: relative; top: 75%;" class="hidden flex justify-end">
                        <button id="" data-lesson-id="{{$lessonInfo->lesson_id}}" data-course-id="{{$lessonInfo->course_id}}" data-topic_id="{{$lessonInfo->topic_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" class=" add_lesson_content_picture_btn mr-3 flex text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                            Change Photo
                        </button>
                    </div>
                    ` 
                        
                    : `
                    <div id="edit_lesson_content_picture_btns" style="position: relative; top: 75%;" class="hidden flex justify-end">
                        <button id="" data-lesson-id="{{$lessonInfo->lesson_id}}" data-course-id="{{$lessonInfo->course_id}}" data-topic_id="{{$lessonInfo->topic_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" class=" add_lesson_content_picture_btn mr-3 flex text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                            Add Photo
                        </button>
                    </div>
                    `}
                    
                    <div class="edit_lesson_content_btns hidden flex w-full justify-end">
                        <button data-content-order="${lesson_content_order}" data-lesson-id="${lesson_id}" data-lesson-content-id="${lesson_content_id}" id="" class="save_lesson_content_btn mx-1 text-white rounded-xl py-3 px-5 bg-green-600 hover:bg-green-900" >
                            Save
                        </button>
                        <button data-content-order="${lesson_content_order}" data-lesson-id="${lesson_id}" data-lesson-content-id="${lesson_content_id}" id="" class="delete_lesson_content_btn mx-1 text-white rounded-xl py-3 px-5 bg-red-600 hover:bg-red-800">
                            Delete
                        </button>
                        <button id="" class="cancel_lesson_content_btn mx-1 text-white rounded-xl py-3 px-5 bg-red-600 hover:bg-red-900" >
                            Cancel
                        </button>
                    </div>
                </div>
            `;
        }
            $('#main_content_area').empty();
            $('#main_content_area').append(displayLesson);

            $('#editBtns').removeClass('hidden');
            $('#editLessonBtn').addClass('hidden');

            $('#edit_lesson_title').removeClass('hidden');

            $('.edit_lesson_content').removeClass('hidden');

            $('#lessonAddContent').removeClass('hidden');

            $('#edit_lesson_content_picture_btns').removeClass('hidden');
        console.log(lessonData)


        // var pElement = $('.lesson_content_input_disp');

        // // Check if the content contains newline characters
        // if (pElement.text().includes('\n')) {
        //     pElement.css('white-space', 'pre');
        // }

        // edit existing lesson content
    $('.edit_lesson_content').on('click', function(e) {
        e.preventDefault();
        const lesson_content_area = $(this).closest('.lesson_content_area')
        const lesson_content_title = lesson_content_area.find('.lesson_content_title_input');
        const lesson_content = lesson_content_area.find('.lesson_content_input');
        const lesson_content_disp = lesson_content_area.find('.lesson_content_input_disp');

        lesson_content_disp.addClass('hidden');
        lesson_content.removeClass('hidden');
        lesson_content_title.prop('disabled', false).focus;
        lesson_content.prop('disabled', false);

        lesson_content_area.find('.edit_lesson_content_btns').removeClass('hidden');
        lesson_content_area.find('.edit_lesson_content').addClass('hidden');
    })

    $('.cancel_lesson_content_btn').on('click', function(e) {
        e.preventDefault();
        const lesson_content_area = $(this).closest('.lesson_content_area')
        const lesson_content_title = lesson_content_area.find('.lesson_content_title_input');
        const lesson_content = lesson_content_area.find('.lesson_content_input');

        lesson_content_title.prop('disabled', true);
        lesson_content.prop('disabled', true);

        lesson_content_area.find('.edit_lesson_content_btns').addClass('hidden');
        lesson_content_area.find('.edit_lesson_content').removeClass('hidden');
    })

    $('.save_lesson_content_btn').on('click',function(e){
        e.preventDefault();

        const lesson_content_area = $(this).closest('.lesson_content_area')
        const lesson_content_title = lesson_content_area.find('.lesson_content_title_input');
        const lesson_content = lesson_content_area.find('.lesson_content_input');

        const lesson_content_title_val = lesson_content_title.val();
        const lesson_content_val = lesson_content.val();

        const lessonID = $(this).data('lesson-id');
        const lessonContentID = $(this).data('lesson-content-id');

        const updatedValues = {
            'lesson_content_title': lesson_content_title_val,
            'lesson_content': lesson_content_val,
        }


        if(!/^none\d+$/.test(lessonContentID)) {
            const url = "/instructor/course/content/lesson/"+ lessonID +"/title/"+lessonContentID;

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            $.ajax({
                type: "POST",
                url: url,
                data: updatedValues,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    // Handle success if needed
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {
            
        }

        

        lesson_content_title.prop('disabled', true);
        lesson_content.prop('disabled', true);

        lesson_content_area.find('.edit_lesson_content_btns').addClass('hidden');
        lesson_content_area.find('.edit_lesson_content').removeClass('hidden');
    })

    $('.delete_lesson_content_btn').on('click', function(e) {
        e.preventDefault();

        const lessonID = $(this).data('lesson-id');
        const lessonContentID = $(this).data('lesson-content-id');

        $('#confirmDelete').data('lesson-id', lessonID);
        $('#confirmDelete').data('lesson-content-id', lessonContentID);
        $('#deleteLessonContentModal').removeClass('hidden');
    })

    }

    $('#confirmDelete').on('click', function(e) {
        const lessonID = $(this).data('lesson-id');
        const lessonContentID = $(this).data('lesson-content-id');

        const url = "/instructor/course/content/lesson/"+ lessonID +"/title/"+lessonContentID+"/delete";
        

        if(!/^none\d+$/.test(lessonContentID)) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    // Handle success if needed
                    // console.log(response);
                    // $('#deleteLessonContentModal').addClass('hidden');
                    // reDisplayLesson(lessonData)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {

        
    }

  // Find the index of the corresponding syllabusData item
               const index = lessonData.findIndex(item => item.lesson_content_id === lessonContentID);
        
               if (index !== -1) {
                   // Remove the item from the syllabusData array
                   lessonData.splice(index, 1);
               }
      
               $('#deleteLessonContentModal').addClass('hidden');
               reDisplayLesson(lessonData);

    })

    $('#cancelDelete').on('click', function(e) {
        
        $('#deleteLessonContentModal').addClass('hidden');
    })

    // edit button for the lesson title
    $('#edit_lesson_title').on('click', function(e) {
        e.preventDefault();
        $('#lesson_title').prop('disabled', false).focus();

        $('#edit_lesson_btns').removeClass('hidden');
        $('#edit_lesson_picture_btns').removeClass('hidden');

        $('#edit_lesson_title').addClass('hidden');
    })

    $('#cancel_lesson_btn').on('click', function(e) {
        e.preventDefault();
        $('#lesson_title').prop('disabled', true);

        $('#edit_lesson_btns').addClass('hidden');
        $('#edit_lesson_picture_btns').addClass('hidden');
    
        $('#edit_lesson_title').removeClass('hidden');
    })

    // save changes in the lesson title
    $('#save_lesson_btn').on('click', function(e) {
        e.preventDefault();
        // save changes in lesson title
        const updatedLessonTitle = $('#lesson_title').val();

        var syllabusID = $(this).data('syllabus-id');
        var lessonID = $(this).data('lesson-id');

        
        var courseID = $(this).data('course-id');
        var syllabusID = $(this).data('syllabus-id');
        var topicID = $(this).data('topic_id');

        var url = "/instructor/course/content/"+ courseID +"/"+ syllabusID +"/lesson/"+ topicID +"/title/"+ lessonID;

        var updated_value = {
            'lesson_title': updatedLessonTitle,
            'topic_title': updatedLessonTitle,
        }

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: url,
            data: updated_value,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Handle success if needed
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    })

    

    // to add new content
    $('#lessonAddContent').on('click', function(e) {
        e.preventDefault();

        $('#addLessonContentModal').removeClass('hidden');
    })

    $('#cancelAddLessonContentBtn').on('click', function(e) {
        e.preventDefault();

        $('#addLessonContentModal').addClass('hidden');
    })

    $('#closeAddLessonContentModal').on('click', function(e) {
        e.preventDefault();

        $('#addLessonContentModal').addClass('hidden');
    })

    var none_count = 0;
    $('#confirmAddLessonContentBtn').on('click', function(e) {

        const chosenLocation = $('#insertLocation').val();
        const lessonContentTitle = $('#insertLessonContentTitle').val();
        const lessonContent = $('#insertLessonContent').val();

        const lessonID = $(this).data('lesson-id');

        const newLessonContent = {
            lesson_content_id: 'none' + none_count++,
            lesson_id: lessonID,
            lesson_content_title: lessonContentTitle,
            lesson_content: lessonContent,
        }

        if(lessonData.length > 0) {
            if(chosenLocation == 'START') {
                lessonData.unshift(newLessonContent);
            } else if(chosenLocation == 'END') {
                lessonData.push(newLessonContent);
            } else {
                const insertIndex = lessonData.findIndex(topic => topic.lesson_content_title === chosenLocation);

                // Insert the new topic at the specified index
                if (insertIndex !== -1) {
                    lessonData.splice(insertIndex + 1, 0, newLessonContent);
                } else {
                    // Handle the case where the insertLocation is not found, you may choose to append it at the end.
                    lessonData.push(newLessonContent);
                }
            }
        } else {
            lessonData.push(newLessonContent);
        }

        $('#addLessonContentModal').addClass('hidden');
        reDisplayLesson(lessonData)

    })

    $('#insertLessonContent').keydown(function(event) {
        if (event.key === 'Enter') {
          event.preventDefault(); // Prevent the default behavior (line break)

          var textarea = $(this);
          var start = textarea[0].selectionStart;
          var end = textarea[0].selectionEnd;
          var value = textarea.val();

          // Insert a newline character at the cursor position
          var updatedValue = value.substring(0, start) + '\n' + value.substring(end);

          // Update the textarea's value and cursor position
          textarea.val(updatedValue);
          textarea[0].setSelectionRange(start + 1, start + 1);
        }
      });

      
    $('#cancelEditBtn').on('click', function(e) {
        e.preventDefault();
        $('#editBtns').addClass('hidden');
        $('#editLessonBtn').removeClass('hidden');

        $('#edit_lesson_title').addClass('hidden');

        $('.edit_lesson_content').addClass('hidden');
        $('.edit_lesson_content_btns').addClass('hidden');
        $('.lesson_content_input_disp').removeClass('hidden');
        $('.lesson_content_input').addClass('hidden');
        $('.lesson_content_title_input').attr('disabled', true)
        $('.lesson_content_input').prop('disabled', true)

        $('#lessonAddContent').addClass('hidden');
    });

    // save all
    $('#saveEditBtn').on('click', function(e){
        e.preventDefault();
        // save all data
        const lessonID = $(this).data('lesson-id')
        const courseID = $(this).data('course-id')
        const syllabusID = $(this).data('syllabus-id')
        const topicID = $(this).data('topic_id')

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        // const loopCounter = 0;
        for (let i = 0; i < lessonData.length; i++) {
            // console.log(lessonData[i])
            // loopCounter++;
            const row_lesson_content_data = {
                'lesson_content_id': lessonData[i]['lesson_content_id'],
                'lesson_id': lessonData[i]['lesson_id'],
                'lesson_content_title': lessonData[i]['lesson_content_title'],
                'lesson_content': lessonData[i]['lesson_content'],
                'lesson_content_order': lessonData[i]['lesson_content_order'],
            }

            if (!/^none\d+$/.test(row_lesson_content_data['lesson_content_id'])) {
                // AJAX for updating the values

                const url = "/instructor/course/content/"+courseID+"/"+syllabusID+"/lesson/"+topicID+"/title/"+ lessonID +"/save"
                // console.log(url)

                $.ajax({
                    type: "POST",
                    url: url,
                    data: row_lesson_content_data,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle success if needed
                        if(i + 1 == lessonData.length){
                            if (response && response.redirect_url ) {
                                window.location.href = response.redirect_url;
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
                // AJAX for creating new syllabus
                const url = "/instructor/course/content/"+courseID+"/"+syllabusID+"/lesson/"+topicID+"/title/"+ lessonID +"/save_add";
                row_lesson_content_data['lesson_content_id'] = '';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: row_lesson_content_data,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle success if needed
                        if(i + 1 == lessonData.length){
                            if (response && response.redirect_url ) {
                                window.location.href = response.redirect_url;
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

        }

        // if(loopCounter + 1 == lessonData.length) {
        //     const url = "/instructor/course/content/"+courseID+"/"+syllabusID+"/lesson/"+topicID+"/title/"+ lessonID +"/store_file";

        //         $.ajax({
        //             type: "POST",
        //             url: url,
        //             data: row_lesson_content_data,
        //             headers: {
        //                 'X-CSRF-TOKEN': csrfToken
        //             },
        //             success: function(response) {
        //                 // Handle success if needed
        //                 if(i + 1 == lessonData.length){
        //                     if (response && response.redirect_url ) {
        //                         window.location.href = response.redirect_url;
        //                     }
        //                 }
        //             },
        //             error: function(error) {
        //                 console.log(error);
        //             }
        //         });
        // }


    })


    $('.add_lesson_picture_btn').on('click', function(e) {
        e.preventDefault();

        $('#pictureModal').removeClass('hidden');
    })

    $('#closeModal').on('click', function(e) {
        e.preventDefault();

        $('#pictureModal').addClass('hidden');
    })

    $('#cancelUpload').on('click', function(e) {
        e.preventDefault();

        $('#pictureModal').addClass('hidden');
    })

    $('#pictureUploadForm').on('submit', function(e){
        e.preventDefault();

        const courseID = $(this).data('course-id');
        const syllabusID = $(this).data('syllabus-id');
        const topicID = $(this).data('topic_id');
        const lessonID = $(this).data('lesson-id');

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var formData = new FormData(this);
        const url = "/instructor/course/content/"+ courseID +"/"+ syllabusID +"/lesson/"+ topicID +"/title/"+ lessonID +"/picture"

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            contentType: false,
            processData: false,
            success: function(response) {
                // alert('Upload successful!');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    })
});