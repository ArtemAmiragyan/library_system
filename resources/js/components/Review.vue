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
            }
        }
    }
</script>
