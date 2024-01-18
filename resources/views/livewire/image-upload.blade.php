<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="text-success me-3">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="mb-4">
                        <button class="btn btn-primary" wire:click="create">Add Image</button>
                    </div>

                    @if ($isOpen)
                        <div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="imageModal"
                            aria-hidden="true" style="display: block;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $postId ? 'Edit Image' : 'Add Image' }}</h5>
                                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                                    </div>
                                    <form wire:submit="{{ $postId ? 'update' : 'store' }}">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title:</label>
                                                <input type="text" wire:model="title" id="title"
                                                    class="form-control">
                                                <span class="text-danger">
                                                    @error('title')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            @if ($oldImage)
                                                <h3>Old Image</h3>
                                                <img src="{{ Storage::url($oldImage) }}" alt="" class="img-fluid">
                                            @endif
                                            @if ($image)
                                                <h3>New Image</h3>
                                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid">
                                            @endif
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image:</label>
                                                <input type="file" wire:model="image" id="image" class="form-control">
                                                <span class="text-danger">
                                                    @error('image')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">
                                                {{ $postId ? 'Update' : 'Create' }}
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                wire:click="closeModal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $key=> $post)
                                    <tr>
                                        <th >{{ $key+$posts->firstItem() }}</th>
                                        <th scope="row">{{ $post->title }}</th>
                                        <td>
                                            <img src="{{ Storage::url($post->image) }}" alt="Uploaded Image Preview"
                                                class="rounded-circle" style="max-width: 100px;">
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" wire:click="edit({{ $post->id }})">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                                wire:click="delete({{ $post->id }})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No post found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
