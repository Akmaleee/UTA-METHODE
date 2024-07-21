<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>UTA Method</h2>
    <form action="{{ route('calculate') }}" method="POST">
        @csrf
        <h3>Nama Kriteria dan Bobot</h3>
        <div id="kriteria">
            <div class="kriteria-row">
                <label for="nama_kriteria[]">Nama Kriteria 1:</label>
                <input type="text" name="nama_kriteria[]" required>
                <label for="bobot_kriteria[]">Bobot Kriteria 1:</label>
                <input type="number" name="bobot_kriteria[]" step="0.01" required>
                <select name="jenis_kriteria[]">
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                </select>
            </div>
        </div>
        <button type="button" onclick="addKriteria()">Tambah Kriteria</button>
        
        <h3>Nama Alternatif dan Nilai</h3>
        <div id="alternatif">
            <div class="alternatif-row">
                <label for="nama_alternatif[]">Nama Alternatif 1:</label>
                <input type="text" name="nama_alternatif[]" required>
                <label for="nilai[0][0]">Nilai Kriteria 1:</label>
                <input type="number" name="nilai[0][0]" step="0.01" required>
            </div>
        </div>
        <button type="button" onclick="addAlternatif()">Tambah Alternatif</button>

        <br><br>
        <input type="submit" value="Submit">
    </form>

    <script>
        let kriteriaCount = 1;
        let alternatifCount = 1;

        function addKriteria() {
            kriteriaCount++;
            const div = document.createElement('div');
            div.className = 'kriteria-row';
            div.innerHTML = `
                <label for="nama_kriteria[]">Nama Kriteria ${kriteriaCount}:</label>
                <input type="text" name="nama_kriteria[]" required>
                <label for="bobot_kriteria[]">Bobot Kriteria ${kriteriaCount}:</label>
                <input type="number" name="bobot_kriteria[]" step="0.01" required>
                <select name="jenis_kriteria[]">
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                </select>
            `;
            document.getElementById('kriteria').appendChild(div);

            const alternatifRows = document.querySelectorAll('.alternatif-row');
            alternatifRows.forEach((row, index) => {
                const newLabel = document.createElement('label');
                newLabel.innerHTML = `Nilai Kriteria ${kriteriaCount}:`;
                const newInput = document.createElement('input');
                newInput.type = 'number';
                newInput.name = `nilai[${index}][${kriteriaCount - 1}]`;
                newInput.step = '0.01';
                newInput.required = true;
                row.appendChild(newLabel);
                row.appendChild(newInput);
            });
        }

        function addAlternatif() {
            alternatifCount++;
            const div = document.createElement('div');
            div.className = 'alternatif-row';
            div.innerHTML = `
                <label for="nama_alternatif[]">Nama Alternatif ${alternatifCount}:</label>
                <input type="text" name="nama_alternatif[]" required>
                <label for="nilai[${alternatifCount - 1}][0]">Nilai Kriteria 1:</label>
                <input type="number" name="nilai[${alternatifCount - 1}][0]" step="0.01" required>
            `;
            for (let i = 1; i < kriteriaCount; i++) {
                const newLabel = document.createElement('label');
                newLabel.innerHTML = `Nilai Kriteria ${i + 1}:`;
                const newInput = document.createElement('input');
                newInput.type = 'number';
                newInput.name = `nilai[${alternatifCount - 1}][${i}]`;
                newInput.step = '0.01';
                newInput.required = true;
                div.appendChild(newLabel);
                div.appendChild(newInput);
            }
            document.getElementById('alternatif').appendChild(div);
        }
    </script>
</div>
@endsection
