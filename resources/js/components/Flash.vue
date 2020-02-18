<template>
    <div :class="['alert', `alert-${type}`, 'alert-flash']" role="alert" v-show="show">
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: '',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }
            window.events.$on(
                'flash',
                (message, type) => {
                    this.flash(message, type)
                }
            );
        },

        methods: {
            flash(message, type = 'success') {
                this.body = message;
                this.type = type;
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
