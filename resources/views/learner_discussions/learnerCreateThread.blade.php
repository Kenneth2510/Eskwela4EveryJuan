@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.learnerSidebar')

            {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <a href="{{ url("/instructor/discussions") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="mx-5 text-2xl font-semibold md:text-3xl">DISCUSSION FORUMS</h1>
            <h1 class="mx-5 mt-5 text-2xl font-semibold md:text-2xl">Create a Discussion</h1>
            <hr class="my-6 border-t-2 border-gray-300">
            
            <div class="w-full px-40 pt-5 my-3" id="mainContainer">
                <div class="w-3/5" id="selectCommunityArea">
                    <label for="">Choose a group to post:</label>
                    <select name="" class="w-full px-3 py-3 text-lg border-2 border-darthmouthgreen rounded-xl" id="selectCommunity">
                        <option value="0" selected>All</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full p-5 mt-5 border-2 rounded-lg border-darthmouthgreen border-opacity-60" id="threadContentArea">
                    <div class="flex w-full" id="threadContentCategoryArea">
                        <button class="w-1/3 py-3 text-lg text-white px3 bg-darthmouthgreen hover:bg-green-950 discussionBtn_selected" id="textCategoryBtn">Post/Text</button>
                        <button class="w-1/3 py-3 text-lg text-white px3 bg-darthmouthgreen hover:bg-green-950" id="photoCategoryBtn">Photo</button>
                        <button class="w-1/3 py-3 text-lg text-white px3 bg-darthmouthgreen hover:bg-green-950" id="urlCategoryBtn">Link</button>
                    </div>

                    <div class="mt-5" id="threadTitleArea" style="display: flex; flex-direction: column;">
                        <label class="px-3 text-lg" for="threadTitle_text" id="threadTitle_lbl">Title</label>
                        <div style="display: flex; position: relative;">
                            <textarea maxlength="300" class="w-full px-3 py-3 mt-1 text-lg border-2 rounded-lg border-darthmouthgreen border-opacity-60" id="threadTitle_text" placeholder="Title" oninput="updateCharacterCount(this)"></textarea>
                            <span id="characterCount" class="px-3 py-2 text-sm text-gray-500" style="position: absolute; bottom: 0; right: 0;">0/300</span>
                        </div>
                    </div>
                    
                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                    <script>
                        function updateCharacterCount(textarea) {
                            const maxLength = 300;
                            const currentLength = $(textarea).val().length;
                            const remainingLength = maxLength - currentLength;
                    
                            if (remainingLength >= 0) {
                                $("#characterCount").text(currentLength + '/' + maxLength);
                            } else {
                                // If the user exceeds the limit, truncate the textarea value
                                $(textarea).val($(textarea).val().substring(0, maxLength));
                            }
                        }
                    </script>


                    <div class="mt-5" id="threadContent">
                        <div class="" id="textContent">
                            <textarea name="" class="p-3 w-full h-[300px] min-h-[300px] border-2 border-darthmouthgreen border-opacity-60 rounded-lg text-lg" id="threadContent_text" placeholder="text"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end w-full mt-5" id="postBtnArea">
                        <button class="px-8 py-5 text-xl text-white bg-darthmouthgreen hover:bg-green-950 rounded-xl" id="postBtn">POST</button>
                    </div>
                </div>

                
            </div>
            


        </div>
    </section>
@include('partials.learnerProfile')
</section>
@include('partials.footer')