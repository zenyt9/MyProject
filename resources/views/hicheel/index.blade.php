@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Хичээлүүд</h4>

    <a href="{{ route('hicheel.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus"></i> Хичээл нэмэх
    </a>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Нэр</th>
                                <th>Засах</th>
                                <th>Устгах</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hicheeluud as $index => $hicheel)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $hicheel->name }}</td>
                                <td>
                                    <a href="{{ route('hicheel.edit', $hicheel->id) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil"></i> Засах
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('hicheel.destroy', $hicheel->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Устгах
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($hicheeluud->isEmpty())
                        <p class="text-center mt-3">Хичээл байхгүй байна.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
