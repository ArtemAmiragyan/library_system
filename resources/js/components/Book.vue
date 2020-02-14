<template>
    <ul class="list-group mt-3">
        <div class="list-group-item flex-column">
            <div class="d-flex justify-content-between">
                <a v-bind:href="path">
                    <h2>{{book.title}}</h2>
                </a>
                <favorite :book="book"></favorite>
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
        computed: {
            filtered() {
                return this.book.filter(book => {
                    return this.book.title.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    }
</script>
