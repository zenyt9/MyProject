@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Оюутнууд</h4>

    <a href="{{ route('student.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus"></i> Оюутан нэмэх
    </a>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                    <table class="table mt-3 table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Нэр</th>
                                <th>Овог</th>
                                <th>Анги</th>
                                <th>Төрсөн огноо</th>
                                <th>Хүйс</th>
                                <th>Утас</th>
                                <th>Email</th>
                                <th>Засах</th>
                                <th>Устгах</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->firstname }}</td>
                                    <td>{{ $student->lastname }}</td>
                                    <td>{{ $student->angi->name ?? '-' }}</td>
                                    <td>{{ $student->birthday }}</td>
                                    <td>{{ $student->gender ?? '-' }}</td>
                                    <td>{{ $student->phone ?? '-' }}</td>
                                    <td>{{ $student->email ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Засах
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Устгах
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Оюутан байхгүй байна.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
s
