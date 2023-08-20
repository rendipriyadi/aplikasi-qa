<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $test_tool->id }}">
    <tr>
        <th>No PP</th>
        <td>{{ isset($test_tool->material_testing->material_submission->no_pp) ? $test_tool->material_testing->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis</th>
        <td>{{ isset($test_tool->jenis) ? $test_tool->jenis : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jenis / Type</th>
        <td>{{ isset($test_tool->type) ? $test_tool->type : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Kapasitas</th>
        <td>{{ isset($test_tool->kapasitas) ? $test_tool->kapasitas : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tahun</th>
        <td>{{ isset($test_tool->tahun) ? $test_tool->tahun : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td>{{ isset($test_tool->jumlah) ? $test_tool->jumlah : 'N/A' }}
            {{ isset($test_tool->satuan->name) ? $test_tool->satuan->name : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Kondisi Alat</th>
        <td>
            @if ($test_tool->kondisi == 1)
                <span class="badge badge-yellow">{{ 'Baik' }}</span>
            @elseif($test_tool->kondisi == 2)
                <span class="badge badge-success">{{ 'Sedang' }}</span>
            @elseif($test_tool->kondisi == 3)
                <span class="badge badge-danger">{{ 'Rusak' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Hasil Pemeriksaan</th>
        <td>
            @if ($test_tool->hasil == 1)
                <span class="badge badge-yellow">{{ 'Sesuai' }}</span>
            @elseif($test_tool->hasil == 2)
                <span class="badge badge-success">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td colspan="2">{{ date('d-m-Y H:i', strtotime($test_tool->created_at)) ?? '' }}</td>
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
            url: "{{ route('backsite.ajax_controller.show_file_tool') }}",
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
