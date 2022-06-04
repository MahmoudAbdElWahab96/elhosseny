
<tr id="screen-{{$screens->id}}">
    <td>{{$screens->name_en}}</td>
    <td>{{$screens->name_ar}}</td>
    <td>{{$screens->code}}</td>
    <td>
        <a class="btn btn-danger round remove" table-method="delete"
            data-trans-button-cancel="'.trans('buttons.general.cancel').'"
            data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
            data-trans-title="'.trans('strings.backend.general.are_you_sure').'" data-toggle="tooltip" data-placement="top" title="Delete">
                <i  class="fa fa-trash"></i>
        </a>
    </td>

    <input type="hidden" name="cost_center_screens[]" value="{{$screens->id}}">
    <input type="hidden" name="cost_center_screens_names[]" value="{{$screens->name_ar}}">
</tr>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        $('#screens-table').on('click','.remove', function(){
            Swal.fire({
                title: 'هل انت متأكد من مسح مركز التكلفه ؟',
                text: "لا يمكنك الرجوع ف هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('tr').remove();
                }
            })
        });
    });
</script>