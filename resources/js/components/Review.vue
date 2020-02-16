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
                        alert(`Whoops! ${error}`);
                        this.editing = true;
                    });
            },

            destroy() {
                axios.delete(`/reviews/${this.review.id}`)
                    .then(() => {
                        flash('Your reply has been deleted.');

                        setTimeout(() => {
                            $(this.$el).remove();
                        }, 100);
                    })
                    .catch((error) => {
                        alert(`Whoops! ${error}`);
                    });
            }
        }
    }
</script>
