<div class="container py-5">
    <!-- En-tête de la catégorie -->
    <div class="category-header mb-5">
        <h1 class="text-center mb-3">{{ $category['name'] }}</h1>
        <p class="text-center lead mb-5">{{ $category['description'] }}</p>
    </div>

    <!-- Catalogue des plats -->
    <div class="row">
        @foreach($dishes as $dish)
        <div class="col-lg-4 mb-4">
            <div class="dish-card">
                <div class="dish-gallery">
                    <div class="main-image mb-3">
                        <img src="{{ $dish['images'][0] }}" alt="{{ $dish['title'] }}" 
                             class="img-fluid rounded main-img" 
                             id="mainImage-{{ $loop->index }}">
                    </div>
                    @if(count($dish['images']) > 1)
                        <div class="thumbnails d-flex gap-2">
                            @foreach($dish['images'] as $image)
                                <div class="thumbnail-item" 
                                     onclick="changeMainImage('{{ $image }}', {{ $loop->parent->index }})">
                                    <img src="{{ $image }}" alt="Thumbnail" class="img-fluid rounded">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="dish-content">
                    <h2 class="dish-title">{{ $dish['title'] }}</h2>
                    {{-- <div class="price mb-3">
                        <span class="text-primary h4">{{ $dish['price'] }}</span>
                    </div> --}}
                    <div class="description mb-3">
                        <p>{{ $dish['description'] }}</p>
                    </div>
                    <div class="details">
                        {{-- <div class="ingredients mb-3">
                            <h5><i class="fas fa-utensils me-2"></i>Ingrédients:</h5>
                            <ul class="list-unstyled">
                                @foreach($dish['ingredients'] as $ingredient)
                                    <li><i class="fas fa-check text-success me-2"></i>{{ $ingredient }}</li>
                                @endforeach
                            </ul>
                        </div> --}}
                        <div class="preparation-time">
                            <h5><i class="far fa-clock me-2"></i>Temps de préparation:</h5>
                            <p>{{ $dish['preparation_time'] }}</p>
                        </div>
                    </div>
                    {{-- <div class="actions mt-3">
                        <button class="btn btn-primary" wire:click="orderDish({{ $dish['id'] }})">
                            Commander
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.category-header {
    background-color: #f8f9fa;
    padding: 3rem 0;
    border-radius: 15px;
    margin-bottom: 2rem;
}

.dish-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    height: 100%;
}

.dish-gallery {
    position: relative;
}

.main-image {
    height: 300px;
    overflow: hidden;
}

.main-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnails {
    padding: 10px;
    gap: 10px;
    overflow-x: auto;
    display: flex;
    align-items: center;
}

.thumbnail-item {
    flex: 0 0 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    opacity: 0.7;
    transition: all 0.3s ease;
    position: relative;
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    position: absolute;
    top: 0;
    left: 0;
}

.thumbnail-item:hover {
    opacity: 1;
    transform: scale(1.05);
}

.thumbnails::-webkit-scrollbar {
    height: 6px;
}

.thumbnails::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.thumbnails::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.thumbnails::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.dish-content {
    padding: 1.5rem;
}

.dish-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.details {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
}

.ingredients ul li {
    margin-bottom: 0.5rem;
}

.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-primary {
    padding: 0.5rem 2rem;
}
</style>

<script>
function changeMainImage(src, index) {
    const mainImage = document.getElementById(`mainImage-${index}`);
    mainImage.style.opacity = '0';
    
    setTimeout(() => {
        mainImage.src = src;
        mainImage.style.opacity = '1';
    }, 200);
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.main-img').forEach(img => {
        img.style.transition = 'opacity 0.2s ease';
    });
});
</script>
