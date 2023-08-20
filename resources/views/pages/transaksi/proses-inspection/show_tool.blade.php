<table class="table table-bordered">
    <tr>
        <th>No PP</th>
        <td>{{ isset($check_tool->inspection_material->material_submission->no_pp) ? $check_tool->inspection_material->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis</th>
        <td>{{ isset($check_tool->jenis) ? $check_tool->jenis : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jenis / Type</th>
        <td>{{ isset($check_tool->type) ? $check_tool->type : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Kapasitas</th>
        <td>{{ isset($check_tool->kapasitas) ? $check_tool->kapasitas : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tahun</th>
        <td>{{ isset($check_tool->tahun) ? $check_tool->tahun : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td>{{ isset($check_tool->jumlah) ? $check_tool->jumlah : 'N/A' }}
            {{ isset($check_tool->satuan->name) ? $check_tool->satuan->name : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Kondisi Alat</th>
        <td>
            @if ($check_tool->kondisi == 1)
                <span class="badge badge-yellow">{{ 'Baik' }}</span>
            @elseif($check_tool->kondisi == 2)
                <span class="badge badge-success">{{ 'Sedang' }}</span>
            @elseif($check_tool->kondisi == 3)
                <span class="badge badge-danger">{{ 'Rusak' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Hasil Pemeriksaan</th>
        <td>
            @if ($check_tool->hasil == 1)
                <span class="badge badge-yellow">{{ 'Sesuai' }}</span>
            @elseif($check_tool->hasil == 2)
                <span class="badge badge-success">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td>{{ date('d-m-Y H:i', strtotime($check_tool->created_at)) ?? '' }}</td>
    </tr>
</table>
