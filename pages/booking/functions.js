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