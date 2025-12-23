@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Хичээл нэмэх</h4>

    <form action="{{ route('hicheel.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Хичээлийн нэр</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <button type="submit" class="btn btn-success">Нэмэх</button>
        <a href="{{ route('hicheel.index') }}" class="btn btn-secondary">Буцах</a>
    </form>
</div>
@endsection
