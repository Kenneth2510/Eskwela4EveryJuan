@include('partials.header')

<section id="sidebarfull" class="fixed h-full w-72 bg-seagreen top-0 z-20 left-0">
    <div id="sidebarfull_menu" class="relative flex items-center px-2 mx-auto py-3">
        <button class="">
            <i class="fa-solid fa-bars text-3xl" style="color: #ffffff;"></i>
        </button>
        <h1 class="text-2xl font-semibold pl-2 text-black">Eskwela4EveryJuan</h1>
    </div>

    <div id="sidebar" class="relative mx-auto w-56">
        <ul class="my-28 mx-auto list-none list-inside">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group ">
                <a href="/admin/dashboard">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="fa-solid fa-house text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Dashboard</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group selected">
                <a href="/admin/learners">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="fa-solid fa-user text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Learners</h3>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="instructors">
                    <i class="fa-solid fa-user-graduate text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Instructors</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="courses">
                    <i class="fa-solid fa-book text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Courses</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="performance">
                    <i class="fa-solid fa-chart-simple text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Performance</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="settings">
                    <i class="fa-solid fa-gear text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Settings</h3>
                </div>
            </a></li>

        </ul>  
    </div>

    <div id="logout" class="relative mx-auto w-56 flex justify-center">
        <a href="" class="py-5 bg-darthmouthgreen mx-auto px-14 rounded-2xl text-white text-xl font-medium hover:bg-green-900">Logout</a>
    </div>
</section>

<section id="maincontent" class="relative w-4/5 h-full left-80">
    <div id="title" class="relative flex justify-between my-3 mx-auto px-3 py-auto items-center h-16">
        <h1 class="text-4xl font-semibold">Learner Management</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">admin</h3>
            <div id="icon" class="mx-3 h-10 w-10 bg-slate-400 rounded-full"></div>
        </div>
    </div>
    <div id="maincontainer" class="relative mt-7 rounded-2xl shadow-2xl px-5 py-5 max-h-full">
        <div id="containertitle" class="flex justify-between items-center px-auto pt-1 pb-5">
            <h3 class="text-3xl font-semibold">All Learners</h3>
            <div class="">
                <a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">Add New</a>
                <select name="" id="" class="w-40 text-lg px-2 py-2 rounded-xl border-2 border-black">
                    <option value="" class=""></option>
                    <option value="id">Learner ID</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="contactno">Contact No.</option>
                    <option value="businessname">Business Name</option>
                    <option value="dateRegistered">Date Registered</option>
                    <option value="status">Status</option>
                </select>
                <input type="text" class="w-80 text-lg px-2 py-2 rounded-xl border-2 border-black ml-3" placeholder="Type to search">
            </div>
        </div>

        <div id="contenttable" class="mt-7">
          <table class="">
            <thead class="border-b-2 border-black">
                <th class="w-1/12 text-left text-xl">Learner ID</th>
                <th class="w-2/12 text-left text-xl">Name</th>
                <th class="w-3/12 text-left text-xl">Contact Info</th>
                <th class="w-3/12 text-left text-xl">Business Name</th>
                <th class="w-2/12 text-left text-xl">Date Registered</th>
                <th class="w-1/12 text-left text-xl">Status</th>
                <th class="w-1/12"></th>
            </thead>
            <tbody class="">
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                <tr class="">
                    <td class="w-1/12 py-1 text-lg font-normal">20230821001</td>
                    <td class="w-2/12 py-1 text-lg font-normal">Juan Dela Cruz</td>
                    <td class="w-3/12 py-1 text-lg font-normal">juandelacruz@email.com<br>09573845637</td>
                    <td class="w-3/12 py-1 text-lg font-normal">Happy Chicken Feet</td>
                    <td class="w-1/12 py-1 text-lg font-normal">2023-08-21</td>
                    <td class="w-2/12 py-1 text-lg font-normal">active</td>
                    <td class="w-1/12"><a href="" class="text-lg font-medium px-3 py-2 bg-green-600 rounded-xl mx-3 hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                
                
            </tbody>
          </table>
        </div>
    </div>

@include('partials.footer')