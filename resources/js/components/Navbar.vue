<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info mb-2">
    <div class="container">
      <a class="navbar-brand">News Portal</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link">
              Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              id="navbarDropdownMenuLink"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >Categorias</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a
                class="dropdown-item"
                v-for="category in categoriesList"
                v-bind:key="category.id"
              >{{ category.name }}</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      categoriesList: [],
      category: {
        id: "",
        name: ""
      }
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