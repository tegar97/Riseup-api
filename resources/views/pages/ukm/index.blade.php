@extends('layouts.default')
@section('title', 'Data UKM')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="content">
        <div class="mt-5">
            <a href={{ route('ukms.create') }} class="btn btn-primary-green mb-3">Tambah UKM</a>
            <h1></h1>
            <table id="table" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama UKM</th>
                        <th>Deskripsi</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ukms as $ukm)
                        <tr>
                            <td>{{ $ukm->name }}</td>
                            <td>{{ $ukm->description }}</td>
                            <td>{{ $ukm->email }}</td>
                            <td>{{ $ukm->wa }}</td>
                            <td>{{ $ukm->status }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('ukms.edit', $ukm) }}" class="btn btn-green text-white">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('ukms.destroy', $ukm) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
