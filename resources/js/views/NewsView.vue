<template>
  <div>
    <h2 class="mb-4">{{ newsItem.title }}</h2>
    <img
      class="main-image mb-4"
      :src="newsItem.main_image ? newsItem.main_image.url : ''"
      :alt="newsItem.main_image ? newsItem.main_image.alt : ''"
      :title="newsItem.main_image ? newsItem.main_image.title : ''"
    />
    <p>{{ newsItem.author }}</p>
    <div>
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

<style scoped>
.main-image {
  width: 100%;
  height: 350px;
  object-fit: cover;
}
</style>