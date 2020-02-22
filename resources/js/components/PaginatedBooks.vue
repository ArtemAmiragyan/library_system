<template>
  <div>
    <nav aria-label="Page navigation example">
      <ul class="pagination">

        <li class="page-item">
          <button class="btn btn-default" :disabled="pageNumber === 0" @click="prevPage">
            Previous
          </button>
        </li>

        <li class="page-item">
          <button class="btn btn-default" :disabled="pageNumber >= pageCount -1"
                  @click="nextPage()">
            Next
          </button>
        </li>

      </ul>
    </nav>

    <ul>
      <div v-for="book in paginatedData">
        <book :book="book"/>
      </div>
    </ul>

    <nav aria-label="Page navigation example">
      <ul class="pagination">

        <li class="page-item">
          <button class="btn btn-default" :disabled="pageNumber === 0" @click="prevPage">
            Previous
          </button>
        </li>

        <li class="page-item">
          <button class="btn btn-default" :disabled="pageNumber >= pageCount -1"
                  @click="nextPage()">
            Next
          </button>
        </li>

      </ul>
    </nav>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        pageNumber: 0,
      }
    },

    props: {
      books: {
        type: Array,
        required: true,
      },

      size: {
        type: Number,
        required: false,
        default: 10,
      }
    },

    methods: {
      nextPage() {
        this.pageNumber++;
      },

      prevPage() {
        this.pageNumber--;
      },
    },

    computed: {
      pageCount() {
        return Math.ceil(this.books.length / this.size);
      },

      paginatedData() {
        const start = this.pageNumber * this.size,
          end = start + this.size;
        return this.books.slice(start, end);
      }
    }
  }
</script>


