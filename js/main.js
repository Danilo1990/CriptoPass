$(document).ready(function() {
    checkSavePassword();
    resetButton();
    tab();
    panelAdminDash();
    lengtCreatePass();
    generatePass();
    copyPass();
});
// Check salvare la pass nel profilo utente
function checkSavePassword() {
    $('#SwitchCheckUser').change(function() {
        // Controlla se la casella di controllo è spuntata
        if ($(this).is(':checked')) {
            $('#username').removeClass('hide');
        } else {
            // Nascondi il campo di input di testo
            $('#username').addClass('hide');
        }
    });   
};
// Reset button
function resetButton() {
    $(".reset").click(function() { 
        location.reload();
    });
};
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
