<template>
  <div class="card card-body">
    <div class="row">
      <div class="col-3">
        <img
          :src="newsItemData.main_image ? newsItemData.main_image.url : ''"
          :alt="newsItemData.main_image ? newsItemData.main_image.alt : ''"
          :title="newsItemData.main_image ? newsItemData.main_image.title : ''"
        />
      </div>
      <div class="col">
        <h3>{{ newsItemData.title }}</h3>
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