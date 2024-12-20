<div>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Mon Profil</h3>
                            </div>
                        </div>
                    </div>

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h5>Mise à jour des Informations</h5>
                                <form wire:submit.prevent="updateProfile">
                                    <div class="form-group">
                                        <label for="first_name">Prénom</label>
                                        <input type="text" id="first_name" wire:model="first_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Nom</label>
                                        <input type="text" id="last_name" wire:model="last_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" wire:model="email" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact</label>
                                        <input type="text" id="contact" wire:model="contact" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="poste">Poste</label>
                                        <input type="text" id="poste" wire:model="poste" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Genre</label>
                                        <select id="gender" wire:model="gender" class="form-control">
                                            <option value="">Sélectionner</option>
                                            <option value="male">Homme</option>
                                            <option value="female">Femme</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Adresse</label>
                                        <input type="text" id="address" wire:model="address" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h5>Changer le Mot de Passe</h5>
                                <form wire:submit.prevent="changePassword">
                                    <div class="form-group">
                                        <label for="current_password">Mot de Passe Actuel</label>
                                        <input type="password" id="current_password" wire:model="current_password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">Nouveau Mot de Passe</label>
                                        <input type="password" id="new_password" wire:model="new_password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirmer le Nouveau Mot de Passe</label>
                                        <input type="password" id="confirm_password" wire:model="confirm_password" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Changer le Mot de Passe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
