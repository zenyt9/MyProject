@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Багш нар</h4>

    <a href="{{ route('teacher.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus"></i> Багш нэмэх
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
                                <th>Имэйл</th>
                                <th>Утас</th>
                                <th>Засах</th>
                                <th>Устгах</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $index => $teacher)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email ?? '-' }}</td>
                                <td>{{ $teacher->phone ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Засах
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" style="display:inline;">
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
                                <td colspan="6" class="text-center">Багш байхгүй байна.</td>
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
