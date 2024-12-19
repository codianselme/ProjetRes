<div>
    <article id="main-content">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="section-sub-heading">Réservation</h2>
                        <nav aria-label="breadcrumb" class="breadcrumb-nav">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="https://project.yahoobaba.net/restaurant-management">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Réservation</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section id="reservation-form" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="section-heading text-center">Réserver une table</h3>
                        <h4 class="section-sub-heading text-center">Faites une réservation</h4>
                        <form class="row bg-white position-relative" id="check-tables" method="POST">
                            <input type="hidden" name="_token" value="jdW0PBQGLuNRcSbtdExCi4VaSGZUC3KKsVT82JZZ">
                            <div class="form-group col-md-4 mb-4">
                                <input type="number" class="form-control" name="persons" placeholder="Personnes" required>
                            </div>
                            <div class="form-group col-md-4 mb-4">
                                <input type="date" class="form-control" name="date" value="2024-12-19" required>
                            </div>
                            <div class="form-group col-md-4 mb-4">
                                <input type="time" class="form-control" name="time" value="03:28" required>
                            </div>
                            <div class="form-group col-md-12 text-center">
                                <input type="submit" class="btn link-button" value="Vérifier la disponibilité">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="available-tables py-5 position-relative">
            <!-- Tables disponibles -->
        </div>
    </article>
</div>
