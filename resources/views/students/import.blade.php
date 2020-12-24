@extends('layouts.backend')

@section('content')
    @header(['title'=>'Importeer studenten'])

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Importeren</h3>
            </div>
            <div class="block-content">

                <form class="form-horizontal push-10-t push-10" action="/students/import" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">

                            @fieldh(['name'=>'name', 'label'=>'Naam', 'size'=>'1', 'required'=>'required'])
                            @fieldh(['name'=>'schedule_code', 'label'=>'Roostergroep', 'size'=>'2', 'required'=>'required'])

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Opslaan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->

@endsection