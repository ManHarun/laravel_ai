<x-dashboardmain>
    <div class="p-4 sm:ml-64">
        <div class="p-4 dark:border-gray-700 mt-14">
            <div class="flex items-center justify-center h-48 mb-4 rounded gap-3 bg-gray-50 dark:bg-gray-800">
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Welcom back</h1>
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-blue-600">{{ auth()->user()->name }}</h1>
                
            </div>
        </div>
    </div>

</x-dashboardmain>