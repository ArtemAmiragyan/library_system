<template>
    <button type="submit" :class="classes" @click="toogle">
        <span>❤</span>
        <small v-text="favoritesCount"></small>
    </button>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Favorite",

        props: ['book'],
        data() {
            return {
                favoritesCount: this.book.favoritesCount,
                isFavorited: this.book.isFavorited,
            }
        },

        computed: {
            classes() {
                return [ 'btn',
                    'btn-rounded',
                    this.isFavorited ? 'btn-secondary ' : 'btn-default'
                ];
            },
        },

        methods: {
            toogle() {
                this.isFavorited ? this.destroy() : this.create();
            },

            create() {
                axios.post('/books/' + this.book.id + '/favorites/');

                this.isFavorited = true;
                this.favoritesCount++;
            },

            destroy() {
                axios.delete('/books/' + this.book.id + '/favorites/delete');

                this.isFavorited = false;
                this.favoritesCount--;
            },
        }
    }
</script>
<style scoped>
    .btn-rounded {
        width: 60px;
        height: 38px;
        border-radius: 19px;
    }
</style>

