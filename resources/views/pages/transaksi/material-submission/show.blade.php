<p class="mb-1"><code style="color:red;">Data</code>Permohonan Permintaan Material</p>
<table class="table table-bordered">
    <tr>
        <th>No PP</th>
        <td>{{ isset($material_submission->no_pp) ? $material_submission->no_pp : 'N/A' }}</td>
    </tr>
    <tr>
        <th>No Permohonan</th>
        <td>{{ isset($material_submission->no_permohonan) ? $material_submission->no_permohonan : 'N/A' }}</td>
    </tr>
    <tr>
        <th>No Kontrak</th>
        <td>{{ isset($material_submission->no_kontrak) ? $material_submission->no_kontrak : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tanggal Permohonan</th>
        <td>{{ isset($material_submission->tgl_permohonan) ? date('d-M-Y', strtotime($material_submission->tgl_permohonan)) : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Kontraktor Pelaksana</th>
        <td>{{ isset($material_submission->vendor->name) ? $material_submission->vendor->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Unit Kerja</th>
        <td>{{ isset($material_submission->divisi->name) ? $material_submission->divisi->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jenis Pemeriksaan</th>
        <td>
            @php
                $jenis_pemeriksaan = json_decode($material_submission->jenis_pemeriksaan);
            @endphp
            @foreach ($jenis_pemeriksaan as $jenis)
                @if ($jenis == 1)
                    <span class="badge badge-yellow">{{ 'Material' }}</span>
                @elseif($jenis == 2)
                    <span class="badge badge-danger">{{ 'Raw Material' }}</span>
                @elseif($jenis == 3)
                    <span class="badge badge-success">{{ 'Alat' }}</span>
                @else
                    <span>{{ 'N/A' }}</span>
                @endif
            @endforeach
        </td>
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
        <th>Jenis Pekerjaan</th>
        <td>{{ isset($material_submission->jenis_pekerjaan) ? $material_submission->jenis_pekerjaan : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Keterangan (Material)</th>
        <td>{!! $material_submission->keterangan !!}</td>
    </tr>
    <tr>
        <th>Created_at</th>
        <td>{{ isset($material_submission->created_at) ? $material_submission->created_at : 'N/A' }}</td>
    </tr>
</table>
<p class="mb-1"><code style="color:red;">File</code>Permohonan Permintaan Material</p>
<table class="table table-bordered">
    <tr>
        <th>KAK</th>
        <td style="text-align:center;">
            {{ pathinfo($material_submission->file_material_submission->kak, PATHINFO_FILENAME) }}
        </td>
        <td style="text-align:center;"><a data-fancybox="gallery"
                data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->file_material_submission->kak }}"
                class="blue accent-4">Show</a></td>
        <td style="text-align:center;"><a
                href="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->file_material_submission->kak }}"
                class="btn btn-sm btn-info" download>Download</a></td>
    </tr>
    <tr>
        <th>PCM</th>
        <td style="text-align:center;">
            {{ pathinfo($material_submission->file_material_submission->pcm, PATHINFO_FILENAME) }}
        </td>
        <td style="text-align:center;"><a data-fancybox="gallery"
                data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->file_material_submission->pcm }}"
                class="blue accent-4">Show</a></td>
        <td style="text-align:center;"><a
                href="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->file_material_submission->pcm }}"
                class="btn btn-sm btn-info" download>Download</a></td>
    </tr>
    @foreach ($file_material as $file)
        <tr>
            <th>Brosur</th>
            <td style="text-align:center;">
                {{ pathinfo($file->brosur, PATHINFO_FILENAME) }}
            </td>
            <td style="text-align:center;"><a data-fancybox="gallery"
                    data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $file->brosur }}"
                    class="blue accent-4">Show</a></td>
            <td style="text-align:center;"><a
                    href="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $file->brosur }}"
                    class="btn btn-sm btn-info" download>Download</a></td>
        </tr>
    @endforeach
    <tr>
        <th>File Lain</th>
        <td style="text-align:center;">
            {{ pathinfo($material_submission->file_material_submission->file_lain, PATHINFO_FILENAME) }}
        </td>
        <td style="text-align:center;"><a data-fancybox="gallery"
                data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->file_material_submission->file_lain }}"
                class="blue accent-4">Show</a></td>
        <td style="text-align:center;"><a
                href="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $material_submission->file_material_submission->file_lain }}"
                class="btn btn-sm btn-info" download>Download</a></td>
    </tr>
    <tr>
        <th>Keterangan (File)</th>
        <td colspan="3">
            {!! $material_submission->file_material_submission->keterangan !!}
        </td>
    </tr>
</table>
