<template>
  <div class="card p-4 mb-3">
          <h4>{{post.title}}</h4>
          <p>{{categoryName}}</p>
          <p>{{troncateText(100)}}</p>
           <router-link :to="{ name: 'single-post', params: { slug: post.slug } }" class="card-link">Leggi post</router-link>
        </div>
</template>

<script>
export default {
  name: "PostCard",
  props: {
    post: Object,
  },

  computed: {
    categoryName() {
      return this.post.category ? this.post.category.name : "none";
    }
  },

  methods: {
    troncateText(maxCharNumber) {
      if (this.post.content.length > maxCharNumber) {
        return this.post.content.substr(0, maxCharNumber) + '...';
      }
      return this.post.content;
    }
  }
}
</script>

<style>

</style>