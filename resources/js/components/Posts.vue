<template>
  <div class="container">
    <h2 class="mt-5">Posts</h2>
    <div class="form-group">
      <label for="items_per_page"></label>
      <select class="form-select" name="" id="items_per_page" v-model='itemsPerPage' @change="getPosts(1)">
        <option value="3">3</option>
        <option value="6">6</option>
        <option value="9">9</option>
      </select>
    </div>
    <div class="row row-cols-3">
      <div v-for="post in posts" :key="post.id" class="col">
        <div class="card p-4 mb-3">
          <h4>{{post.title}}</h4>
          <p>{{troncateText(post.content, 50)}}</p>
        </div>
      </div>
    </div>
    <nav>
      <ul class="pagination">
        <!-- PREVIOUS -->
        <li class="page-item" :class="{disabled: currentPage === 1}">
          <a href="#"
          @click="getPosts(currentPage - 1)"
          class="page-link"
          tabindex="-1">
          Previous</a>
        </li>
        <!-- PAGE NUMBERS -->
        <li v-for="n in lastPage" :key="n"
        class="page-item" :class="{active: currentPage === n}">
          <a href="#"
          class="page-link"
          @click="getPosts(n)">{{n}}</a>
        </li>
        <!-- NEXT -->
        <li class="page-item" :class="{disabled: currentPage === lastPage}">
          <a href="#" 
          class="page-link"
          @click="getPosts(currentPage + 1)">
            Next
          </a>
        </li>
      </ul>
    </nav>
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
      totalPosts: 0,
      itemsPerPage: 6,
    }
  },

  created() {
    this.getPosts()
  },

  methods: {
    getPosts(pageNumber) {
      axios.get("/api/posts", {
        params: {
          page: pageNumber,
          items_per_page: this.itemsPerPage,
        }
      }).then((resp) => {
        this.posts = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results.last_page;
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