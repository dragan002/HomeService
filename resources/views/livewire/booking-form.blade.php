<div>
    <h2>Book Service: {{ $service->name }}</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="bookService">
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" class="form-control" wire:model="date">
            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" id="time" class="form-control" wire:model="time">
            @error('time') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>
