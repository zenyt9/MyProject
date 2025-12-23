@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="page-title mb-0">
            <i class="bi bi-list-ul"></i> Элсэлтүүд
        </h4>
        <a href="{{ route('elselt.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Элсэлт нэмэх
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-stats shadow-sm">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Оюутан</th>
                                    <th>Анги</th>
                                    <th>Хичээл</th>
                                    <th style="width: 100px;">Семестер</th>
                                    <th style="width: 100px;">Жил</th>
                                    <th style="width: 100px;" class="text-center">Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enrollments as $index => $enroll)
                                    <tr>
                                        <td class="text-center">{{ $enrollments->firstItem() + $index }}</td>
                                        <td>
                                            <i class="bi bi-person-circle"></i>
                                            {{ $enroll->firstname }} {{ $enroll->lastname }}
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $enroll->schoolClass->name ?? 'Тодорхойгүй' }}</span>
                                        </td>
                                        <td>{{ $enroll->subject->name ?? 'Тодорхойгүй' }}</td>
                                        <td class="text-center">{{ $enroll->semester }}</td>
                                        <td class="text-center">{{ $enroll->year }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('elselt.destroy', $enroll) }}" method="POST" style="display:inline;" onsubmit="return confirm('Та энэ элсэлтийг устгахдаа итгэлтэй байна уу?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Устгах">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                            <p class="mb-0 mt-2">Элсэлт байхгүй байна.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($enrollments->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $enrollments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
