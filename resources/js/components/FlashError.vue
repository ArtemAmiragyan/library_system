<template>
    <div class="alert alert-danger alert-flash" role="alert" v-show="show">
        <strong>Whops!</strong> Try again!
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
                show: false
            }
        },

        created() {
            this.flash(this.message);
        },

        methods: {
            flash() {
                this.show = true;
                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        z-index: 1;
        position: fixed;
        padding-left: 50px;
        right: 25px;
        bottom: 25px;
        padding-right: 50px;
    }
</style>
