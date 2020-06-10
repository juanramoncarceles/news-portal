<template>
  <div>
    <div v-if="Object.keys(newsItem).length > 0">
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
    <div v-else>
      <p>{{ notFoundMsg }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newsItem: {},
      notFoundMsg: ""
    };
  },

  created() {
    this.fetchNewsItemById(this.$route.params.id);
  },

  methods: {
    fetchNewsItemById(newsItemId) {
      fetch(`${window.location.origin}/api/news/${newsItemId}`)
        .then(res => {
          if (res.ok === true && res.status === 200) {
            return res.json();
          } else if (res.statusText) {
            throw res.statusText;
          } else {
            throw "News item couldn't be fetched.";
          }
        })
        .then(res => {
          this.newsItem = res.data;
        })
        .catch(err => {
          this.notFoundMsg = `No news item with id ${newsItemId} could be found or fetched.`;
          console.warn(err);
        });
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