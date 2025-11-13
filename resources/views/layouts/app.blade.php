<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SJITC</title>

    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#121217', 
                        'card-dark': '#1E1E28',    
                        'accent-purple': '#7D4FFF',
                        'accent-orange': '#FFA726',
                        'border-dark': '#3A3A4A',  
                    }
                }
            }
        }
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
     
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-dark);
            color: white;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 50;
            }
            .content-area {
                margin-left: 0;
            }
        }
        
      
        .sidebar.active {
            transform: translateX(0);
        }
    </style>
</head>
<body>
    
    
    <div class="flex h-screen bg-primary-dark">

        
        <aside class="sidebar fixed top-0 left-0 h-full w-64 bg-card-dark border-r border-border-dark shadow-xl transition-transform duration-300 ease-in-out lg:translate-x-0">
            
            
            <div class="p-6 border-b border-border-dark mb-6">
                <h1 class="text-2xl font-bold text-accent-orange">SJITC <span class="text-gray-400 font-medium text-sm block">Management System</span></h1>
            </div>

            
            <nav class="flex flex-col space-y-3 px-4">
                
                
                <a href="{{ route('dashboard') }}" class="group flex flex-col p-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-accent-orange transition duration-150 ease-in-out">
                    <span class="font-semibold text-lg">Dashboard</span>
                    <span class="text-xs text-gray-500 group-hover:text-gray-400 transition">System overview and key metrics.</span>
                </a>

                
                <a href="{{ route('trainees.index') }}" class="group flex flex-col p-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-accent-orange transition duration-150 ease-in-out">
                    <span class="font-semibold text-lg">Trainee Records</span>
                    <span class="text-xs text-gray-500 group-hover:text-gray-400 transition">Manage all active and archived trainees.</span>
                </a>

                
                <a href="{{ route('parents.index') }}" class="group flex flex-col p-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-accent-orange transition duration-150 ease-in-out">
                    <span class="font-semibold text-lg">Parent Contacts</span>
                    <span class="text-xs text-gray-500 group-hover:text-gray-400 transition">View and update guardian information.</span>
                </a>

                
                <a href="{{ route('trades.index') }}" class="group flex flex-col p-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-accent-orange transition duration-150 ease-in-out">
                    <span class="font-semibold text-lg">Trades & Courses</span>
                    <span class="text-xs text-gray-500 group-hover:text-gray-400 transition">Define and manage training trade types.</span>
                </a>
                
                
                <a href="{{ route('trainees.report') }}" class="group flex flex-col p-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-accent-orange transition duration-150 ease-in-out">
                    <span class="font-semibold text-lg">Reports & Exports</span>
                    <span class="text-xs text-gray-500 group-hover:text-gray-400 transition">Generate and download official reports.</span>
                </a>

            </nav>

            
            <div class="absolute bottom-0 w-full p-4 border-t border-border-dark">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2.5 bg-gray-800 text-red-400 border border-red-500/30 rounded-lg font-semibold hover:bg-red-900/40 transition duration-150">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        
        <main class="flex-1 lg:ml-64 p-4 md:p-8 overflow-y-auto content-area transition-all duration-300">
            
            
            <div class="lg:hidden mb-4">
                <button onclick="document.querySelector('.sidebar').classList.toggle('active')" class="p-2 rounded-lg bg-card-dark text-accent-orange border border-border-dark">
                    
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>

            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-900/50 text-green-400 border border-green-600/50">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-900/50 text-red-400 border border-red-600/50">
                    {{ session('error') }}
                </div>
            @endif

            
            <div class="card bg-card-dark p-6 rounded-xl shadow-lg border border-border-dark min-h-[85vh]">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>