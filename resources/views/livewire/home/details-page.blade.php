<div class="container py-5">
    <div class="row">
        <!-- Galerie d'images -->
        <div class="col-lg-6 mb-4">
            <div class="product-gallery">
                <div class="main-image mb-3">
                    <img src="{{ $details['images'][0] }}" alt="{{ $details['title'] }}" class="img-fluid rounded main-img" id="mainImage">
                </div>
                @if(count($details['images']) > 1)
                    <div class="thumbnails d-flex gap-2">
                        @foreach($details['images'] as $image)
                            <div class="thumbnail-item" onclick="changeMainImage('{{ $image }}')">
                                <img src="{{ $image }}" alt="Thumbnail" class="img-fluid rounded">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Détails du produit -->
        <div class="col-lg-6">
            <h1 class="mb-4">{{ $details['title'] }}</h1>
            <div class="price mb-4">
                <h3 class="text-primary">{{ $details['price'] }}</h3>
            </div>
            <div class="description mb-4">
                <h4>Description</h4>
                <p>{{ $details['description'] }}</p>
            </div>
            <div class="ingredients mb-4">
                <h4>Ingrédients</h4>
                <ul class="list-unstyled">
                    @foreach($details['ingredients'] as $ingredient)
                        <li><i class="fas fa-check text-success me-2"></i>{{ $ingredient }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="preparation-time mb-4">
                <h4>Temps de préparation</h4>
                <p><i class="far fa-clock me-2"></i>{{ $details['preparation_time'] }}</p>
            </div>
        </div>
    </div>
</div>

<style>
    .product-gallery {
        position: relative;
    }

    .main-image {
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .main-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .main-image:hover img {
        transform: scale(1.05);
    }

    .thumbnails {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .thumbnail-item {
        flex: 0 0 80px;
        height: 80px;
        overflow: hidden;
        border-radius: 4px;
        cursor: pointer;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .thumbnail-item:hover {
        opacity: 1;
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .description, .ingredients, .preparation-time {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    h4 {
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .price h3 {
        font-weight: bold;
        color: #2c3e50;
    }
</style>

<script>
function changeMainImage(src) {
    const mainImage = document.getElementById('mainImage');
    mainImage.style.opacity = '0';
    
    setTimeout(() => {
        mainImage.src = src;
        mainImage.style.opacity = '1';
    }, 200);
}

// Animation de transition pour l'image principale
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('mainImage').style.transition = 'opacity 0.2s ease';
});
</script>
