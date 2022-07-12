<template>
  <div class="container">
    <h2 class="mt-5">Posts</h2>
    <div class="row row-cols-3">
      <div v-for="post in posts" :key="post.id" class="col">
        <div class="card p-2 mb-3">
          <h4>{{post.title}}</h4>
          <p>{{troncateText(post.content, 50)}}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Posts',
  data() {
    return {
      posts: [],
      currentPage: 1,
      lastPage: 0,
      totalPosts: 0
    }
  },

  created() {
    this.getPosts()
  },

  methods: {
    getPosts(pageNumber) {
      axios.get("/api/posts", {
        params: {
          page: pageNumber
        }
      }).then((resp) => {
        this.posts = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results;
        this.totalPosts = resp.data.results.total
      });
     
    },

    troncateText(text, maxCharNumber) {
      if (text.length > maxCharNumber) {
        return text.substr(0, maxCharNumber) + '...';
      }
      return text;
    }
  }
}
</script>

<style>

</style>