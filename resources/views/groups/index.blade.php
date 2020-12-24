@extends('layouts.backend')

@section('content')
    @header(['title'=>'Groepen'])

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block">
            {{--
            <div class="block-header">
                <h3 class="block-title"></h3>
            </div>
            --}}
            <div class="block-content">
                <table class="table table-bordered table-vcenter table-sm table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="">ID</th>
                            <th class="">NAME</th>
                            <th class="">ROOSTER</th>
                            <th class="" style="width: 15%;">Favoriet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                        <tr id="{{ $group->id }}">
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->schedule_code }}</td>
                            <td>
                                <div class="custom-control custom-switch mb-1">
                                    <input type="checkbox" class="custom-control-input" id="fav{{ $group->id }}" name="fav{{ $group->id }}" {{ ($group->fav?'checked':'') }}>
                                    <label class="custom-control-label" for="fav{{ $group->id }}"></label>
                                </div>
                            </td>
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

@section('js_after')
<script>
    $(document).ready(function(){
        $("input:checkbox").change(function() {
            var group_id = $(this).closest('tr').attr('id');
            console.log('Store changed fav value using AJAX call.');

            $.ajax({
                type:'POST',
                url:'/groups/favorite',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { "group_id" : group_id },
                success: function(data){
                    if(data.data.success){
                        //do something
                        console.log(data);
                    }
                }
            });
        });
    });
</script>

@endsection