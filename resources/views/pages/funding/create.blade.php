@extends('layouts.default')
@section('title', 'Create Funding')

@section('content')
    @if (session()->has('errors'))
        <div class="alert alert-success">
            {{ session()->get('errors') }}
        </div>
    @endif
    <div class="content bg-white p-2 px-4">
        <div class=" mt-5">
            <form enctype="multipart/form-data" action="{{ route('funding.store') }}" method="post">

                @csrf
                <div class="form-group mb-5">
                    <label for="title" class="mb-2">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                </div>

                <div class="form-group mb-5">
                    <label for="fund_raise_use" class="mb-2">Fund Raise Use</label>
                    <textarea class="form-control" name="fund_raise_use" id="fund_raise_use" placeholder="Fund Raise Use"></textarea>
                </div>

                <div class="form-group mb-5">
                    <label for="ukm_id" class="mb-2">UKM</label>
                    <select class="form-control" name="ukm_id" id="ukm_id">
                        @foreach ($ukms as $ukm)
                            <option value="{{ $ukm->id }}">{{ $ukm->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-5">
                    <label for="image" class="mb-2">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <div class="form-group mb-5">
                    <label for="target_amount" class="mb-2">Target Amount</label>
                    <input type="text" class="form-control" name="target_amount" id="target_amount" placeholder="Target Amount">
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
