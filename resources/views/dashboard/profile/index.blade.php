@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profil Saya</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="fw-bold" style="width: 150px;">Nama</td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Email</td>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Role</td>
                            <td>
                                <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : (auth()->user()->role === 'guru' ? 'primary' : 'success') }} rounded-pill text-capitalize">
                                    {{ auth()->user()->role }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Bergabung</td>
                            <td>{{ auth()->user()->created_at->translatedFormat('d F Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
