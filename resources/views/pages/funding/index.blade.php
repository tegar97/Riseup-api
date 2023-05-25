@extends('layouts.default')
@section('title', 'Data Fundings')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="content">
        <div class="mt-5">
            <a href={{ route('funding.create') }} class="btn btn-primary-green mb-3">Tambah Funding</a>
            <h1></h1>
            <table id="table" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                                                <th>Image</th>

                        <th>Title</th>
                        <th>Fund Raise Use</th>
                        <th>UKM</th>
                        <th>Target Amount</th>
                        <th>Current Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fundings as $funding)
                        <tr>
                               <td><img src="{{ env('OSS_DOMAIN_PUBLIC') }}/images/{{ $funding->image }}" alt="image articles "
                                    width="70" height="70" />
                            <td>{{ $funding->title }}</td>
                            <td>{{ $funding->fund_raise_use }}</td>
                            <td>{{ $funding->ukm->name }}</td>

                            <td>{{ $funding->target_amount }}</td>
                            <td>{{ $funding->current_amount }}</td>
                            <td>{{ $funding->status ? 'Diterima' : 'Ditolak' }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('funding.edit', $funding) }}" class="btn btn-green text-white">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('funding.destroy', $funding) }}" method="POST">
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
