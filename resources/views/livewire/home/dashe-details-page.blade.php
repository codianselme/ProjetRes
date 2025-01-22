<div>
    <div class="container py-5">
        <div class="category-header mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-center mb-3">{{ $category['name'] }}</h1>
                <div class="cart-counter" wire:click="toggleCart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge bg-primary">{{ count($cart) }}</span>
                </div>
            </div>
            <p class="text-center lead mb-5">{{ $category['description'] }}</p>
        </div>

        <div class="zoom-modal" id="imageZoomModal" onclick="closeZoom()">
            <img src="" alt="" id="zoomedImage">
        </div>

        @if($details)
            <div class="gallery-container mb-5">
                <div class="main-image-container mb-4 position-relative">
                    <button class="nav-arrow prev" onclick="changeSlide(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <img src="{{ asset($details[0]['image']) }}" 
                        alt="{{ $details[0]['title'] }}"
                        class="main-image"
                        id="mainDisplayImage"
                        onclick="openZoom()">
                        
                    <button class="nav-arrow next" onclick="changeSlide(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <div class="thumbnails-container">
                    <div class="thumbnails-wrapper">
                        @foreach($details as $index => $detail)
                        <div class="thumbnail-item">
                            <div class="thumbnail" 
                                onclick="changeMainImage('{{ asset($detail['image']) }}', '{{ $detail['title'] }}', '{{ $detail['description'] }}')"
                                data-index="{{ $index }}">
                                <img src="{{ asset($detail['image']) }}" 
                                    alt="{{ $detail['title'] }}" 
                                    class="{{ $index === 0 ? 'active' : '' }}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

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
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="preparation-time">
                                <small class="text-muted">
                                    <i class="far fa-clock me-2"></i>
                                    Temps de préparation: {{ $dish['preparation_time'] }}
                                </small>
                            </div>
                            <button class="btn btn-primary" 
                                    wire:click="addToCart(@js($dish['title']), @js($dish['price']))"
                                    wire:loading.attr="disabled">
                                Ajouter au panier
                            </button>
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

        <div class="cart-panel {{ $showCart ? 'active' : '' }}">
            <div class="cart-header">
                <h5>Votre Panier</h5>
                <button type="button" class="btn-close" wire:click="toggleCart"></button>
            </div>
            
            <div class="cart-body">
                @if(empty($cart))
                    <p class="text-center text-muted">Votre panier est vide</p>
                @else
                    @foreach($cart as $index => $item)
                    <div class="cart-item">
                        <div class="d-flex justify-content-between">
                            <h6>{{ $item['dish_name'] }}</h6>
                            <div class="quantity-controls">
                                <button class="form-control" wire:click="updateQuantity({{ $index }}, -1)">-</button>
                                <span>{{ $item['quantity'] }}</span>
                                <button class="form-control" wire:click="updateQuantity({{ $index }}, 1)">+</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ number_format($item['price'] * $item['quantity']) }} FCFA</span>
                            <button class="btn btn-sm btn-danger" wire:click="removeFromCart({{ $index }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="cart-total">
                        <strong>Total: {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity'])) }} FCFA</strong>
                    </div>
                    
                    <div class="cart-actions">
                        <button class="btn btn-danger" wire:click="clearCart">Vider le panier</button>
                        <button class="btn btn-primary" wire:click="$set('showCommandForm', true)">Commander</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="command-form {{ $showCommandForm ? 'active' : '' }}">
            <div class="command-header">
                <h5>Finaliser votre commande</h5>
                <button type="button" class="btn-close" wire:click="$set('showCommandForm', false)"></button>
            </div>
            
            <div class="command-body">
                <form wire:submit.prevent="placeCommand">
                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" class="form-control" wire:model="commandForm.customer_name">
                        @error('commandForm.customer_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" wire:model="commandForm.phone">
                        @error('commandForm.phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email (optionnel)</label>
                        <input type="email" class="form-control" wire:model="commandForm.email">
                        @error('commandForm.email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="commandForm.needs_delivery" id="needsDelivery">
                            <label class="form-check-label" for="needsDelivery">
                                Je souhaite être livré(e) (Frais de livraison : 1000 FCFA)
                            </label>
                        </div>
                    </div>

                    @if($commandForm['needs_delivery'])
                        <div class="mb-3">
                            <label class="form-label">Adresse de livraison</label>
                            <textarea class="form-control" wire:model="commandForm.delivery_address"></textarea>
                            @error('commandForm.delivery_address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Notes (optionnel)</label>
                        <textarea class="form-control" wire:model="commandForm.notes"></textarea>
                    </div>

                    <div class="order-summary mb-4">
                        <h6 class="mb-3">Récapitulatif de la commande</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total:</span>
                            <span>{{ number_format($this->getSubtotal()) }} FCFA</span>
                        </div>
                        @if($commandForm['needs_delivery'])
                            <div class="d-flex justify-content-between mb-2">
                                <span>Frais de livraison:</span>
                                <span>{{ number_format($this->deliveryFee) }} FCFA</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span>{{ number_format($this->getTotal()) }} FCFA</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Confirmer la commande</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function changeMainImage(imageSrc, title, description) {
            const mainImage = document.getElementById('mainDisplayImage');
            const mainTitle = document.getElementById('mainImageTitle');
            const mainDescription = document.getElementById('mainImageDescription');
            const zoomedImage = document.getElementById('zoomedImage');
            
            mainImage.src = imageSrc;
            zoomedImage.src = imageSrc;
            mainTitle.textContent = title;
            mainDescription.textContent = description;
            
            document.querySelectorAll('.thumbnail img').forEach(img => {
                img.classList.remove('active');
            });
            event.currentTarget.querySelector('img').classList.add('active');
        }

        function openZoom() {
            const modal = document.getElementById('imageZoomModal');
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeZoom() {
            const modal = document.getElementById('imageZoomModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Ajout de l'événement de clic sur l'image principale
        document.getElementById('mainDisplayImage').addEventListener('click', openZoom);

        function changeSlide(direction) {
            const thumbnails = document.querySelectorAll('.thumbnail');
            const currentImage = document.getElementById('mainDisplayImage');
            let currentIndex = 0;
            
            // Trouver l'index de l'image actuelle
            thumbnails.forEach((thumb, index) => {
                if (thumb.querySelector('img').classList.contains('active')) {
                    currentIndex = index;
                }
            });
            
            // Calculer le nouvel index
            let newIndex = currentIndex + direction;
            if (newIndex >= thumbnails.length) newIndex = 0;
            if (newIndex < 0) newIndex = thumbnails.length - 1;
            
            // Simuler le clic sur la nouvelle miniature
            const newThumbnail = thumbnails[newIndex];
            const clickEvent = new Event('click');
            newThumbnail.dispatchEvent(clickEvent);
            
            // Mettre à jour la classe active
            document.querySelectorAll('.thumbnail img').forEach(img => {
                img.classList.remove('active');
            });
            newThumbnail.querySelector('img').classList.add('active');
        }
    </script>

    
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

        .gallery-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .main-image-container {
            position: relative;
            height: 500px;
            overflow: hidden;
            border-radius: 10px;
            cursor: zoom-in;
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            transition: transform 0.3s ease;
        }

        .thumbnails-container {
            padding: 1rem 0;
            margin-top: 1rem;
            border-top: 1px solid #eee;
        }

        .thumbnails-wrapper {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
            scrollbar-width: thin;
            scrollbar-color: #007bff #f0f0f0;
        }

        .thumbnails-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .thumbnails-wrapper::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        .thumbnails-wrapper::-webkit-scrollbar-thumb {
            background: #007bff;
            border-radius: 10px;
        }

        .thumbnail-item {
            flex: 0 0 auto;
        }

        .thumbnail {
            cursor: pointer;
            border-radius: 8px;
            overflow: hidden;
            height: 70px;
            width: 70px;
            transition: transform 0.2s ease;
            border: 2px solid transparent;
        }

        .thumbnail:hover {
            transform: translateY(-2px);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .thumbnail img.active {
            opacity: 1;
            border: none;
            box-shadow: 0 0 0 2px #007bff;
        }

        .thumbnail:hover img {
            opacity: 1;
        }

        .title {
            color: #2c3e50;
            margin: 0;
        }

        .description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Styles pour la modal de zoom */
        .zoom-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            cursor: zoom-out;
        }

        .zoom-modal img {
            max-width: 90%;
            max-height: 90vh;
            margin: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            object-fit: contain;
        }

        .cart-counter {
            cursor: pointer;
            position: relative;
            padding: 10px;
        }

        .cart-counter i {
            font-size: 24px;
            color: #333;
        }

        .cart-counter .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 12px;
            padding: 4px 8px;
        }

        .cart-panel {
            position: fixed;
            right: -500px;
            top: 0;
            width: 500px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1000;
        }

        .cart-panel.active {
            right: 0;
        }

        .cart-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-body {
            padding: 1rem;
            overflow-y: auto;
            height: calc(100vh - 60px);
        }

        .cart-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .quantity-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .cart-total {
            margin-top: 1rem;
            padding: 1rem;
            border-top: 1px solid #eee;
        }

        .cart-actions {
            display: flex;
            gap: 10px;
            margin-top: 1rem;
        }

        .cart-counter {
        cursor: pointer;
        position: relative;
        padding: 10px;
        }

        .cart-counter .badge {
            position: absolute;
            top: 0;
            right: 0;
        }

        .cart-panel {
            position: fixed;
            right: -500px;
            top: 0;
            width: 500px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1000;
        }

        .cart-panel.active {
            right: 0;
        }

        .cart-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-body {
            padding: 1rem;
            overflow-y: auto;
            height: calc(100vh - 60px);
        }

        .cart-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .quantity-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .cart-total {
            margin-top: 1rem;
            padding: 1rem;
            border-top: 1px solid #eee;
        }

        .cart-actions {
            display: flex;
            gap: 10px;
            margin-top: 1rem;
        }

        .command-form {
            position: fixed;
            right: -500px;
            top: 0;
            width: 500px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1001;
            padding: 1rem;
        }

        .command-form.active {
            right: 0;
        }

        .command-header {
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .command-body {
            overflow-y: auto;
            height: calc(100vh - 80px);
            padding-right: 1rem;
        }

        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .nav-arrow:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .nav-arrow.prev {
            left: 20px;
        }

        .nav-arrow.next {
            right: 20px;
        }

        .nav-arrow i {
            font-size: 18px;
        }

        .order-summary {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .order-summary .d-flex {
            margin-bottom: 0.5rem;
        }

        .order-summary .fw-bold {
            padding-top: 0.5rem;
            border-top: 1px solid #dee2e6;
            margin-top: 0.5rem;
        }
    </style>
</div>


