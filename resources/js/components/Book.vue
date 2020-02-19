<template>
  <ul class="list-group mt-3">
    <div class="list-group-item flex-column">
      <div class="d-flex justify-content-between">
        <a :href="path">
          <h2>{{book.title}}</h2>
        </a>
        <favorite :book="book"/>
      </div>
    </div>
    <div class="list-group-item">
      <p>{{shortDescription}}...</p>
    </div>
  </ul>
</template>
<script>
  import Favorite from "./Favorite.vue";

  export default {
    name: "book",

    components: {Favorite},

    props: ['book'],

    data() {
      return {
        path: `/books/${this.book.id}`,
        shortDescription: this.book.description.substring(0, 200),
      }
    },
  }
</script>
