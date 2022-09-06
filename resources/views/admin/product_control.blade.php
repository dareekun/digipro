@extends('layouts.app')
@section('content')
<livewire:product-control />
@stop
@push('scripts')
<script>
var table = $('#table_records').DataTable({
    dom: "<'row'<'col-sm-6'i><'col-sm-6'f>>tp",
});

function redraw_table() {
    table.draw();
}

function throw_delete(uid) {
    axios.post("{{route('data_product')}}", {id: uid})
        .then(function(response) {
            document.getElementById("section_delete").innerHTML = response.data[0].section;
            document.getElementById("line_delete").innerHTML = response.data[0].line;
            document.getElementById("model_delete").innerHTML = response.data[0].model_no;
            document.getElementById("packing_delete").innerHTML = response.data[0].packing;
            document.getElementById("time_delete").innerHTML = response.data[0].time;
            document.getElementById("man_delete").innerHTML = response.data[0].std_mp;
        })
    $('#delete_product').modal('show');
    window.livewire.emit('uid_delete', {
        data: uid
    });
}

window.addEventListener('redraw_table', event => {
    redraw_table();
});

window.addEventListener('close_del_modal', event => {
    $('#delete_product').modal('hide')
});
window.addEventListener('close_add_modal', event => {
    $('#add_product').modal('hide')
});
</script>
@endpush