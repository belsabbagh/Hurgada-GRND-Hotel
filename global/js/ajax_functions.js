/**
 * @param {string} email
 * @param {string} err_msg_id
 */
function email_isDuplicate(email, err_msg_id) {
    console.log("Checking if mail is duplicate...")
    const err_msg_1 = "Email already exists";
    const key = email;
    let resultBar = $("#" + err_msg_id);

    if (key === '') {
        resultBar.html('');
        return;
    }
    $.ajax({
        url: 'http://localhost/hurgada-grnd-hotel/global/js/ajax_php/email_is_duplicate.php',
        data: "key=" + key,
        type: "POST",
        success: function (result) {
            let stat = parseInt(result);
            console.log(`Duplicate email: ${stat}`)
            if (stat === 1) resultBar.html(err_msg_1);
            if (stat === 0) resultBar.html("Email is available");
        }
    });
}