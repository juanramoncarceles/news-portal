<template>
  <div>
    <div>
      <news-list
        :pagination-amount="5"
        :category-ids="[categoryId]"
        :list-title="'Noticias de ' + categoryName"
        :show-items-category="false"
        @fetched="onFetched"
      />
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
      newsAvailable: false,
      categoryId: this.$route.params.id,
      categoryName: "",
      notFoundMsg: ""
    };
  },

  watch: {
    // When the route changes the function will be called.
    $route: function(newRoute, oldRoute) {
      this.setCategoryName(newRoute.params.id);
      this.categoryId = newRoute.params.id;
    },
    // This will be required when the first page loaded is a category page.
    categoriesData: function(newValue, oldValue) {
      this.setCategoryName(this.categoryId);
    }
  },

  created() {
    // This is required when coming from a different page than a category page.
    if (this.categoriesData.length > 1) {
      this.setCategoryName(this.categoryId);
    }
  },

  methods: {
    onFetched(fetched) {
      this.newsAvailable = fetched;
      if (!fetched) {
        this.notFoundMsg = `Ninguna noticia con esa categoría fue encontrada :(`;
      }
    },

    setCategoryName(id) {
      if (id > 0 && id <= this.categoriesData.length) {
        this.categoryName = this.categoriesData[id - 1].name;
      }
    }
  }
};
</script>