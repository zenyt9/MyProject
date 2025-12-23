@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Шинэ оюутан нэмэх</h4>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-stats">
                <div class="card-body">
                    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Нэр</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Жишээ: Төгс" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastname" class="form-label">Овог</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Жишээ: Бат" required>
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">Төрсөн огноо</label>
                            <input type="date" name="birthday" class="form-control" id="birthday" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Хүйс</label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="">Сонгох</option>
                                <option value="Эрэгтэй">Эрэгтэй</option>
                                <option value="Эмэгтэй">Эмэгтэй</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="angi_id" class="form-label">Анги</label>
                            <select name="angi_id" class="form-control" id="angi_id" required>
                                <option value="">Сонгох</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Утас</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="8690XXXX">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Зураг</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus"></i> Нэмэх
                        </button>
                        <a href="{{ route('student.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Буцах
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
