@extends('layouts.default')
@section('title','Update Category')

@section('content')

<div class="content bg-white p-2 px-4">
    <div class="mt-5">
        <form enctype="multipart/form-data" action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group mb-5">
                <label for="name" class="mb-2">Category</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Category" value="{{ $category->name }}">
            </div>
            <button type="submit" class="btn btn-primary-green">Update</button>
        </form>
    </div>
</div>
@stop
