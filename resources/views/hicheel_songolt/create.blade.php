@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Шинэ хичээлийн сонголт</h4>

    <form action="{{ route('hicheel_songolt.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Оюутан</label>
            <select name="student_id" class="form-control @error('student_id') is-invalid @enderror" id="student_id" required>
                <option value="">Сонгоно уу</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->firstname }} {{ $student->lastname }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Хичээл</label>
            <select name="subject_id" class="form-control @error('subject_id') is-invalid @enderror" id="subject_id" required>
                <option value="">Сонгоно уу</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
            @error('subject_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Нэмэх</button>
        <a href="{{ route('hicheel_songolt.index') }}" class="btn btn-secondary">Буцах</a>
    </form>
</div>
@endsection
