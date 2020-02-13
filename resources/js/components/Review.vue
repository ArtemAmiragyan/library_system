<script>
    import axios from 'axios';

    export default {
        props: ['review'],

        data() {
            return {
                editing: false,
                body: this.review.body,
                assessment: this.review.assessment,
            };
        },

        methods: {
            update() {
                axios.patch('/reviews/' + this.review.id, {
                    body: this.body,
                    assessment: this.assessment,
                });
                this.editing = false;
                flash('Review is updated!')
            },
            destroy() {
                axios.delete('/reviews/' + this.review.id);

                setTimeout(() => {
                    $(this.$el).remove();
                }, 100);

                flash('Your reply has been deleted.');
            }
        }
    }
</script>
