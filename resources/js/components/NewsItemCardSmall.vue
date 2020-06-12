<template>
  <div class="card card-body">
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <img
          :src="newsItemData.main_image ? newsItemData.main_image.url : ''"
          :alt="newsItemData.main_image ? newsItemData.main_image.alt : ''"
          :title="newsItemData.main_image ? newsItemData.main_image.title : ''"
        />
      </div>
      <div class="col mt-4 mt-md-0">
        <div class="row">
          <div class="col">
            <h3 class="mb-3">{{ newsItemData.title }}</h3>
          </div>
          <div v-if="showCategory" class="col-6 col-lg-4" style="text-align:right;">
            <p
              class="badge badge-pill badge-secondary"
              style="font-size:1rem;"
            >{{ newsItemData.category }}</p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <h5 class="card-subtitle mb-2 text-muted">{{ newsItemData.author }}</h5>
          </div>
          <div class="col">
            <p
              class="font-weight-bold"
              style="text-align:right;"
            >{{ newsItemData.publication_date.split(' ')[0] }}</p>
          </div>
        </div>
        <p>{{ newsItemData.summary }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    newsItemData: {
      type: Object
    },
    showCategory: {
      type: Boolean,
      default: true
    }
  }
};
</script>

<style scoped>
img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>