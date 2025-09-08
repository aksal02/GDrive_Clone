<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="space-y-12">
    <section>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div x-data="{ sortDirection: '{{ request('sort_direction', 'asc') }}' }" class="flex items-center space-x-3 text-sm ml-auto">
                <a :href="'{{ url()->current() }}?sort_direction=' + (sortDirection === 'asc' ? 'desc' : 'asc') + '&modified={{ request('modified') }}&search={{ request('search') }}'" 
                   class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                    <span>Name</span>
                    <span x-show="sortDirection === 'asc'" class="material-symbols-outlined ml-1 text-base">arrow_upward</span>
                    <span x-show="sortDirection === 'desc'" class="material-symbols-outlined ml-1 text-base">arrow_downward</span>
                </a>
                <form method="GET" action="{{ route('file.index') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="sort_direction" value="{{ request('sort_direction', 'asc') }}">
                    <select name="modified" onchange="this.form.submit()" class="border-gray-300 rounded-lg focus:ring-2 focus:ring-bri-blue focus:border-bri-blue text-sm transition">
                        <option value="">Modified</option>
                        <option value="today" @selected(request('modified') == 'today')>Today</option>
                        <option value="week" @selected(request('modified') == 'week')>Last 7 days</option>
                        <option value="month" @selected(request('modified') == 'month')>This month</option>
                    </select>
                </form>
            </div>
        </div>

        @include('partials.file-list', ['items' => $items])
    </section>
</div>