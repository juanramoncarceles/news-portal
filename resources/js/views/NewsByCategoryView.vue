<template>
  <div>
    <h2 class="mb-4" v-show="this.categoryName">Noticias de {{ this.categoryName }}</h2>
    <router-link
      :to="{ name: 'News', params: { id: news.id } }"
      tag="div"
      v-for="news in newsList"
      :key="news.id"
      style="cursor:pointer"
    >
      <news-item-card-small :newsItemData="news" class="mb-3"></news-item-card-small>
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    categoriesData: {
      type: Array
    }
  },

  data() {
    return {
      newsList: [],
      categoryId: this.$route.params.id,
      categoryName: ""
    };
  },

  watch: {
    // When the route changes the function will be called.
    $route: function(newRoute, oldRoute) {
      this.setCategoryName(newRoute.params.id);
      this.fetchNewsByCategory(newRoute.params.id);
    },
    // This will be required when the first page loaded is a category page.
    categoriesData: function(newValue, oldValue) {
      this.setCategoryName(this.categoryId);
    }
  },

  created() {
    this.fetchNewsByCategory(this.categoryId);
    // This is required when coming from a different page than a category page.
    if (this.categoriesData.length > 1) {
      this.setCategoryName(this.categoryId);
    }
  },

  methods: {
    fetchNewsByCategory(categoryId = 1) {
      fetch(`${window.location.origin}/api/news?category=${categoryId}`)
        .then(res => res.json())
        .then(res => {
          this.newsList = res.data;
        })
        .catch(err => console.log(err));
    },

    setCategoryName(id) {
      this.categoryName = this.categoriesData[id - 1].name;
    }
  }
};
</script>