<template>
  <div>
    <featured-news @featuredIds="onFeaturedIds" group-title="Noticias destacadas" />
    <hr />
    <news-list
      v-if="featuredIds.length > 0"
      :excludeIds="featuredIds"
      list-title="Otras noticias"
      class="mt-5"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      featuredIds: []
    };
  },

  methods: {
    onFeaturedIds(ids) {
      this.featuredIds = ids;
    }
  }
};
</script>