$("#date").flatpickr({
    dateFormat: "d-m-Y",
    mode: "range"
});

$('.btn-confirm').on('click', function (e) {
    e.preventDefault();

    let form = $(this).closest('form');
    let reservation = JSON.parse($(this).attr('reservation'));
    let id = reservation.id;
    let name = reservation.patient.name + ' ' + reservation.patient.last_name;

    Swal.fire({
        html: `
            <td class="item-name">
               <span class="text-gray-900 fw-bold">Confirmar la asitencia del paciente:</span> <br>
               <span class="text-gray-800 fw-bold"> ID: ${id} </span> <br>
               <span class="text-gray-800 fw-bold"> ${name}</span>
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

$('.btn-cancel').on('click', function (e) {
    e.preventDefault();

    let form = $(this).closest('form');
    let reservation = JSON.parse($(this).attr('reservation'));
    let id = reservation.id;
    let name = reservation.patient.name + ' ' + reservation.patient.last_name;

    Swal.fire({
        html: `
            <td class="item-name">
               <span class="text-danger fw-bold">Cancelar la cita del paciente:</span> <br>
               <span class="text-danger fw-bold"> ID: ${id} </span> <br>
               <span class="text-danger fw-bold"> ${name}</span>
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