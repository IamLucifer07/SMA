<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-800">Search Results for "{{ request('query') }}"</h2>

        <!-- Display Recent Posts Table -->
        <table class="min-w-full mt-6 bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Likes</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comments</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shares</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $post->post_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->likes }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->comments }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->shares }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Charts Section -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-medium text-gray-800">Likes Per Post</h3>
                <canvas id="likesChart"></canvas>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-medium text-gray-800">Comments Per Post</h3>
                <canvas id="commentsChart"></canvas>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-medium text-gray-800">Shares Per Post</h3>
                <canvas id="sharesChart"></canvas>
            </div>
        </div>
    </div>


</x-app-layout>