function switchTab(tabId) {
    var tabContents = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = "none";
    }
    document.getElementById(tabId).style.display = "block";

    var tabButtons = document.getElementsByClassName("tab-button");
    for (var i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove("active");
    }
    document.getElementById("tab-" + tabId.split("-")[1]).classList.add("active");
}


$(document).ready(function() {
    function switchTab(contentId) {
        $('.tab-content').hide();
        $('#' + contentId).show();
        $('.tab-button').removeClass('active');
        $('button[onclick="switchTab(\'' + contentId + '\')"]').addClass('active');
    }

    // Show the content of the default active tab
    $('.tab-content').hide();
    $('.tab-content:first').show();

    // Fetch user information when "Compte" tab is clicked
    $('#content-compte').on('click', function() {
        $.ajax({
            url: '../PHP/get_user_info.php', // Replace with your actual PHP script URL
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#nom').val(response.Nom);
                    $('#prenom').val(response.Prenom);
                    $('#date_naissance').val(response.Date_Naissance);
                }
            },
            error: function() {
                alert("Une erreur s'est produite lors de la récupération des informations de l'utilisateur.");
            }
        });
    });

    // Edit button functionality
    $('#edit-btn').on('click', function() {
        $('input').prop('readonly', false);
        $('#edit-btn').hide();
        $('#save-btn').show();
    });

    // Save button functionality
    $('#user-info-form').on('submit', function(e) {
        e.preventDefault();
        const userInfo = {
            nom: $('#nom').val(),
            prenom: $('#prenom').val(),
            date_naissance: $('#date_naissance').val()
        }

        $.ajax({
            url: '../PHP/update_user_info.php', // Replace with your actual PHP script URL for updating
            method: 'POST',
            data: userInfo,
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    alert('Informations mises à jour avec succès');
                    $('input').prop('readonly', true);
                    $('#edit-btn').show();
                    $('#save-btn').hide();
                }
            },
            error: function() {
                alert("Une erreur s'est produite lors de la mise à jour des informations.");
            }
        });
    });

    // Logout button functionality
    $('#logout-btn').on('click', function() {
        $.ajax({
            url: '../PHP/logout.php', // Replace with your actual PHP script URL for logout
            method: 'POST',
            success: function() {
                window.location.href = '../HTML/login.html'; // Replace with your actual login page URL
            },
            error: function() {
                alert("Une erreur s'est produite lors de la déconnexion.");
            }
        });
    });
});