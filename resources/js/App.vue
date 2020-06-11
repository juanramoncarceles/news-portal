<template>
  <div>
    <navbar :categoriesData="categoriesList" />
    <div class="container mt-5">
      <router-view :categoriesData="categoriesList" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categoriesList: []
    };
  },

  created() {
    this.fetchCategories();
  },

  methods: {
    fetchCategories() {
      fetch("/api/categories")
        .then(res => res.json())
        .then(res => {
          this.categoriesList = res;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>