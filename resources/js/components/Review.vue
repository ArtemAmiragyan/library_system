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
                axios.patch(`/reviews/${this.review.id}`, {
                        body: this.body,
                        assessment: this.assessment,
                    })
                    .then(() => {
                        flash('Review is updated!');
                        this.editing = false;
                    })
                    .catch((error) => {
                        flash(`Whoops! ${error}`,'danger');
                    });
            },

            destroy() {
                axios.delete(`/reviews/${this.review.id}`)
                    .then(() => {
                        flash('Your review has been deleted.');
                        $(this.$el).remove();
                    })
                    .catch((error) => {
                        flash(`Whoops! ${error}`, 'danger');
                    });
            }
        }
    }
</script>
