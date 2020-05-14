<template>
  <div>
    <h2>News</h2>
    <div class="card card-body mb-2" v-for="news in newsList" v-bind:key="news.id">
      <h3>{{ news.title }}</h3>
      <p>{{ news.body }}</p>
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
        body: ""
      },
      news_id: "",
      pagination: {},
      edit: false
    };
  },

  created() {
    this.fetchNews();
  },

  methods: {
    fetchNews() {
      fetch("api/news")
        .then(res => res.json())
        .then(res => {
          this.newsList = res.data;
        });
    }
  }
};
</script>