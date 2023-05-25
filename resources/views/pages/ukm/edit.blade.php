@extends('layouts.default')
@section('title', 'Update UKM')

@section('content')
@if (session()->has('errors'))
<div class="alert alert-success">
    {{ session()->get('errors') }}
</div>
@endif
<div class="content bg-white p-2 px-4">
    <div class="mt-5">
        <form enctype="multipart/form-data" action="{{ route('ukms.update', $ukm) }}" method="post">

            @csrf
            @method('PUT')

            <div class="form-group mb-5">
                <label for="name" class="mb-2">Nama UKM</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama UKM" value="{{ $ukm->name }}">
            </div>

            <div class="form-group mb-5">
                <label for="description" class="mb-2">Deskripsi</label>
                <textarea class="form-control" name="description" id="description" placeholder="Deskripsi UKM">{{ $ukm->description }}</textarea>
            </div>

            <div class="form-group mb-5">
                <label for="email" class="mb-2">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email UKM" value="{{ $ukm->email }}">
            </div>

            <div class="form-group mb-5">
                <label for="wa" class="mb-2">WhatsApp</label>
                <input type="text" class="form-control" name="wa" id="wa" placeholder="Nomor WhatsApp UKM" value="{{ $ukm->wa }}">
            </div>

            <div class="form-group mb-5">
                <label for="proposal_url" class="mb-2">URL Proposal</label>
                <input type="text" class="form-control" name="proposal_url" id="proposal_url" placeholder="URL Proposal UKM" value="{{ $ukm->proposal_url }}">
            </div>

            <div class="form-group mb-5">
                <label for="pitch_deck_url" class="mb-2">URL Pitch Deck</label>
                <input type="text" class="form-control" name="pitch_deck_url" id="pitch_deck_url" placeholder="URL Pitch Deck UKM" value="{{ $ukm->pitch_deck_url }}">
            </div>

            <div class="form-group mb-5">
                <label for="category_id" class="mb-2">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id === $ukm->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-5">
                <label for="status" class="mb-2">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="1" {{ $ukm->status ? 'selected' : '' }}>Diterima</option>
                    <option value="0" {{ !$ukm->status ? 'selected' : '' }}>Ditolak</option>
                </select>

            </div>
            <button type="submit" class="btn btn-primary-green" >Submit</button>
        </form>
    </div>

</div>
</div>
@stop
