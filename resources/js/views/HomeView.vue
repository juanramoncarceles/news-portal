<template>
  <div>
    <featured-news @featuredIds="onFeaturedIds" />
    <hr />
    <news-list v-if="featuredIds.length > 0" :excludeIds="featuredIds" class="mt-5" />
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