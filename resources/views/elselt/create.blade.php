@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Шинэ элсэлт нэмэх</h4>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-stats">
                <div class="card-body">
                    <form action="{{ route('elselt.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Нэр</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Нэр" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastname" class="form-label">Овог</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Овог" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">И-мэйл</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Утас</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="86901234">
                        </div>

                        <div class="mb-3">
                            <label for="school_class_id" class="form-label">Анги</label>
                            <select name="school_class_id" class="form-control" id="school_class_id" required>
                                <option value="">-- Сонгоно уу --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subject_id" class="form-label">Хичээл</label>
                            <select name="subject_id" class="form-control" id="subject_id" required>
                                <option value="">-- Сонгоно уу --</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Семестер</label>
                            <input type="text" name="semester" class="form-control" id="semester" placeholder="Жишээ: 1-р семестер" required>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Жил</label>
                            <input type="number" name="year" class="form-control" id="year" placeholder="Жишээ: 2025" required>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus"></i> Элсүүлэх
                        </button>
                        <a href="{{ route('elselt.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Буцах
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
