<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $test_material->id }}">
    <tr>
        <th>No PP</th>
        <td>{{ isset($test_material->check_material->inspection_material->material_submission->no_pp) ? $test_material->check_material->inspection_material->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis Material</th>
        <td>{{ isset($test_material->check_material->jenis) ? $test_material->check_material->jenis : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Sumber Material</th>
        <td>{{ isset($test_material->check_material->sumber) ? $test_material->check_material->sumber : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Metode Pemeriksaan</th>
        <td>
            <span class="badge badge-yellow">{{ $test_material->metode }}</span>
        </td>
    </tr>
    <tr>
        <th>Jumlah Sampel</th>
        <td>{{ isset($test_material->jumlah) ? $test_material->jumlah : 'N/A' }}
            {{ isset($test_material->satuan_id) ? $test_material->satuan->name : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Hasil Pemeriksaan</th>
        <td>
            @if ($test_material->hasil == 1)
                <span class="badge badge-yellow">{{ 'Sesuai' }}</span>
            @elseif($test_material->hasil == 2)
                <span class="badge badge-success">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td colspan="2">{{ date('d-m-Y H:i', strtotime($test_material->created_at)) ?? '' }}</td>
    </tr>
</table>
<table class="table table-bordered tampildata">
</table>

<script>
    function tampilDataFile() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let id = $('#id').val();
        $.ajax({
            type: "post",
            url: "{{ route('backsite.ajax_controller.show_file') }}",
            data: {
                id: id
            },
            dataType: "json",
            beforeSend: function() {
                $('.tampildata').html('<i class="bx bx-balloon bx-flasing"></i>');
            },
            success: function(response) {
                if (response.data) {
                    $('.tampildata').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        tampilDataFile();
    });
</script>
