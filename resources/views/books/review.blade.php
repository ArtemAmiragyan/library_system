<review :review="{{ json_encode($review) }}" inline-template v-cloak>
    <ul id="review-{{ $review->id }}" class="list-group m-4">
        <li class="list-group-item break-word">
            <div class="level">
                <h5 class="flex">
                    <a href="{{ route('profile', $review->owner->id) }}">
                        {{ $review->owner->name }}
                    </a>
                </h5>
                <small>Assessment:</small>
                <small v-text="assessment"></small>
            </div>
        </li>

        <li class="list-group-item break-word">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <h6>Rating:</h6>
                <div class="form-group">
                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" v-model="assessment">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <button class="btn btn-xs btn-primary" @click="update">Update</button>
                <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
            </div>

            <div v-else v-text="body"></div>

        </li>

        <li class="list-group-item break-word">
            <small class="text-muted"> {{ $review->created_at->diffForHumans() }}... </small>
        </li>
        @can ('delete', $review)
            <li class="list-group-item level">
                <button class="btn btn-link mr-1" @click="editing = true">Edit</button>
                <button class="btn btn-link" @click="destroy">Delete</button>
            </li>
        @endcan
    </ul>
</review>
