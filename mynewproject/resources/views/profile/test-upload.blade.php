@extends('layouts.profhead')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Test Upload d'Images</h5>
                </div>
                <div class="card-body">
                    <!-- Test Form 1: Direct form -->
                    <h6>Test 1: Formulaire direct</h6>
                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="direct_profile_image" class="form-label">Photo de profil (direct)</label>
                            <input type="file" class="form-control" id="direct_profile_image" name="profile_image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Direct</button>
                    </form>

                    <hr class="my-4">

                    <!-- Test Form 2: JavaScript form -->
                    <h6>Test 2: Formulaire avec JavaScript</h6>
                    <form id="jsTestForm">
                        @csrf
                        <div class="mb-3">
                            <label for="js_profile_image" class="form-label">Photo de profil (JS)</label>
                            <input type="file" class="form-control" id="js_profile_image" name="profile_image" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-success" onclick="testJSUpload()">Upload avec JS</button>
                    </form>

                    <hr class="my-4">

                    <!-- Test Form 3: Modal test -->
                    <h6>Test 3: Modal</h6>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#testModal">
                        Ouvrir Modal Test
                    </button>

                    <hr class="my-4">

                    <!-- Test Results -->
                    <div id="testResults" class="mt-3">
                        <h6>Résultats des tests:</h6>
                        <div id="console-output" style="background: #f8f9fa; padding: 10px; border-radius: 5px; font-family: monospace; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Test Modal -->
<div class="modal fade" id="testModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test Modal Upload</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="modalTestForm">
                    @csrf
                    <div class="mb-3">
                        <label for="modal_profile_image" class="form-label">Photo de profil (Modal)</label>
                        <input type="file" class="form-control" id="modal_profile_image" name="profile_image" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="testModalUpload()">Test Upload</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Console logging function
function logToPage(message) {
    const output = document.getElementById('console-output');
    const timestamp = new Date().toLocaleTimeString();
    output.textContent += `[${timestamp}] ${message}\n`;
    console.log(message);
}

document.addEventListener('DOMContentLoaded', function() {
    logToPage('Page chargée - Tests d\'upload disponibles');
    
    // Test file input changes
    document.getElementById('direct_profile_image').addEventListener('change', function() {
        logToPage(`Test 1 - Fichier sélectionné: ${this.files[0] ? this.files[0].name : 'Aucun'}`);
    });
    
    document.getElementById('js_profile_image').addEventListener('change', function() {
        logToPage(`Test 2 - Fichier sélectionné: ${this.files[0] ? this.files[0].name : 'Aucun'}`);
    });
    
    document.getElementById('modal_profile_image').addEventListener('change', function() {
        logToPage(`Test 3 - Fichier sélectionné: ${this.files[0] ? this.files[0].name : 'Aucun'}`);
    });
});

function testJSUpload() {
    const fileInput = document.getElementById('js_profile_image');
    
    if (!fileInput.files || !fileInput.files[0]) {
        logToPage('Test 2 - Erreur: Aucun fichier sélectionné');
        alert('Veuillez sélectionner un fichier');
        return;
    }
    
    logToPage(`Test 2 - Début upload de: ${fileInput.files[0].name}`);
    
    const formData = new FormData();
    formData.append('profile_image', fileInput.files[0]);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    fetch('{{ route("profile.update.photo") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        logToPage(`Test 2 - Réponse reçue: ${response.status}`);
        return response.json();
    })
    .then(data => {
        logToPage(`Test 2 - Données: ${JSON.stringify(data)}`);
        if (data.success) {
            alert('Upload réussi!');
        } else {
            alert('Erreur: ' + (data.message || 'Inconnue'));
        }
    })
    .catch(error => {
        logToPage(`Test 2 - Erreur: ${error.message}`);
        alert('Erreur: ' + error.message);
    });
}

function testModalUpload() {
    const fileInput = document.getElementById('modal_profile_image');
    
    if (!fileInput.files || !fileInput.files[0]) {
        logToPage('Test 3 - Erreur: Aucun fichier sélectionné dans le modal');
        alert('Veuillez sélectionner un fichier');
        return;
    }
    
    logToPage(`Test 3 - Fichier du modal: ${fileInput.files[0].name}`);
    alert(`Modal: Fichier sélectionné - ${fileInput.files[0].name}`);
}

// Test si les inputs peuvent être cliqués
function testInputClick() {
    logToPage('Test du clic sur input...');
    const input = document.getElementById('modal_profile_image');
    if (input) {
        input.click();
        logToPage('Input cliqué avec succès');
    } else {
        logToPage('Erreur: Input non trouvé');
    }
}
</script>
@endpush
