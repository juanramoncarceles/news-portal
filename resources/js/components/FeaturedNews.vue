<template>
  <div>
    <h2>Featured News</h2>
    <div class="card card-body mb-2" v-for="news in newsList" v-bind:key="news.id">
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
      newsList: [],
      news: {
        id: "",
        title: "",
        body: "",
        category: ""
      },
      news_id: "",
      edit: false
    };
  },

  created() {
    this.fetchFeaturedNews(4);
  },

  methods: {
    fetchFeaturedNews(amount = 10) {
      fetch(`/api/news?featured=only&limit=${amount}`)
        .then(res => res.json())
        .then(res => {
          this.newsList = res.data;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>