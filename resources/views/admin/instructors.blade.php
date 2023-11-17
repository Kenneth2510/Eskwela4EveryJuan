@include('partials.header')
@include('partials.sidebar')

<section id="AD002_I_maincontent" class="relative w-4/5 h-full mt-10 left-80">
    <div id="title" class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold">Instructor Management</h1>
        <div id="adminuser" class="flex items-center space-x-3">
            <h3 class="text-lg">{{ $adminCodeName }}</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>
    <div id="AD002_I_maincontainer" class="p-8 bg-white shadow-md rounded-xl">
        <div id="containertitle" class="flex items-center justify-between mb-5">
            <h3 class="text-2xl font-semibold">All Instructors</h3>
            <div class="flex items-center space-x-3">
                <a href="{{ url('/admin/add_instructor') }}" class="px-4 py-2 text-lg font-medium text-white bg-green-600 rounded-xl hover:bg-green-700">Add New</a>
                <form action="{{ url('/admin/instructors') }}" method="GET" class="flex items-center space-x-3">
                    <label for="filterDate" class="text-lg">Filter by Date</label>
                    <input type="date" name="filterDate" class="w-40 px-2 py-1 text-base border border-black rounded-xl">
        
                    <label for="filterStatus" class="text-lg">Filter by Status</label>
                    <select name="filterStatus" id="filterStatus" class="w-32 px-2 py-1 text-base border border-black rounded-xl">
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
        
                    <button class="px-4 py-2 text-lg font-medium text-white bg-green-600 rounded-xl hover:bg-green-700" type="submit">Filter</button>
        
                    <div class="flex items-center space-x-3">
                        <select name="searchBy" class="w-32 px-2 py-1 text-base border border-black rounded-xl">
                            <option value="">Search By</option>
                            <option value="instructor_id">Instructor ID</option>
                            <option value="name">Name</option>
                            <option value="instructor_email">Email</option>
                            <option value="instructor_contactno">Contact No.</option>
                        </select>
        
                        <input type="text" name="searchVal" class="w-32 px-2 py-1 text-base border border-black rounded-xl" placeholder="Type to search">
        
                        <button class="px-4 py-2 text-lg font-medium text-white bg-green-600 rounded-xl hover:bg-green-700" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        

        <div id="AD002_I_contenttable" class="mt-7">
          <table class="">
            <thead class="border-b-2 border-black">
                <th class="w-2/12 text-xl text-left">Instructor ID</th>
                <th class="w-3/12 text-xl text-left">Name</th>
                <th class="w-3/12 text-xl text-left">Contact Info</th>
                <th class="w-2/12 text-xl text-left">Date Registered</th>
                <th class="w-1/12 text-xl text-left">Status</th>
                <th class="w-1/12"></th>
            </thead>
            <tbody class="">
                @forelse ($instructors as $instructor)
                <tr class="">
                    <td class="w-2/12 py-1 text-lg font-normal">{{ $instructor->instructor_id }}</td>
                    <td class="w-3/12 py-1 text-lg font-normal">{{ $instructor->instructor_fname }} {{ $instructor->instructor_lname }}</td>
                    <td class="w-3/12 py-1 text-lg font-normal">{{ $instructor->instructor_email }}<br>{{$instructor->instructor_contactno}}</td>
                    <td class="w-1/12 py-1 text-lg font-normal">{{ $instructor->created_at }}</td>
                    <td class="w-2/12 py-1 text-lg font-normal">{{ $instructor->status }}</td>
                    <td class="w-1/12"><a href="/admin/view_instructor/{{ $instructor->instructor_id }}" class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                @empty
                <tr>
                    <td class="py-1 text-lg font-normal" colspan="7">No learners found.</td>
                </tr>
                @endforelse
            </tbody>
          </table>
        <div class="">{{$instructors->links()}}</div>
        </div>
    </div>

@include('partials.footer')