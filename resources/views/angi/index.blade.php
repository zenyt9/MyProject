@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Ангиуд</h4>

    <a href="{{ route('angi.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus"></i> Анги нэмэх
    </a>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                    <table class="table mt-3 table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Ангины нэр</th>
                                <th>Тайлбар</th>
                                <th>Засах</th>
                                <th>Устгах</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classes as $index => $class)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->tailbar ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('angi.edit', $class->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Засах
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('angi.destroy', $class->id) }}" method="POST" style="display:inline;">
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
                                <td colspan="5" class="text-center">Анги байхгүй байна.</td>
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
