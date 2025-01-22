<!-- resources/views/facebook-analytics.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Facebook Analytics</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Include your CSS here -->
</head>
<body>
    <div id="app">
        <div class="container">
            <h1>Facebook Analytics Dashboard</h1>
            
            <div class="search-section">
                <input 
                    type="text" 
                    id="pageId" 
                    placeholder="Enter Facebook Page ID"
                >
                <button onclick="searchPage()">Search</button>
            </div>

            <div id="loading" style="display: none;">
                Loading...
            </div>

            <div id="error" style="display: none; color: red;">
            </div>

            <div id="results">
                <!-- Results will be displayed here -->
            </div>
        </div>
    </div>

    <script>
        // Setup axios CSRF token for Laravel
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        const token = document.querySelector('meta[name="csrf-token"]').content;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

        async function getFacebookPosts(pageId) {
            try {
                const response = await axios.get(`/api/facebook/posts?page_id=${pageId}`);
                return response.data;
            } catch (error) {
                console.error('Error fetching Facebook posts:', error);
                throw error;
            }
        }

        async function searchPage() {
            const pageId = document.getElementById('pageId').value;
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');
            const results = document.getElementById('results');

            // Show loading state
            loading.style.display = 'block';
            error.style.display = 'none';
            results.innerHTML = '';

            try {
                const data = await getFacebookPosts(pageId);
                
                // Display results
                results.innerHTML = data.data.map(post => `
                    <div class="post">
                        <p><strong>Message:</strong> ${post.message}</p>
                        <p><strong>Created:</strong> ${new Date(post.created_at).toLocaleDateString()}</p>
                        <p>
                            <span>👍 ${post.likes_count}</span>
                            <span>💬 ${post.comments_count}</span>
                            <span>🔄 ${post.shares_count}</span>
                        </p>
                    </div>
                `).join('');

            } catch (err) {
                error.style.display = 'block';
                error.textContent = 'Failed to fetch Facebook posts';
            } finally {
                loading.style.display = 'none';
            }
        }
    </script>

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .search-section {
            margin: 20px 0;
        }

        .search-section input {
            padding: 8px;
            margin-right: 10px;
            width: 200px;
        }

        .search-section button {
            padding: 8px 16px;
        }

        .post {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
        }

        #loading {
            text-align: center;
            padding: 20px;
        }

        #error {
            background-color: #ffebee;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
        }
    </style>
</body>
</html>