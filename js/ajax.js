$(document).ready(function() {
    criptaPass();
    decriptPass();
    decriptPassTable();
    deletePassTable();
    changePassUser();
    deleteUser();
    titlePageAdmin();
    deletePageAdmin();
    selectOptionPageAdmin();
    insertCopy();
});
// Cripta la pass
function criptaPass() {
    $('#cripta').click(function() {
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();
        let key = $('input[name="key"]').val();
        if (key.length >= 8) {
            $.ajax({
                type: 'POST',
                url: '../scripts/cripta.php',
                data: { username: username, password: password, key: key},
                success: function(data) {
                    // Fai apparire il div #criptoPass
                    $('#criptoPass').toggleClass('hide');
                    // Pulisci gli input
                    $('input[name="username"]').val('');
                    $('input[name="password"]').val('');
                    $('input[name="key"]').val('');
                    // Riempi il div #messaggio con il risultato
                    $('#messaggio').html(data);
                    // Aziona il bottone che chiude la card
                    $("button[aria-label='Close']").click(function() {
                        
                        location.reload();
                    });
                },
                error: function() {
                    alert('Errore nella richiesta AJAX');
                }
            });
            } else {
                $('#error').html('La key deve avere almento 8 caratteri');
                $('#error').toggleClass('hide');
            return false;
        };
    }); 
}
// Decripta la pass 
function decriptPass() {
    $('#decripta').click(function() {
        let password = $('input[name="encryptedPassword"]').val();
        let key = $('input[name="keyEncryp"]').val();
        $.ajax({
            type: 'POST',
            url: '../scripts/decripta.php', // Percorso relativo corretto
            data: { password: password, key: key},
            success: function(data) {
                $('#criptoPass').toggleClass('hide');
                $('#messaggio').html(data);

                $("button[aria-label='Close']").click(function() {
                    $('#criptoPass').addClass('hide');
                    $('input[name="encryptedPassword"]').val('');
                    $('input[name="keyEncryp"]').val('');
                    $('#messaggio').text('');
                });
            },
            error: function() {
                alert('Errore nella richiesta AJAX');
            }
        });
    });  
}
// Decripta la pass nel profilo utente  (pag. Le Password)
function decriptPassTable() {
    $(".decript").click(function() {
        let decriptId = $(this).attr("id");
        let password = $("#id-" + decriptId).text();
        let key = window.prompt("Inserisci la chiave:")
        if(key != null) {
            $.ajax({
                type: 'POST',
                url: '../scripts/decripta.php', // Percorso relativo corretto
                data: { password: password, key: key},
                success: function(data) {
                    $("#id-" + decriptId).html(data);
                    $("#" + decriptId).addClass('hide');
                    $("#reset-" + decriptId).removeClass('hide').addClass('show');
                },
                error: function() {
                    alert('Errore nella richiesta AJAX');
                }
            });

        }
    });
}
// Elimina la pass nella tabella (pag. Le Password)
function deletePassTable() {
    $(".deletePass").click(function() {
        let idPass = $(this).attr("id");
        let check =  confirm("Sicuro di voler eliminare la password?");
        if(check == true) {
            $.ajax({
                type: 'POST',
                url: '../scripts/elimina_pass.php', // Percorso relativo corretto
                data: { idPass: idPass},
                success: function(data) {
                    alert(data);
                    location.reload();
                },
                error: function() {
                    alert('Errore nella richiesta AJAX');
                }
            });
        }
    });
}
function changePassUser() {
    $("#cambia-password").click(function() {
        let old_password = $('input[name="old_password"]').val();
        let new_password = $('input[name="new_password"]').val();
        let confirm_password = $('input[name="confirm_password"]').val();
        let check =  confirm("Sicuro di voler cambiare la password?");

        if(check == true) {
            $.ajax({
                type: 'POST',
                url: '../scripts/cambia-password.php', // Percorso relativo corretto
                data: { 
                    old_password: old_password,
                    new_password: new_password,
                    confirm_password: confirm_password,
                },
                success: function(data) {
                    $('#request').html(data);
                },
                error: function() {
                    alert('Errore nella richiesta AJAX');
                }
            });
        }
    });
}
// Elimina l'utente (admin dash)
function deleteUser() {
    $('.deleteUser').click(function() {
        let idUtente = $(this).data("id");
        $('#confermaModal').modal('show');
        $("#confermaButtonModal").click(function() {
            console.log(idUtente);
            $.ajax({
                type: 'POST',
                url: '../admin/elimina-utente.php',
                data: { idUtente: idUtente },
                success: function(data) {
                    $('#confermaModal').modal('hide');
                    location.reload(); // Aggiorna la pagina
                },
                error: function() {
                    alert('Errore nella richiesta AJAX');
                }
            });
        });   
    });
}
// Crea nuove pagine (admin dash)
function titlePageAdmin() {
    $('#titlePage').click(function() {
        let title = $('input[name="titolo"]').val();
        $.ajax({
            type: 'POST',
            url: '../admin/crea-pagina.php',
            data: { title: title },
            success: function(data) {
                alert(data);
                location.reload();
            },
            error: function() {
                alert('Errore nella richiesta AJAX');
            }
        });
    });
}
// Elimina le pagine (admin dash)
function deletePageAdmin() {
    $('.deletePage').click(function() {
        let idPage = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: '../admin/elimina-pagina.php',
            data: { idPage: idPage },
            success: function(data) {
                alert(data);
                location.reload();
            },
            error: function() {
                alert('Errore nella richiesta AJAX');
            }
        });
    });
}
// Crea un select con le pagine
// se presente titolo e contenuto me lo mostra (admin dash)
function selectOptionPageAdmin() {
    $("select[name='pageName']").change(function() { 
        let link = $(this).val();  
        $.ajax({
            type: 'POST',
            url: '../admin/page-content.php',
            data: {
                link: link,
            },
            success: function(data) {
                let titolo = data.titolo;
                let contenuto = data.contenuto;
                $('input[name="titoloPagina"]').val(titolo);
                $('textarea[name="contenutoPagina"]').val(contenuto);
            },
            error: function(error) {
                // Gestisci gli errori qui.
            }
            });

    });
}
// Inserisce titolo e contenuto nelle pagine (admin dash)
function insertCopy() {
    $('#insertCopy').click(function() {
        let titolo = $('input[name="titoloPagina"]').val();
        let contenuto = $('textarea[name="contenutoPagina"]').val();
        let pageSelect = $("select[name='pageName']").val();
        console.log(pageSelect);
        $.ajax({
            type: 'POST',
            url: '../admin/insert-copy.php',
            data: { 
                titolo: titolo,
                contenuto: contenuto,
                pageSelect: pageSelect,
            },
            success: function(data) {
                alert(data);
            },
            error: function() {
                alert('Errore nella richiesta AJAX');
            }
        });
    }); 
}