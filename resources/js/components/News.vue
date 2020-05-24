<template>
  <div>
    <h2>News</h2>
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li class="page-item" v-bind:class="[{disabled: !pagination.prev_page_url}]">
          <a class="page-link" @click="fetchNews(pagination.prev_page_url)">Previous</a>
        </li>
        <li class="page-item disabled">
          <a
            class="page-link text-dark"
          >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
        </li>
        <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]">
          <a class="page-link" @click="fetchNews(pagination.next_page_url)">Next</a>
        </li>
      </ul>
    </nav>
    <div class="card card-body mb-2" v-for="news in newsList" v-bind:key="news.id">
      <h3>{{ news.title }}</h3>
      <p>{{ news.body }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newsList: [],
      news: {
        id: "",
        title: "",
        body: ""
      },
      news_id: "",
      pagination: {},
      edit: false
    };
  },

  created() {
    this.fetchNews();
  },

  methods: {
    fetchNews(page_url = "/api/news") {
      //let vm = this;
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.newsList = res.data;
          this.makePagination(res.meta, res.links); //vm.
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