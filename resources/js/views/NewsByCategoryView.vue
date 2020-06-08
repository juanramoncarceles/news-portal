<template>
  <div>
    <h2>News for category</h2>
    <p>This is the category {{ this.$route.params.id }}</p>
    <div class="card card-body mb-2" v-for="news in newsList" :key="news.id">
      <h3>{{ news.title }}</h3>
      <p>{{ news.body }}</p>
      <p>{{ news.category }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newsList: []
    };
  },

  watch: {
    // When the route changes the function will be called.
    $route: function(newRoute, oldRoute) {
      this.fetchNewsByCategory(newRoute.params.id);
    }
  },

  created() {
    this.fetchNewsByCategory(this.$route.params.id);
  },

  methods: {
    fetchNewsByCategory(categoryId = 1) {
      fetch(`${window.location.origin}/api/news?category=${categoryId}`)
        .then(res => res.json())
        .then(res => {
          this.newsList = res.data;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>