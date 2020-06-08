<template>
  <div>
    <h2>Featured News</h2>
    <div class="row">
      <div class="col-md-6 mb-4" v-for="news in newsList" :key="news.id">
        <div class="card">
          <img
            class="card-img-top"
            :src="news.main_image ? news.main_image.url : ''"
            :alt="news.main_image ? news.main_image.alt : ''"
            :title="news.main_image ? news.main_image.title : ''"
          />
          <div class="card-body">
            <h4 class="card-title">{{ news.title }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">{{ news.author }}</h6>
            <p class="card-text">{{ news.summary }}</p>
            <router-link
              class="btn btn-primary"
              :to="{ name: 'News', params: { id: news.id } }"
            >Read more</router-link>
          </div>
          <div class="card-footer">
            <small class="text-muted">{{ news.category }}</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newsList: []
      // news: {
      //   id: "",
      //   title: "",
      //   body: "",
      //   category: ""
      // },
      // news_id: "",
      // edit: false
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