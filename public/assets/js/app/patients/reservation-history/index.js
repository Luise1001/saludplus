$('.btn-cancel').on('click', function (e) {
    e.preventDefault();

    let form = $(this).closest('form');
    let reservation = JSON.parse($(this).attr('reservation'));
    let id = reservation.id;

    Swal.fire({
        html: `
            <td class="item-name">
               <span class="text-danger fw-bold">Cancelar la cita:</span> <br>
               <span class="text-danger fw-bold"> ID: ${id} </span> 
            </td>
            `,
        icon: "warning",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: "btn btn-warning order-1 right-gap",
            cancelButton: 'btn btn-danger'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else {
            return false;
        }
    });
});