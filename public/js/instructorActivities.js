$(document).ready(() => {
    $("#viewResponseActivity").on("click", (e) => {
        e.preventDefault();

        $("#selectTypeParent").removeClass("hidden");
    });

    $("#closeAct").on("click", () => {
        $("#selectTypeParent").addClass("hidden");
    });

    let isAppended = false;

    function appendStudentsList() {
        console.log(isAppended);
        if (!isAppended) {
            const studentsList = $(
                `<button class="flex flex-row items-center" id="backToDefault">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                        <p>Go back</p>
                    </button>
                    <h1 class="mt-4 mb-2 text-xl font-medium">Already Answered:</h1>
                            <table class="w-full text-center table-fixed">
                               <thead>
                                   <tr>
                                       <th>Name</th>
                                       <th>Score</th>
                                       <th>Status</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <td>Kenneth</td>
                                       <td>10/10</td>
                                       <td>Already Answered</td>
                                       <td class="float-right"></td>
                                   </tr>
                                   <tr>
                                       <td>Raven</td>
                                       <td>-</td>
                                       <td>Not yet Answered</td>
                                       <td class="float-right"></td>
                                   </tr>
                                   <tr>
                                       <td>Kenneth</td>
                                       <td>10/10</td>
                                       <td>Already Answered</td>
                                       <td class="float-right"></td>
                                   </tr>
                                   <tr>
                                       <td>Kenneth</td>
                                       <td>10/10</td>
                                       <td>Already Answered</td>
                                       <td class="float-right"></td>
                                   </tr>
                               </tbody>
                           </table>`,
            );
            studentsList
                .find('td[class="float-right"]')
                .html(
                    '<button class="flex flex-row items-center justify-center p-4 m-2 rounded-lg shadow-lg bg-amber-400 hover:bg-amber-500 md:h-12 py-2" type="button" id=""><h1>visit</h1></button>',
                );

            $("#studentsList").append(studentsList);

            isAppended = true;

            $(document).on("click", "#backToDefault", () => {
                $("#defaultView").removeClass("hidden");
                studentsList.remove();
                isAppended = false;
            });
        }
    }

    $("#viewStudents").on("click", () => {
        appendStudentsList();
        $("#defaultView").addClass("hidden");
        $("#selectTypeParent").addClass("hidden");
    });

    $("#emptyActivity").on("click", function () {
        const btn = $(this).find("#addInstructions"); // `this` will correctly refer to the clicked button element
        console.log(btn);

        const btnName = btn.text();
        console.log(`button name: ${btnName}`);
    });

    window.handleModal();
});
