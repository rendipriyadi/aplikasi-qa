<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $inspection_material->id }}">
    <tr>
        <th>No PP</th>
        <td colspan="2">
            {{ isset($inspection_material->material_submission->no_pp) ? $inspection_material->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No Kontrak</th>
        <td colspan="2">
            {{ isset($inspection_material->material_submission->no_kontrak) ? $inspection_material->material_submission->no_kontrak : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No Permohonan</th>
        <td colspan="2">
            {{ isset($inspection_material->material_submission->no_permohonan) ? $inspection_material->material_submission->no_permohonan : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis Pekerjaan</th>
        <td colspan="2">
            {{ isset($inspection_material->material_submission->jenis_pekerjaan) ? $inspection_material->material_submission->jenis_pekerjaan : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Tgl Pemeriksaan</th>
        <td colspan="2">
            {{ isset($inspection_material->tgl_pemeriksaan) ? date('d F Y', strtotime($inspection_material->tgl_pemeriksaan)) : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Lokasi / Workshop</th>
        <td colspan="2">{{ isset($inspection_material->lokasi) ? $inspection_material->lokasi : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>File Pleno</th>
        <td style="text-align:center;">
            {{ pathinfo($inspection_material->file, PATHINFO_FILENAME) }}
        </td>
        <td style="text-align:center;">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Action</button>
            <div class="dropdown-menu">
                <a data-fancybox="gallery"
                    data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $inspection_material->file }}"
                    class="blue accent-4 dropdown-item">Show</a>
                <a href="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $inspection_material->file }}"
                    class="dropdown-item" download>Download</a>
            </div>
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td colspan="2">
            @if ($inspection_material->status == 1)
                <span class="badge badge-sucsess">{{ 'Sesuai' }}</span>
            @elseif($inspection_material->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Catatan</th>
        <td colspan="2">{!! $inspection_material->keterangan !!}
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td colspan="2">{{ date('d-m-Y H:i', strtotime($inspection_material->created_at)) ?? '' }}</td>
    </tr>
    <tr>
        <th>Created by</th>
        <td colspan="2">{{ isset($inspection_material->created_by) ? $inspection_material->created_by : 'N/A' }}
        </td>
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
            url: "{{ route('backsite.ajax_controller.file_inspection') }}",
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
