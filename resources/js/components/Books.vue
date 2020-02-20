<template>
  <div class="container">
    <div class="search-wrapper">
      <input class="form-control" type="text" v-model="query" placeholder="Search title.."/>
      <button class="btn btn-submit" type="button" @click="search()" v-if="!loading">Search!
      </button>
      <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...
      </button>
    </div>
    <div v-for="book in books">
      <book :book="book"></book>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "Books",

    data() {
      return {
        books: [],
        loading: false,
        query: '',
      }
    },
    created() {
      axios.get('getBooks')
        .then((response) => {
          this.books = response.data;
        })
        .catch((error) => {
          return flash(error, 'danger')
        })
    },
    methods: {
      search: function () {
        this.books = [];

        this.loading = true;

        axios.get(`search?q=${this.query}`)
          .then((response) => {
            this.books = response.data;

            this.loading = false;
          })
          .catch((error) => {
            return flash(error, 'danger')
          })
      }
    }
  }
</script>
