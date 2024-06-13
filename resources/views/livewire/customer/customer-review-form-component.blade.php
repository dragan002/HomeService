<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submitReview">
        <div class="form-group">
            <label for="comment">Tell us about experience</label>
            <textarea id="comment" class="form-control" wire:model="comment"></textarea>
            @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="rating">Rating</label>
            <select id="rating" class="form-control" wire:model="rating">
                <option value="">Choose rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
