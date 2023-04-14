@extends('layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="bg-white rounded shadow">
            <div class="px-6 pt-6 border-bottom border-secondary-light">
                <div class="d-flex mb-6 align-items-center justify-content-between">
                    <h4 class="mb-0">Recent games</h4>
                    <a class="btn btn-sm btn-primary d-inline-flex align-items-center" href="{{ route('game') }}">
                        <span>New game</span>
                    </a>
                </div>
            </div>
            <div class="pt-4 table-responsive">
                <table class="table mb-0 table-borderless table-striped small">
                    <thead>
                    <tr>
                        <th class="py-4 px-6">
                            <a class="btn text-secondary p-0 d-inline-flex align-items-center" href="#">
                                <span class="me-2">Date</span>
                            </a>
                        </th>
                        <th class="py-4 px-6">
                            <a class="btn text-secondary p-0 d-inline-flex align-items-center" href="#">
                                <span class="me-2">Description</span>
                            </a>
                        </th>
                        <th class="py-4 px-6">
                            <a class="btn text-secondary p-0 d-inline-flex align-items-center" href="#">
                                <span class="me-2">Status</span>
                            </a>
                        </th>
                        <th class="py-4 px-6">
                            <a class="btn text-secondary p-0 d-inline-flex align-items-center" href="#">
                                <span class="me-2">Descriptions</span>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="py-5 px-6">08.04.2021</td>
                        <td class="py-5 px-6">Code 5928MD01</td>
                        <td class="py-5 px-6">
                            <span class="badge bg-success">Completed</span>
                        </td>
                        <td class="py-5 px-6">$2500.00</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
