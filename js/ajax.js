$(document).ready(function() {
    changeTablePass();
    login();
    registerUser();
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
function changeTablePass() {
    $('.changeTab').click(function() {
        swal("Attento!", "Se vuoi modificare la password devi inserla gia criptata", "info");
        
        let id = $(this).attr("id");

        $('#'+id).prop('disabled', true);

        $('#btnChange-'+id).removeClass('hide');
        $('.change').removeClass('hide');
        let site = $('#site-'+id);
        let user = $('#user-'+id);
        let pass = $('#pass-'+id);

        let inputSite = $('<input type="text" class="form-control">').val(site.text());
        let inputUser = $('<input type="text" class="form-control">').val(user.text());
        let inputPass = $('<input type="text" class="form-control">').val(pass.text());

        site.html(inputSite);
        user.html(inputUser);
        pass.html(inputPass);

        $('#btnChange-'+id).click(function() {
            let newSite = inputSite.val();
            let newUser = inputUser.val();
            let newPass = inputPass.val();
            $.ajax({
                type: 'POST',
                url: '../inc/modifica-tabella.php',
                data: { id: id, newSite: newSite, newUser: newUser, newPass: newPass},
                success: function(data) {
                    if(data == 'change') {
                        swal("Ottimo", "Campi modificati con successo", "success");
                    }
                    site.text(newSite);
                    user.text(newUser);
                    pass.text(newPass);
                    $('#'+id).prop('disabled', false);
                    $('#btnChange-'+id).addClass('hide');
                    $('.change').addClass('hide');
                },
                error: function() {
                    alert('Errore nella richiesta AJAX' + data);
                    console.log(data);
                }
            });
        })
        

    });
}
function login() {
    $('#login').click(function() {
        let email = $('input[name="email"]').val();
        let password = $('input[name="password"]').val();
        $.ajax({
            type: 'POST',
            url: '../inc/function-login.php',
            data: { email: email, password: password},
            success: function(data) {
                if(data == 'errorPass') {
                    swal("Pasword errata", "La password che hai inserito non è corretta", "error");
                    console.log(data);
                } else if(data == 'errorUser') {
                    swal("Username non trovato", "Controllo i dati inseriti", "error");
                    console.log(data);
                } else {
                    window.location.replace("area-riservata");
                }
            },
            error: function() {
                alert('Errore nella richiesta AJAX' + data);
                console.log(data);
            }
        });
    });
};
// Registrati
function registerUser() {
    $('#register').click(function() {
        console.log('ciao');
        let email = $('input[name="email"]').val();
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();
    
        $.ajax({
            type: 'POST',
            url: '../inc/function-register.php',
            data: { email: email, username: username, password: password},
            success: function(data) {
                if(data == 'passLeght') {
                    swal("La password non va bene", "La password deve contenere min 8 caratteri e una lettera maiuscola", "error");
                    console.log(data);
                } else if(data == 'userOnDB') {
                    swal("Username già presente", "", "error");
                    console.log(data);
                } else if(data == 'ok'){
                    window.location.href = "login?messaggio=Utente+registrato+con+successo%21";
                } else {
                    console.log(data);
                }
                
            },
            error: function() {
                alert('Errore nella richiesta AJAX' + data);
            }
        });
    });
}
// Cripta la pass
function criptaPass() {
    $('#cripta').click(function() {
        let sito = $('input[name="sito"]').val();
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();
        let key = $('input[name="key"]').val();

        if (key.length >= 8) {
            $.ajax({
                type: 'POST',
                url: '../inc/cripta.php',
                data: { sito: sito, username: username, password: password, key: key},
                success: function(data) {
                    swal("Ottimo!", "Hai ottenuto la tua password", "success");
                    $('#criptoPass').toggleClass('hide');
                    $('input').val('');
                    $('#messaggio').html(data);
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
            url: '../inc/decripta.php', // Percorso relativo corretto
            data: { password: password, key: key},
            success: function(data) {
                swal("Ottimo!", "Hai ottenuto la tua password", "success");
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
        let password = $("#pass-" + decriptId).text();
        swal("Scrivi la tua key", {
        content: "input",
        })
        .then((key) => {
            //console.log(password);
            $.ajax({
                type: 'POST',
                url: '../inc/decripta.php', // Percorso relativo corretto
                data: { password: password, key: key},
                success: function(data) {
                    $("#pass-" + decriptId).html(data);
                    $('#'+ decriptId+'.decript').addClass('hide');
                    //console.log($("#" + decriptId));
                    $("#reset-" + decriptId).removeClass('hide').addClass('show');
                    $("#reset-" + decriptId).click(function() { 
                        $("#pass-" + decriptId).text(password);
                        $("#reset-" + decriptId).addClass('hide').removeClass('show');
                        $('#'+ decriptId+'.decript').removeClass('hide').addClass('show');
                    });
                },
                error: function() {
                    alert('Errore nella richiesta AJAX');
                }
            });
        });
    });
}
// Elimina la pass nella tabella (pag. Le Password)
function deletePassTable() {
    $(".deletePass").click(function() {
        let idPass = $(this).attr("id");
        swal({
            title: "Sei sicuro?",
            text: "Una volta eliminato, non sarai in grado di recuperala",
            icon: "warning",
            buttons: ["Annulla", "Elimina"],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: '../inc/elimina_pass.php', // Percorso relativo corretto
                    data: { idPass: idPass},
                    success: function(data) {
                        swal("Poof! La tua password è stata eliminata", {
                            icon: "success",
                        })
                        .then(() => {
                            location.reload(); // Aggiorna la pagina
                        });
                    },
                    error: function() {
                        alert('Errore nella richiesta AJAX');
                    }
                });
            }
        });
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
                url: '../inc/cambia-password.php', // Percorso relativo corretto
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

