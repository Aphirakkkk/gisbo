@extends('layouts.backend.sidenavdashboard-backend')
@section('css')
<style>
    .stat-card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.4rem;
    }
</style>
@endsection
@section('content')

<div class="card cardboby" style="margin-top: 5rem;">
    <div class="card-body">
        <div class="row">
            {{-- Banner --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-primary text-white shadow">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs text-uppercase font-weight-bold opacity-8">แบนเนอร์ (Banner)</div>
                                <div class="h2 font-weight-bold mb-0 text-white">{{ $countBanner ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="stat-icon bg-white text-primary">
                                    <i class="fas fa-image"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- News & Events --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-info text-white shadow">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs text-uppercase font-weight-bold opacity-8">ข่าวสารและกิจกรรม</div>
                                <div class="h2 font-weight-bold mb-0 text-white">{{ $countNews ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="stat-icon bg-white text-info">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Projects Reference --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-success text-white shadow">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs text-uppercase font-weight-bold opacity-8">โครงการอ้างอิง</div>
                                <div class="h2 font-weight-bold mb-0 text-white">{{ $countProjects ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="stat-icon bg-white text-success">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Products & Services --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-warning text-white shadow">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs text-uppercase font-weight-bold opacity-8">สินค้าและบริการ</div>
                                <div class="h2 font-weight-bold mb-0 text-white">{{ $countProducts ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="stat-icon bg-white text-warning">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Careers --}}
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-danger text-white shadow">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs text-uppercase font-weight-bold opacity-8">ตำแหน่งงานที่เปิดรับ</div>
                                <div class="h2 font-weight-bold mb-0 text-white">{{ $countCareers ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="stat-icon bg-white text-danger">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Us Messages --}}
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-default text-white shadow">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs text-uppercase font-weight-bold opacity-8">ข้อความติดต่อกลับ</div>
                                <div class="h2 font-weight-bold mb-0 text-white">{{ $countContacts ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="stat-icon bg-white text-dark">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Users --}}
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-secondary shadow">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs text-uppercase font-weight-bold text-muted">ผู้ดูแลระบบทั้งหมด</div>
                                <div class="h2 font-weight-bold mb-0 text-dark">{{ $countUsers ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="stat-icon bg-dark text-white">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tables Row --}}
        <div class="row mt-3">
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-newspaper text-info mr-2"></i> ข่าวสารและกิจกรรมล่าสุด</h4>
                        <a href="{{ route('neweventsmain.index') }}" class="btn btn-sm btn-outline-info">ดูทั้งหมด</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>หัวข้อ</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentNews ?? [] as $news)
                                <tr>
                                    <td>{{ Str::limit($news->tilte_th ?? $news->tilte_en ?? 'ไม่มีหัวข้อ', 40) }}</td>
                                    <td><small class="text-muted">{{ $news->created_at ? $news->created_at->format('d/m/Y') : '-' }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted py-3">ยังไม่มีข้อมูลข่าวสาร</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-envelope text-primary mr-2"></i> ข้อความติดต่อล่าสุด</h4>
                        <a href="{{ route('contact.index') }}" class="btn btn-sm btn-outline-primary">ดูทั้งหมด</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>ผู้ติดต่อ</th>
                                    <th>เบอร์โทร / อีเมล</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentContacts ?? [] as $contact)
                                <tr>
                                    <td><b>{{ $contact->full_name ?? $contact->name ?? '-' }}</b></td>
                                    <td><small>{{ $contact->telephone ?? $contact->email ?? '-' }}</small></td>
                                    <td><small class="text-muted">{{ $contact->created_at ? $contact->created_at->format('d/m/Y') : '-' }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">ยังไม่มีข้อความติดต่อ</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')

@endsection
