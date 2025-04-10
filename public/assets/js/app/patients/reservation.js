const calendar = document.getElementById('calendar');
const today = new Date();
const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
const lastDayOfNextMonth = new Date(today.getFullYear(), today.getMonth() + 2, 0);
let availableDates = [];

Livewire.on('datePicker', (dates) => {
    availableDates = dates[0][0];
    initDate(lastDayOfNextMonth, availableDates);
});

calendar.setAttribute('readonly', true);


function initDate(lastDayOfNextMonth, availableDates) {
    calendar.removeAttribute('readonly');
    calendar.setAttribute('placeholder', 'Seleccione una fecha');
    calendar.setAttribute('autocomplete', 'off');

    flatpickr("#calendar", {
        mode: "single",
        dateFormat: "d-m-Y",
        minDate: "today",
        maxDate: lastDayOfNextMonth,
        disable: [
            function (date) {
                return true;
            }
        ],
        enable: availableDates,
        onDayCreate: function (dObj, dStr, dFrag, dayObj) {
            if (availableDates.includes(dayObj.dateStr)) {
                dayObj.classList.add('disabled-date');
            }
        },
    });
}