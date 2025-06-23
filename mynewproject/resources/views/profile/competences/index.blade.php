@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Competences</h1>
    <a href="{{ route('competences.create') }}" class="btn btn-primary mb-3">Add Competence</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($competences->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Competence Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($competences as $competence)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $competence->name }}</td>
                    <td>{{ $competence->description }}</td>
                    <td>
                        <a href="{{ route('competences.edit', $competence->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('competences.destroy', $competence->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $competences->links() }}
    @else
        <p>No competences found.</p>
    @endif
</div>
@endsection