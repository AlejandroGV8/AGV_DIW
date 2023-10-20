document.addEventListener('DOMContentLoaded', function() {
    var deleteLinks = document.querySelectorAll('.delete');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var confirmation = confirm('¿Estás seguro de que deseas eliminar este registro?');
            
            if (confirmation) {
                var userId = link.getAttribute('data-id');
                window.location.href = '../php/eliminar.php?id=' + userId;
            }
        });
    });
});