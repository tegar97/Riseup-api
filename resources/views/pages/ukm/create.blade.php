@extends('layouts.default')
@section('title', 'Create Category')

@section('content')
 @if (session()->has('errors'))
        <div class="alert alert-success">
            {{ session()->get('errors') }}
        </div>
    @endif
    <div class="content bg-white p-2 px-4">
        <div class=" mt-5">
            <form enctype="multipart/form-data" action="{{ route('ukms.store') }}" method="post">

                @csrf
                <div class="form-group mb-5">
                    <label for="name" class="mb-2">Nama UKM</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama UKM">
                </div>

                <div class="form-group mb-5">
                    <label for="description" class="mb-2">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Deskripsi UKM"></textarea>
                </div>

                <div class="form-group mb-5">
                    <label for="email" class="mb-2">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email UKM">
                </div>

                <div class="form-group mb-5">
                    <label for="wa" class="mb-2">WhatsApp</label>
                    <input type="text" class="form-control" name="wa" id="wa"
                        placeholder="Nomor WhatsApp UKM">
                </div>

                <div class="form-group mb-5">
                    <label for="proposal_url" class="mb-2">URL Proposal</label>
                    <input type="text" class="form-control" name="proposal_url" id="proposal_url"
                        placeholder="URL Proposal UKM">
                </div>

                <div class="form-group mb-5">
                    <label for="pitch_deck_url" class="mb-2">URL Pitch Deck</label>
                    <input type="text" class="form-control" name="pitch_deck_url" id="pitch_deck_url"
                        placeholder="URL Pitch Deck UKM">
                </div>

                <div class="form-group mb-5">
                    <label for="category_id" class="mb-2">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-5">
                    <label for="status" class="mb-2">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1">Diterima</option>
                        <option value="0">Ditolak</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary-green">Submit</button>
            </form>
        </div>

    </div>
    </div>
@stop
