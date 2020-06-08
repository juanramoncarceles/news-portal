<template>
  <div>
    <h2>{{ newsItem.title }}</h2>
    <p>This is the news id {{ this.$route.params.id }}</p>
    <div class>
      <p>{{ newsItem.category }}</p>
      <p>{{ newsItem.body }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newsItem: {}
    };
  },

  created() {
    this.fetchNewsItemById(this.$route.params.id);
  },

  methods: {
    fetchNewsItemById(newsItemId) {
      fetch(`${window.location.origin}/api/news/${newsItemId}`)
        .then(res => res.json())
        .then(res => {
          this.newsItem = res.data;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>