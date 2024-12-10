@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Barcha kontaktlar</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ism</th>
                <th>Telefon</th>
                <th>Fikr</th>
                <th>Amallar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->message }}</td>
                <td>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Tahrirlash</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">O'chirish</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
