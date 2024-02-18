@include('partials.header')
@include('partials.sidebar')

<section id="maincontent" class="relative w-4/5 h-full mt-10 left-80">
    <div id="title" class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold">Learner Management</h1>
        <div id="adminuser" class="flex items-center space-x-3">
            <h3 class="text-lg">{{ $adminCodeName }}</h3>
            <div id="icon" class="w-10 h-10 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="maincontainer" class="p-8 bg-white shadow-md rounded-xl">
        <div id="containertitle" class="flex items-center justify-between mb-5">
            <h3 class="text-2xl font-semibold">All Learners</h3>
            
            <div class="flex items-center space-x-3">
                <a href="/admin/add_learner" class="px-4 py-2 text-lg font-medium text-white bg-green-600 rounded-xl hover:bg-green-700">Add New</a>
                
                <form action="{{ url('/admin/learners') }}" method="GET" class="flex items-center space-x-3">
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
                            <option value="learner_id">Learner ID</option>
                            <option value="name">Name</option>
                            <option value="learner_email">Email</option>
                            <option value="learner_contactno">Contact No.</option>
                            <option value="business_name">Business Name</option>
                        </select>
                        
                        <input type="text" name="searchVal" class="w-32 px-2 py-1 text-base border border-black rounded-xl" placeholder="Type to search">
                        
                        <button class="px-4 py-2 text-lg font-medium text-white bg-green-600 rounded-xl hover:bg-green-700" type="submit">Search</button>
                    </div>
                </form>
                
           
            </div>
        </div>
        
        

        <div id="contenttable" class="mt-7">
            <table class="w-full border-b border-black">
                <thead>
                    <th class="w-1/12 text-lg">Learner ID</th>
                    <th class="w-2/12 text-lg">Name</th>
                    <th class="w-3/12 text-lg">Contact Info</th>
                    <th class="w-3/12 text-lg">Business Name</th>
                    <th class="w-2/12 text-lg">Date Registered</th>
                    <th class="w-1/12 text-lg">Status</th>
                    <th class="w-1/12"></th>
                </thead>
                <tbody id="AD_learners" class="">
                    @forelse ($learners as $learner)
                        <tr>
                            <td>{{ $learner->learner_id }}</td>
                            <td>{{ $learner->learner_fname }} {{ $learner->learner_lname }}</td>
                            <td class="py-1 text-base">{{ $learner->learner_email }}<br>{{ $learner->learner_contactno }}</td>
                            <td class="py-1 text-base">{{ $learner->business_name }}</td>
                            <td class="py-1 text-base">{{ $learner->created_at }}</td>
                            <td class="py-1 text-base">{{ $learner->status }}</td>
                            <td><a href="/admin/view_learner/{{ $learner->learner_id }}" class="px-4 py-2 text-lg font-medium text-white bg-green-600 rounded-xl hover:bg-green-700">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-1 text-base" colspan="7">No learners found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $learners->links() }}</div>
        </div>
    </div>

    @include('partials.footer')