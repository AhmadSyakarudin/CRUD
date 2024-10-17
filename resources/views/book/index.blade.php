@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-danger"> {{ Session::get('deleted') }} </div>
    @endif
    <table class="table table-stripped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($books as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->year }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('book.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <form action="{{ route('book.destroy', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
