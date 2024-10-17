@extends('layouts.template')

@section('content')
    <form action="{{ route('book.update', $book['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama Buku :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $book['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="type" class="col-sm-2 col-form-label">Jenis Buku :</label>
            <div class="col-sm-10">
                <select class="form-select" name="type" id="type">
                    <option selected disabled hidden>Pilih Jenis Buku</option>
                    <option value="komik" {{ $book['type'] == 'komik' ? 'selected' : '' }}>Komik</option>
                    <option value="novel" {{ $book['type'] == 'novel' ? 'selected' : '' }}>Novel</option>
                    <option value="majalah" {{ $book['type'] == 'majalah' ? 'selected' : '' }}>Majalah</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="author" class="col-sm-2 col-form-label">Penulis :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="author" name="author" value="{{ $book['author'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="year" class="col-sm-2 col-form-label">Tahun :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="year" name="year" value="{{ $book['year'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection
