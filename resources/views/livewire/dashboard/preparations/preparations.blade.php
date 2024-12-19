<div>
    <br><br><br><br>
    <h2>Préparer une Commande</h2>
    <form wire:submit.prevent="prepareOrder">
        <select wire:model="order_id">
            <option value="">Sélectionner une commande</option>
            @foreach($orders as $order)
                <option value="{{ $order->id }}">{{ $order->dish->name }} - {{ $order->quantity }}</option>
            @endforeach
        </select>
        <input type="number" wire:model="quantity_used" placeholder="Quantité utilisée" min="1">
        <input type="text" wire:model="ingredients" placeholder="Ingrédients utilisés">
        <button type="submit">Préparer Commande</button>
    </form>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>
