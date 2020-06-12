<template>
  <div>
    <h2 class="mb-4">{{ listTitle }}</h2>
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li
          class="page-item"
          style="cursor:pointer"
          v-bind:class="[{disabled: !pagination.prev_page_url}]"
        >
          <a class="page-link" @click="fetchNewsPaginated(pagination.prev_page_url)">Previa</a>
        </li>
        <li class="page-item disabled">
          <a
            class="page-link text-dark"
          >Página {{ pagination.current_page }} de {{ pagination.last_page }}</a>
        </li>
        <li
          class="page-item"
          style="cursor:pointer"
          v-bind:class="[{disabled: !pagination.next_page_url}]"
        >
          <a class="page-link" @click="fetchNewsPaginated(pagination.next_page_url)">Siguiente</a>
        </li>
      </ul>
    </nav>
    <router-link
      :to="{ name: 'News', params: { id: news.id } }"
      tag="div"
      v-for="news in newsList"
      :key="news.id"
      style="cursor:pointer"
    >
      <news-item-card-small :newsItemData="news" :show-category="true" class="mb-3" />
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    excludeIds: {
      type: Array,
      default: function() {
        return [];
      }
    },
    listTitle: {
      type: String
    }
  },

  data() {
    return {
      newsList: [],
      pagination: {}
    };
  },

  created() {
    this.fetchNewsPaginated();
  },

  methods: {
    fetchNewsPaginated(
      page_url = `/api/news?paginate=10${
        this.excludeIds.length > 0 ? "&exclude=" + this.excludeIds.join() : ""
      }`
    ) {
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.newsList = res.data;
          this.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    }
  }
};
</script>