<p class="mb-1"><code style="color:red;">Status</code>Permohonan QA</p>
<table class="table table-bordered">
    <tr>
        <th>No PP</th>
        <td>{{ isset($material_submission->no_pp) ? $material_submission->no_pp : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($material_submission->status == 1)
                <span class="badge badge-yellow">{{ 'Permohonan Pemeriksaan' }}</span>
            @elseif($material_submission->status == 2)
                <span class="badge badge-danger">{{ 'Ditolak' }}</span>
            @elseif($material_submission->status == 3)
                <span class="badge badge-success">{{ 'Disetujui' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{{ isset($material_submission->status_material_submission->keterangan) ? $material_submission->status_material_submission->keterangan : 'N/A' }}
        </td>
    </tr>
</table>

@if ($material_submission->status == 3)
    <p class="mb-1"><code style="color:red;">File</code>Undangan Rapat</p>
    <table class="table table-bordered">
        <tr>
            <th>File</th>
            <td style="text-align:center;">
                {{ pathinfo($material_submission->status_material_submission->file, PATHINFO_FILENAME) }}
            </td>
            <td style="text-align:center;"><a data-fancybox="gallery"
                    data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->status_material_submission->file }}"
                    class="blue accent-4">Show</a></td>
            <td style="text-align:center;"><a
                    href="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->status_material_submission->file }}"
                    class="btn btn-sm btn-info" download>Download</a></td>
        </tr>
    </table>
@endif
