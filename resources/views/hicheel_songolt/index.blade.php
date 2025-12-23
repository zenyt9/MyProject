@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Хичээлийн сонголтууд</h4>

    <a href="{{ route('hicheel_songolt.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus"></i> Шинэ сонголт
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Оюутан</th>
                    <th>Хичээл</th>
                    <th>Үүсгэсэн</th>
                    <th class="text-center">Үйлдэл</th>
                </tr>
            </thead>
            <tbody>
                @forelse($selections as $index => $selection)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $selection->student->firstname ?? '-' }} {{ $selection->student->lastname ?? '' }}</td>
                        <td>{{ $selection->subject->name ?? '-' }}</td>
                        <td>{{ optional($selection->created_at)->format('Y-m-d') ?? '-' }}</td>
                        <td class="text-center">
                            <form action="{{ route('hicheel_songolt.destroy', $selection) }}" method="POST"
                                  style="display:inline;" onsubmit="return confirm('Та энэ сонголтыг устгахдаа итгэлтэй байна уу?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Сонголт байхгүй байна</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
