{{-- SECURITY CODE --}}
<section class="container h-full bg-pink-800">
    <div class="w-full p-2 mt-16 bg-mainwhitebg text-darthmouthgreen" id="securityForm">
        <div class="relative h-8 text-xl font-semibold tracking-wide text-center">
            <svg class="absolute cursor-pointer" id="backBtn" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            <h1>Security Code</h1>
        </div>

        <div class="flex flex-col items-center justify-center text-lg font-medium">
            <h1 class="text-black">Enter Security Code</h1>
        </div>
        <form action="{{ url('/instructor/authenticate') }}" method="POST">
            @csrf
            <div class="flex flex-col items-center">
                <div class="my-6">
                    <input class="mx-1 h-16 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_1" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}" autofocus>
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_2" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_3" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_4" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_5" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_6" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                </div>
                @error('security_code')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                <button type="submit" class="w-64 h-12 my-4 font-medium tracking-wide text-white rounded bg-seagreen hover:bg-darthmouthgreen focus:bg-darthmouthgreen">Verify</button>
            </div>
        </form>
        {{-- <div class="text-center text-black">
            <h1>We just sent you a verification code</>
            <p class="font-semibold text-darthmouthgreen">Resend Code?</p>
        </div> --}}
    </div>
</section>



    <script>
        // Add event listeners to the input fields
        const inputFields = document.querySelectorAll('input[type="password"]');
        inputFields.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                if (event.target.value !== '' && index < inputFields.length - 1) {
                    inputFields[index + 1].focus();
                }
            });
        });
    </script>