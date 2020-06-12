<template>
  <div>
    <h2 class="mb-4">{{ groupTitle }}</h2>
    <div class="row">
      <div class="col-md-6 mb-4" v-for="news in newsList" :key="news.id">
        <div class="card border-primary">
          <img
            class="card-img-top"
            :src="news.main_image ? news.main_image.url : ''"
            :alt="news.main_image ? news.main_image.alt : ''"
            :title="news.main_image ? news.main_image.title : ''"
          />
          <div class="card-body">
            <h4 class="card-title">{{ news.title }}</h4>
            <div class="row">
              <div class="col">
                <h5 class="card-subtitle mb-2 text-muted">{{ news.author }}</h5>
              </div>
              <div class="col">
                <p
                  class="font-weight-bold"
                  style="text-align:right;"
                >{{ news.publication_date.split(' ')[0] }}</p>
              </div>
            </div>
            <p class="card-text">{{ news.summary }}</p>
            <router-link
              class="btn btn-primary"
              :to="{ name: 'News', params: { id: news.id } }"
            >Leer más</router-link>
          </div>
          <div class="card-footer">
            <span>{{ news.category }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    groupTitle: {
      type: String
    }
  },

  data() {
    return {
      newsList: []
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
          this.$emit(
            "featuredIds",
            this.newsList.map(news => news.id)
          );
        })
        .catch(err => console.log(err));
    }
  }
};
</script>