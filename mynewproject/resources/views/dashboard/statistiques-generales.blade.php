@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Statistiques Générales du Dashboard</h1>

    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Formations</h5>
                    <p class="card-text display-4">{{ $formationsCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Thèmes de Formation</h5>
                    <p class="card-text display-4">{{ $themeFormationsCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Établissements</h5>
                    <p class="card-text display-4">{{ $etablissementsCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-dark bg-light">
                <div class="card-body">
                    <h5 class="card-title">Types de Diplômes</h5>
                    <p class="card-text display-4">{{ $typeDiplomesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-dark bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Axes</h5>
                    <p class="card-text display-4">{{ $axesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">Domaines</h5>
                    <p class="card-text display-4">{{ $domainesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Sous-Domaines</h5>
                    <p class="card-text display-4">{{ $sousDomainesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- You can add more detailed statistics, charts, etc. here later --}}
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .display-4 {
        font-size: 2.5rem;
        font-weight: bold;
    }
</style>
@endpush