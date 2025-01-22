// resources/js/components/FacebookAnalytics.js

const getFacebookPosts = async (pageId) => {
    try {
        const response = await axios.get(
            `/api/facebook/posts?page_id=${pageId}`
        );
        return response.data;
    } catch (error) {
        console.error("Error fetching Facebook posts:", error);
        throw error;
    }
};

// If you're using Vue.js
export default {
    data() {
        return {
            pageId: "",
            posts: [],
            loading: false,
            error: null,
        };
    },
    methods: {
        async searchFacebookPage() {
            this.loading = true;
            this.error = null;
            try {
                const result = await getFacebookPosts(this.pageId);
                this.posts = result.data;
            } catch (error) {
                this.error = "Failed to fetch Facebook posts";
            } finally {
                this.loading = false;
            }
        },
    },
};
