<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $material_testing->id }}">
    <tr>
        <th>No PP</th>
        <td>{{ isset($material_testing->material_submission->no_pp) ? $material_testing->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No Kontrak</th>
        <td>{{ isset($material_testing->material_submission->no_kontrak) ? $material_testing->material_submission->no_kontrak : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No Permohonan</th>
        <td>{{ isset($material_testing->material_submission->no_permohonan) ? $material_testing->material_submission->no_permohonan : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis Pekerjaan</th>
        <td>{{ isset($material_testing->material_submission->jenis_pekerjaan) ? $material_testing->material_submission->jenis_pekerjaan : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Tgl Pengujian</th>
        <td>{{ isset($material_testing->tgl_pengujian) ? date('d F Y', strtotime($material_testing->tgl_pengujian)) : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Lokasi / Workshop</th>
        <td>{{ isset($material_testing->lokasi) ? $material_testing->lokasi : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($material_testing->status == 1)
                <span class="badge badge-sucsess">{{ 'Sesuai' }}</span>
            @elseif($material_testing->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Catatan</th>
        <td>{!! $material_testing->keterangan !!}
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td colspan="2">{{ date('d-m-Y H:i', strtotime($material_testing->created_at)) ?? '' }}</td>
    </tr>
    <tr>
        <th>Created by</th>
        <td colspan="2">{{ isset($material_testing->created_by) ? $material_testing->created_by : 'N/A' }}</td>
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
            url: "{{ route('backsite.ajax_controller.file_material_testing') }}",
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
