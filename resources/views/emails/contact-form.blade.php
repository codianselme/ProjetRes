<div>
    <h1>Nouveau message de contact</h1>
    <p><strong>Nom :</strong> {{ $contact->name }}</p>
    <p><strong>Email :</strong> {{ $contact->email }}</p>
    <p><strong>Téléphone :</strong> {{ $contact->phone }}</p>
    {{-- <p><strong>Site web :</strong> {{ $contact->website }}</p> --}}
    <p><strong>Message :</strong></p>
    <p>{{ $contact->message }}</p>
</div>