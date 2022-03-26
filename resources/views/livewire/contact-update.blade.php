<div class="mb-3">
    <form wire:submit.prevent="update">
        <input type="hidden" wire:model="contactId">
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <input 
                        wire:model="name" 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        placeholder="name"
                    >
                    @error('name')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <input 
                        wire:model="phone" 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        class="form-control @error('phone') is-invalid @enderror" 
                        placeholder="phone"
                    >
                    @error('phone')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success">UPDATE</button>
    </form>
</div>

