$(document).ready(function () {
    function questionType() {
        const selectId = "typeOptions";
        const questionTypeContent = $(
            `<div class="flex flex-col items-center" id="typeOfQuestion">
                <label for="questionType">Type of Question:</label>
                <select class="h-10 px-2 pl-2 my-2 bg-transparent focus:bg-gray-200" name="questionType" id="${selectId}">
                    <option value="">--select type--</option>
                    <option value="ID">Identification</option>
                    <option value="MC">Multiple Choice</option>
                    <option value="EZ">Essay</option>
                </select>
            </div>`,
        );

        return questionTypeContent;
    }

    function identificationQ() {
        const selectId = "typeOptionsID" + new Date().getTime();
        const parentId = "identificationQuestion" + new Date().getTime();
        const questionTypeContent = questionType();
        const identificationContent = $(
            `<form class="flex flex-col w-4/5 p-4 mx-auto my-2 border-2 border-gray-200 rounded lg:w-2/3 lg:flex-row-reverse lg:justify-between" action="" id="${parentId}">
                <div id="identificationContainer">
                    <input class="w-full h-10 pl-2 my-2 mb-5 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" placeholder="Question...">
                    <input class="w-full h-10 pl-2 my-2 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" placeholder="Answer...">
                    <input class="w-full h-10 pl-2 my-2 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" placeholder="Points...">
                </div>
            </form>`,
        );

        questionTypeContent.find("select").attr("id", selectId);
        questionTypeContent.find('option[value="ID"]').attr("selected", true);
        identificationContent
            .find("#identificationContainer")
            .before(questionTypeContent);

        return identificationContent;
    }

    function multipleChoice() {
        const selectId = "typeOptionsMC" + new Date().getTime();
        const parentId = "multiChoiceQuestion" + new Date().getTime();
        const questionTypeContent = questionType();
        const multipleChoiceContent = $(
            `<form class="flex flex-col w-4/5 p-4 mx-auto my-2 border-2 border-gray-200 rounded lg:w-2/3 lg:flex-row-reverse lg:justify-between" action="" id="${parentId}">
                <div id="multipleChoiceContainer">
                    <input class="w-full h-10 pl-2 my-2 mb-5 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" placeholder="Question...">
                
                    <div id="multipleChoice">
                        <input class="w-full h-10 pl-2 my-2 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" value="Option 1">
                        <input class="w-full h-10 pl-2 my-2 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" value="Option 2">
                        <input class="w-full h-10 pl-2 my-2 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" value="Option 3">
                    </div>
                    
                    
                    <div class="flex flex-row items-center mb-5">
                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12Zm10-8a8 8 0 1 0 0 16a8 8 0 0 0 0-16Z"/><path d="M13 7a1 1 0 1 0-2 0v4H7a1 1 0 1 0 0 2h4v4a1 1 0 1 0 2 0v-4h4a1 1 0 1 0 0-2h-4V7Z"/></g></svg>
                        <p>Add new option</p>
                    </div>
                    
                    
                    <select class="w-2/3 h-10" name="" id="">
                        <option value="" selected disabled>Answer Key</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                        <option value="">Option 3</option>
                    </select>

                    <input class="w-full h-10 pl-2 my-2 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" placeholder="Points...">
                </div>
            </form>`,
        );

        questionTypeContent.find("select").attr("id", selectId);
        questionTypeContent.find('option[value="MC"]').attr("selected", true);
        multipleChoiceContent
            .find("#multipleChoiceContainer")
            .before(questionTypeContent);

        return multipleChoiceContent;
    }

    function essay() {
        const selectId = "typeOptionsEZ" + new Date().getTime();
        const parentId = "essayQuestion" + new Date().getTime();
        const questionTypeContent = questionType();
        const essayContent = $(
            `<form class="flex flex-col w-4/5 p-4 mx-auto my-2 border-2 border-gray-200 rounded lg:w-2/3 lg:flex-row-reverse lg:justify-between" action="" id="${parentId}">
                <div id="essayContainer">
                    <input class="w-full h-10 max-w-full pl-2 my-2 mb-5 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" placeholder="Question...">
                    <input class="w-full h-10 pl-2 my-2 bg-transparent border-b-2 border-b-seagreen focus:bg-gray-200" type="text" placeholder="Points...">
                </div>
                    
            </form>`,
        );

        questionTypeContent.find("select").attr("id", selectId);
        questionTypeContent.find('option[value="EZ"]').attr("selected", true);
        essayContent.find("#essayContainer").before(questionTypeContent);

        return essayContent;
    }

    function newQuestionBtn() {
        const newQuestionContent = $(
            `<div class="flex flex-row items-center mx-auto my-2 cursor-pointer w-max" id="addNewQBtn">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12Zm10-8a8 8 0 1 0 0 16a8 8 0 0 0 0-16Z"/><path d="M13 7a1 1 0 1 0-2 0v4H7a1 1 0 1 0 0 2h4v4a1 1 0 1 0 2 0v-4h4a1 1 0 1 0 0-2h-4V7Z"/></g></svg>
                <p>Add new question</p>
            </div>`,
        );

        return newQuestionContent;
    }

    $("#addQuestionBtn").on("click", () => {
        identificationQ().appendTo($("#containersss"));
        $("#addQuestionBtn").hide();
        newQuestionBtn().appendTo("#quizMainContainer");
    });

    $(document).on("click", "#addNewQBtn", function () {
        console.log("HELLO");
        identificationQ().appendTo($("#containersss"));
    });

    $(document).on("change", "#typeOfQuestion", function () {
        const selectedValue = $(this).find("option:selected").val();
        console.log(selectedValue);

        const specificId = $("#containersss").find($(this)).parent();
        console.log(specificId);

        // $("#containersss").empty();

        if (selectedValue == "ID") {
            specificId.remove();
            identificationQ().appendTo($("#containersss"));
        } else if (selectedValue == "MC") {
            specificId.remove();
            multipleChoice().appendTo($("#containersss"));
        } else if (selectedValue == "EZ") {
            specificId.remove();
            essay().appendTo($("#containersss"));
        } else {
            $("#addNewQBtn").remove();
            $("#addQuestionBtn").show();
            specificId.remove();
        }
    });
});
