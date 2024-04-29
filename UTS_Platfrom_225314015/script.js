document.getElementById('submit').addEventListener('click', function() {
    var namaDepan = document.getElementById('namaDepan').value;
    var namaBelakang = document.getElementById('namaBelakang').value;
    var email = document.getElementById('email').value;
    var count = parseInt(document.getElementById('jumlah').value);
  
    if (namaDepan.trim() === '' || namaBelakang.trim() === '') {
        alert('Nama jangan sampai kosong!');
        return;
    }

    if (email.trim() === '') {
        alert('Email jangan sampai kosong!');
        return;
    }

    // Validasi email menggunakan regular expression
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Email tidak valid!');
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
        var checkboxHtml = '';
        for (var i = 1; i <= count; i++) {
            var option = document.getElementById('pilihan' + i).value;
            checkboxHtml += '<div class="checkbox-item">';
            checkboxHtml += '<input type="checkbox" id="pilihanCheckbox' + i + '" name="pilihanCheckbox" value="' + option + '">';
            checkboxHtml += '<label for="pilihanCheckbox' + i + '">' + option + '</label>';
            checkboxHtml += '</div>';
        }
        checkboxHtml += '<button type="button" id="submitCheckboxBtn">OK</button>';
        document.getElementById('checkboxPilihan').innerHTML = checkboxHtml;
        document.getElementById('checkboxPilihan').style.display = 'block';
  
        document.getElementById('submitCheckboxBtn').addEventListener('click', function() { 
            var selectedOptions = document.querySelectorAll('input[name="pilihanCheckbox"]:checked');
            if (selectedOptions.length > 0) {
                var choices = [];
                selectedOptions.forEach(function(option) {
                    choices.push(option.value);
                });
                var result = 'Hallo, nama saya ' + namaDepan + ' ' + namaBelakang + ', dengan email ' + email + ', saya mempunyai sejumlah ' + count + ' pilihan hobi yaitu ' + choices.join(', ') + ', dan saya menyukai ' + choices.join(', ');
                document.getElementById('hasil').innerText = result;
                document.getElementById('hasil').style.display = 'block';
            } else {
                alert('Pilih salah satu atau lebih pilihan hobi!');
            }
        });
    });
});
