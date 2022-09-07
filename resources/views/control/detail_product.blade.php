@extends('layouts.app')
@section('content')
<livewire:detail-product :post="$refere" />
@stop
@push('scripts')
<script>
window.addEventListener('console', event => {
    console.log(event.detail.value);
    console.log(event.detail.others);
});

window.addEventListener('open_dialog_delete', event => {
    $('#delete_parts').modal('show');
});

window.addEventListener('hide_dialog_delete', event => {
    $('#delete_parts').modal('hide');
});
function throw_delete(uid) {
    window.livewire.emit('delete_throw', {data: uid});
    axios.post("{{route('data_parts')}}", {
            id: uid
        })
        .then(function(response) {
            document.getElementById("part_delete").innerHTML = response.data[0].part_name;
        });
}
</script>
@endpush