<div class="container py-5">
    <div class="category-header mb-5">
        <h1 class="text-center mb-3">{{ $category['name'] }}</h1>
        <p class="text-center lead mb-5">{{ $category['description'] }}</p>
    </div>

    <div class="row">
        @foreach($dishes as $dish)
        <div class="col-lg-6 mb-4">
            <div class="dish-card">
                <div class="dish-content p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="dish-title mb-0">{{ $dish['title'] }}</h3>
                        <span class="price badge bg-primary">{{ $dish['price'] }}</span>
                    </div>
                    <p class="description mb-3">{{ $dish['description'] }}</p>
                    <div class="preparation-time">
                        <small class="text-muted">
                            <i class="far fa-clock me-2"></i>
                            Temps de préparation: {{ $dish['preparation_time'] }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($category['name'] === 'Accompagnements')
    <div class="accompaniments-note mt-4">
        <p class="text-center text-muted">
            Ces accompagnements sont disponibles au choix avec nos plats principaux
        </p>
    </div>
    @endif
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
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    height: 100%;
    transition: transform 0.3s ease;
}

.dish-card:hover {
    transform: translateY(-5px);
}

.dish-title {
    font-size: 1.25rem;
    color: #2c3e50;
}

.price {
    font-size: 1rem;
    padding: 0.5rem 1rem;
}

.description {
    color: #666;
    font-size: 0.95rem;
}

.preparation-time {
    color: #888;
    font-size: 0.9rem;
}

.accompaniments-note {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
}
</style>
