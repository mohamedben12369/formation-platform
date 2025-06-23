@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Statistiques des Thèmes de Formation</h1>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total des Formations</h5>
                    <p class="card-text display-4">{{ $total_formations }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total des Thèmes</h5>
                    <p class="card-text display-4">{{ $total_themes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Thèmes sans Formation</h5>
                    <p class="card-text display-4">{{ $themes_sans_formation }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>Détail des Thèmes</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thème</th>
                            <th>Nombre de Formations</th>
                            <th>Pourcentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statistiques as $stat)
                        <tr>
                            <td>{{ $stat->idtheme }}</td>
                            <td>{{ $stat->titre }}</td>
                            <td>{{ $stat->formations_count }}</td>
                            <td>
                                @if($total_formations > 0)
                                    {{ number_format(($stat->formations_count / $total_formations) * 100, 1) }}%
                                @else
                                    0%
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
@endsection 