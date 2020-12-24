@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Studenten <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        Bekijken, maken, bewerken en verwijderen van studenten</small>
                </h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <!-- Your Block -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Studenten</h3>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-vcenter table-sm table-striped table-hover">
                    <thead class="thead-dark">

                    <tr>
                        <th class="text-center" style="width: 100px;">
                            <i class="far fa-user"></i>
                        </th>
                        <th style="width: 30%;">Naam</th>
                        <th class="">Voortgang</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td class="text-center">
                                <img class="img-avatar img-avatar32" src="{{ $student->avatar_url() }}" alt="">
                            </td>
                            <td><a href="{{ route('students.show', [$student->id]) }}">{{ $student->GetVoornaamTvAchternaam() }}</a></td>
                            <td>{{ $student->schedule_code }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
