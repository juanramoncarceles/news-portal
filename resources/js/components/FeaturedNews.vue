<template>
  <div>
    <h2>Featured News</h2>
    <div class="row">
      <!-- <div class="card card-body col-md-6 mb-2" v-for="news in newsList" :key="news.id">
        <h3>{{ news.title }}</h3>
        <p>{{ news.body }}</p>
        <p>{{ news.category }}</p>
      </div>-->

      <div class="card-deck">
        <div class="card" v-for="news in newsList" :key="news.id">
          <img
            class="card-img-top"
            :src="news.main_image ? news.main_image.url : ''"
            :alt="news.main_image ? news.main_image.alt : ''"
            :title="news.main_image ? news.main_image.title : ''"
          />
          <div class="card-body">
            <h5 class="card-title">{{ news.title }}</h5>
            <router-link :to="{ name: 'News', params: { id: news.id } }">Read more</router-link>
            <p class="card-text">{{ news.body }}</p>
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