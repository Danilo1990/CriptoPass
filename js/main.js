$(document).ready(function() {
    changeType();
    checkSavePassword();
    resetButton();
    serchOnTablePass()
    tab();
    panelAdminDash();
    lengtCreatePass();
    generatePass();
    copyPass();
});

function changeType() {
    $('.icon-pass').click(function(){
        let inputPassword = $(this).prev('input.showPass');
        let id = inputPassword.data("id");
        //console.log(id);
        if (inputPassword.attr('type') === 'password') {
            inputPassword.attr('type', 'text');
            $('#showPass'+id).removeClass('bi bi-eye')
            $('#showPass'+id).addClass('bi bi-eye-slash')
        } else {
            inputPassword.attr('type', 'password');
            $('#showPass'+id).addClass('bi bi-eye')
            $('#showPass'+id).removeClass('bi bi-eye-slash')
        }
    });
}
// Check sallete la pass nel profilo utente
function checkSavePassword() {
    $('#SwitchCheckUser').change(function() {
        $('#username').toggleClass('hide');
        $('#sito').toggleClass('hide');
    });   
};
// Reset button
function resetButton() {
    $(".reset").click(function() { 
        location.reload();
    });
};
// Cerca in tabella Pass
function serchOnTablePass() {
    $('#btnCerca').click(function() {
        let testoDaCercare = $('#cerca').val().toLowerCase(); // Ottieni il testo di ricerca in minuscolo
        if(testoDaCercare == '') { return false; }
        $('table tbody tr').each(function() {
            let riga = $(this);
            let sito = riga.find('th').text().toLowerCase(); // Testo nel campo "Sito"
    
            // Verifica se il testo da cercare è presente in uno dei campi della riga
            if (sito.indexOf(testoDaCercare) !== -1 ) {
                riga.show(); // Mostra la riga se la corrispondenza è trovata
                $('#reset').removeClass('hide');
            } else {
                riga.hide(); // Nascondi la riga se la corrispondenza non è trovata
            }
        });
    });
}
// Tab
function tab() {
    $("a[data-toggle='tab']").click(function() {
        let tabId = $(this).attr("id");
        $(".tab-pane").removeClass("active");
        $(".nav-link").removeClass("active");
        $("#" + tabId).addClass("active");
        $("#" + tabId + "-content").addClass("active");
    });
    $("a[data-target='submenu']").click(function() {
        $("#submenu").toggleClass('show animate');                  
    });
};
// Panel admin dashbord
function panelAdminDash() {
    $("#navBtn").click(function() {
        $(".main").toggleClass('animate');
    });
    $("a[data-panel='panel']").click(function() {
        let panelId = $(this).attr("id");      
        $(".link").removeClass("link-active");
        $("#" + panelId).addClass("link-active");
        $(".panel-tab").removeClass("active");
        $("#" + panelId + "-panel").addClass("active");
    });
};
// Lunghezza pass
function lengtCreatePass() {
    $('#lengthPass').change(function() { 
        let length = parseInt($("#lengthPass").val()) || 0;
        $('#lunghezza').text(length)
    });
};
// Genera la pass
function generatePass() {
    $("#generate").click(function() {
        let length = parseInt($("#lengthPass").val()) || 0;
        let lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
        let uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let numbers = '1234567890';
        let symbols = '!"£$%&}*/()=?^{[@#€';

        let allLetters = lowercaseLetters;
        if ($("#uppercasePass").is(":checked")) {
            allLetters += uppercaseLetters;
        }
        if ($("#numberPass").is(":checked")) {
            allLetters += numbers;
        }
        if ($("#symbolsPass").is(":checked")) {
            allLetters += symbols;
        }

        let randomString = '';

        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * allLetters.length);
            randomString += allLetters.charAt(randomIndex);
        }
        $('#pass').text(randomString)
        $('#copy').removeClass('hide')

    });
}
function copyPass() {
    $("#copy").click(function() {
        let text = $('#pass').text()

        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();

        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('Testo copiato negli appunti');
    });
}
