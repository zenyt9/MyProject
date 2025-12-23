@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Шинэ багш нэмэх</h4>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-stats">
                <div class="card-body">
                    <form action="{{ route('teacher.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Багшийн нэр</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Жишээ: Жанжин" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Имэйл</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Жишээ: teacher@mail.com">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Утас</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Жишээ: 99001122">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus"></i> Нэмэх
                        </button>
                        <a href="{{ route('teacher.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Буцах
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
