<template>
    <ul class="list-group mt-3">
        <div class="list-group-item flex-column">
            <div class="d-flex justify-content-between">
                <a v-bind:href="path">
                    <h2>{{book.title}}</h2>
                </a>
            </div>
        </div>
        <div class="list-group-item">
            <p>{{shortDescription}}...</p>
        </div>
    </ul>
</template>

<script>
    export default {
        name: "book",
        props: ['book'],
        data() {
            return {
                path: `/books/${this.book.id}`,
                shortDescription: this.book.description.substring(0, 200),
            }
        }
    }
</script>
