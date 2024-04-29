document.getElementById('submit').addEventListener('click', function() {
    var name = document.getElementById('nama').value;
    var count = parseInt(document.getElementById('jumlah').value);
  
    if (name.trim() === '') {
        alert('Nama jangan sampai kosong!');
        return;
    }
  
    if (isNaN(count) || count <= 0) {
        alert('Jumlah Pilihan diharuskan angka dan tidak lebih dari 0!');
        return;
    }
  
    var inputHtml = '';
    for (var i = 1; i <= count; i++) {
        inputHtml += '<label for="pilihan' + i + '">Pilihan ' + i + ':</label>';
        inputHtml += '<input type="text" id="pilihan' + i + '" required><br>';
    }
    inputHtml += '<button type="button" id="submitPilihanBtn">OK</button>'; // tambahkan tombol OK di akhir
    document.getElementById('masukanPilihan').innerHTML = inputHtml;
    document.getElementById('masukanPilihan').style.display = 'block';
  
    document.getElementById('submitPilihanBtn').addEventListener('click', function() { 
        var radioHtml = '';
        for (var i = 1; i <= count; i++) {
            var option = document.getElementById('pilihan' + i).value;
            radioHtml += '<div class="radio-item">';
            radioHtml += '<input type="radio" id="pilihanRadio' + i + '" name="pilihanRadio" value="' + option + '">';
            radioHtml += '<label for="pilihanRadio' + i + '">' + option + '</label>';
            radioHtml += '</div>';
        }
        radioHtml += '<button type="button" id="submitRadioBtn">OK</button>';
        document.getElementById('radioPilihan').innerHTML = radioHtml;
        document.getElementById('radioPilihan').style.display = 'block';
  
        document.getElementById('submitRadioBtn').addEventListener('click', function() { 
            var selectedOption = document.querySelector('input[name="pilihanRadio"]:checked');
            if (selectedOption) {
                var name = document.getElementById('nama').value;
                var count = document.getElementById('jumlah').value;
                var option = selectedOption.value;
                var result = 'Hallo, nama saya ' + name + ', saya mempunyai sejumlah ' + count + ' pilihan yaitu ';
                var optionLabels = document.querySelectorAll('input[name="pilihanRadio"]');
                for (var i = 0; i < optionLabels.length; i++) {
                    result += optionLabels[i].value;
                    if (i < optionLabels.length - 1) {
                        result += ', ';
                    }
                }
                result += ', dan saya memilih ' + option;
                document.getElementById('hasil').innerText = result;
                document.getElementById('hasil').style.display = 'block';
            } else {
                alert('pilih salah satu pilihan!');
            }
        });
    });
});
