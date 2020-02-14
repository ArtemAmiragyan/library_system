<template>
    <div class="search-wrapper">
        <input type="text" v-model="search" placeholder="Search title.."/>
        <label>Search title:</label>
    </div>
</template>
<script>
    export default {
        name: "Search",
        data() {
            return {
                search: '',
            }
        },
    }
</script>
<style scoped>
    .search-wrapper {
        position: relative;
    }
    label {
        position: absolute;
        font-size: 12px;
        color: rgba(0,0,0,.50);
        top: 8px;
        left: 12px;
        z-index: -1;
        transition: .15s all ease-in-out;
    }
</style>
