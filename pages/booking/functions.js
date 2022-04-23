function change_max_beds() {
    const radioButtons = document.getElementsByName('room_type');
    radioButtons.forEach(element => {
        if (element.checked) {
            let val = document.getElementById('room_beds_number').value;
            switch (element.id) {
                case 'room_type_standard_room':
                    document.getElementById('room_beds_number').max = 4;
                    break;
                case 'room_type_chalet':
                    document.getElementById('room_beds_number').max = 6;
                    break;
                case 'room_type_beachside_villa':
                    document.getElementById('room_beds_number').max = 8;
                    break;
                case 'room_type_duplex':
                    document.getElementById('room_beds_number').max = 5;
                    break;
                case 'room_type_apartment':
                    document.getElementById('room_beds_number').max = 5;
                    break;
                default:
                    document.getElementById('room_beds_number').max = 4;
                    break;
            }
            if (document.getElementById('room_beds_number').max < val) {
                document.getElementById('room_beds_number').value = document.getElementById('room_beds_number').max;
            }
        }
    });
}
/**
 *
 * @param {string} name
 */
function clear(name) {
    let radios = document.getElementsByName(name);
    radios.forEach(element => {
        element.checked = 0;
    })
}

function clear_filters() {
    clear("room_type");
    clear("room_view");
    clear("outdoors");
}

function get_max(elementID) {
    switch (elementID) {
        case 'room_type_standard_room':
            return 4;
        case 'room_type_chalet':
            return 6;
        case 'room_type_beachside_villa':
            return 8;
        case 'room_type_duplex':
            return 5;
        case 'room_type_apartment':
            return 5;

        default:
            return 4;
    }
}

function set_date_constraints() {
    let today = new Date();
    let date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    console.log(date);
    document.getElementById('checkin').min = date;
    document.getElementById('checkout').min = date;
}