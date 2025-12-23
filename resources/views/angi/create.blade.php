@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Шинэ анги нэмэх</h4>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-stats">
                <div class="card-body">
                    <form action="{{ route('angi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ангийн нэр</label>
                            <input type="text" name="name" class="form-control" id="ner" placeholder="Жишээ: 10a" required>
                        </div>

                        <div class="mb-3">
                            <label for="tailbar" class="form-label">Тайлбар</label>
                            <textarea name="tailbar" class="form-control" id="tailbar" rows="3" placeholder="Ангиын тайлбар"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus"></i> Нэмэх
                        </button>
                        <a href="{{ route('angi.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Буцах
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
s
