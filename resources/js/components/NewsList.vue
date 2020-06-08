<template>
  <div>
    <h2>News</h2>
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li
          class="page-item"
          style="cursor:pointer"
          v-bind:class="[{disabled: !pagination.prev_page_url}]"
        >
          <a class="page-link" @click="fetchNewsPaginated(pagination.prev_page_url)">Previous</a>
        </li>
        <li class="page-item disabled">
          <a
            class="page-link text-dark"
          >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
        </li>
        <li
          class="page-item"
          style="cursor:pointer"
          v-bind:class="[{disabled: !pagination.next_page_url}]"
        >
          <a class="page-link" @click="fetchNewsPaginated(pagination.next_page_url)">Next</a>
        </li>
      </ul>
    </nav>
    <router-link
      :to="{ name: 'News', params: { id: news.id } }"
      tag="div"
      v-for="news in newsList"
      v-bind:key="news.id"
      style="cursor:pointer"
    >
      <news-item-card-small :newsItemData="news" class="mb-3"></news-item-card-small>
    </router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newsList: [],
      // news: {
      //   id: "",
      //   title: "",
      //   body: ""
      // },
      // news_id: "",
      pagination: {}
      // edit: false
    };
  },

  created() {
    this.fetchNewsPaginated();
  },

  methods: {
    fetchNewsPaginated(page_url = "/api/news?paginate=10") {
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