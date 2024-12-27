<div>
<br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Paramétrage</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">

                            @if (session()->has('message'))
                                <div class="alert alert-success mt-3">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="card-inner">
                                <form wire:submit.prevent="updateParametre">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Type</label>
                                                <input type="text" class="form-control" wire:model.defer="type" required>
                                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nom</label>
                                                <input type="text" class="form-control" wire:model.defer="name" required>
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" class="form-control" wire:model.defer="address" required>
                                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Téléphone 1</label>
                                                <input type="text" class="form-control" wire:model.defer="contact_phone_1" required>
                                                @error('contact_phone_1') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Téléphone 2</label>
                                                <input type="text" class="form-control" wire:model.defer="contact_phone_2">
                                                @error('contact_phone_2') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Téléphone 3</label>
                                                <input type="text" class="form-control" wire:model.defer="contact_phone_3">
                                                @error('contact_phone_3') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" wire:model.defer="email">
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Site Web</label>
                                                <input type="url" class="form-control" wire:model.defer="website">
                                                @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" wire:model.defer="description"></textarea>
                                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Facebook</label>
                                                <input type="text" class="form-control" wire:model.defer="facebook">
                                                @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Twitter</label>
                                                <input type="text" class="form-control" wire:model.defer="twitter">
                                                @error('twitter') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Instagram</label>
                                                <input type="text" class="form-control" wire:model.defer="instagram">
                                                @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">YouTube</label>
                                                <input type="text" class="form-control" wire:model.defer="youtube">
                                                @error('youtube') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
