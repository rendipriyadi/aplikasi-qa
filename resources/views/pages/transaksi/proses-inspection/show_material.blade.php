<table class="table table-bordered">
    <tr>
        <th>No PP</th>
        <td>{{ isset($check_material->inspection_material->material_submission->no_pp) ? $check_material->inspection_material->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis Material</th>
        <td>{{ isset($check_material->jenis) ? $check_material->jenis : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Sumber Material</th>
        <td>{{ isset($check_material->sumber) ? $check_material->sumber : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Metode Pemeriksaan</th>
        <td>
            <span class="badge badge-yellow">{{ $check_material->metode }}</span>
        </td>
    </tr>
    <tr>
        <th>Jumlah Sampel</th>
        <td>{{ isset($check_material->jumlah) ? $check_material->jumlah : 'N/A' }}
            {{ isset($check_material->satuan_id) ? $check_material->satuan->name : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Hasil Pemeriksaan</th>
        <td>
            @if ($check_material->hasil == 1)
                <span class="badge badge-yellow">{{ 'Sesuai' }}</span>
            @elseif($check_material->hasil == 2)
                <span class="badge badge-success">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td>{{ date('d-m-Y H:i', strtotime($check_material->created_at)) ?? '' }}</td>
    </tr>
</table>
