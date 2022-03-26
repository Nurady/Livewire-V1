<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session()->has('updated'))
        <div class="alert alert-info">{{ session('updated') }}</div>
    @endif

    @if (session()->has('deleted'))
        <div class="alert alert-warning">{{ session('deleted') }}</div>
    @endif

    @if ($statusUpdate == 'true')
        @livewire('contact-update')
    @else
        @livewire('contact-create')
    @endif
    <hr>
    
    <div class="d-flex justify-content-between">
        <div class="col">
            <select wire:model="paginate" class="w-auto form-control form-control-sm">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <div class="col">
            <input wire:model="search" type="text" placeholder="Search" class="form-control form-control-sm">
        </div>
    </div>
    <hr>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $key=>$item)
                <tr>
                    {{-- <th scope="row">{{ $key + 1 }}</th> --}}
                    <th scope="row">{{ ($contacts ->currentpage()-1) * $contacts ->perpage() + $loop->index + 1 }}</th>
                    <th scope="row">{{ $item->name }}</th>
                    <th scope="row">{{ $item->phone }}</th>
                    <th scope="row">
                        <button wire:click="getContact({{ $item->id }})" class="text-white btn btn-sm btn-primary">
                            Edit
                        </button>
                        <button wire:click="destroy({{ $item->id }})" class="text-white btn btn-sm btn-danger">
                            Delete
                        </button>
                    </th>
                </tr>                
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>
