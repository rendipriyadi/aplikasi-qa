<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $transfer_material->id }}">
    <tr>
        <th>No PP</th>
        <td>{{ isset($transfer_material->material_submission->no_pp) ? $transfer_material->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No Kontrak</th>
        <td>{{ isset($transfer_material->material_submission->no_kontrak) ? $transfer_material->material_submission->no_kontrak : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No Permohonan</th>
        <td>{{ isset($transfer_material->material_submission->no_permohonan) ? $transfer_material->material_submission->no_permohonan : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis Pekerjaan</th>
        <td>{{ isset($transfer_material->material_submission->jenis_pekerjaan) ? $transfer_material->material_submission->jenis_pekerjaan : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Tgl Pembuatan/Pendaftaran</th>
        <td>{{ isset($transfer_material->tgl_penyerahan) ? date('d F Y', strtotime($transfer_material->tgl_penyerahan)) : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Lokasi / Workshop</th>
        <td>{{ isset($transfer_material->lokasi) ? $transfer_material->lokasi : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($transfer_material->status == 1)
                <span class="badge badge-sucsess">{{ 'Sesuai' }}</span>
            @elseif($transfer_material->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Catatan</th>
        <td>{!! $transfer_material->keterangan !!}
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td colspan="2">{{ date('d-m-Y H:i', strtotime($transfer_material->created_at)) ?? '' }}</td>
    </tr>
    <tr>
        <th>Created by</th>
        <td colspan="2">{{ isset($transfer_material->created_by) ? $transfer_material->created_by : 'N/A' }}</td>
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
            url: "{{ route('backsite.ajax_controller.file_transfer_material') }}",
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
