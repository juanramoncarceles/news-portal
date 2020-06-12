<template>
  <div>
    <div v-if="newsList.length > 0">
      <h2 class="mb-4" v-show="categoryName">Noticias de {{ categoryName }}</h2>
      <router-link
        :to="{ name: 'News', params: { id: news.id } }"
        tag="div"
        v-for="news in newsList"
        :key="news.id"
        style="cursor:pointer"
      >
        <news-item-card-small :newsItemData="news" :show-category="false" class="mb-3" />
      </router-link>
    </div>
    <div v-else>
      <p>{{ notFoundMsg }}</p>
    </div>
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
      categoryName: "",
      notFoundMsg: ""
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
          if (res.data.length === 0) {
            this.notFoundMsg = `No news for that category could be found or fetched.`;
            console.warn(this.notFoundMsg);
          }
        })
        .catch(err => console.log(err));
    },

    setCategoryName(id) {
      if (id > 0 && id <= this.categoriesData.length) {
        this.categoryName = this.categoriesData[id - 1].name;
      }
    }
  }
};
</script>