/**
 * @param {string} email
 * @returns {boolean} The result of the check
 */
function email_isDuplicate(email) {
    return $.ajax({
        url: 'http://localhost/hurgada-grnd-hotel/global/js/ajax_php/email_is_duplicate.php',
        data: "key=" + email,
        type: "POST",
        success: function (result) {
            return parseInt(result);
        }
    })
}

/**
 * @param {string} email
 * @param {string} err_msg_id
 */
async function email_isDuplicate_msg(email, err_msg_id) {
    console.log("Checking if mail is duplicate...")
    const err_msg_1 = "Email already exists";
    const key = email;
    let resultBar = $("#" + err_msg_id);

    if (key === '') {
        resultBar.html('');
        return;
    }
    let check = new Promise(function (resolve, reject) {
        resolve(email_isDuplicate(key))
    });
    let stat = await check;
    console.log(`Email: ${email}\t Duplicate: ${stat}`)
    if (stat) {
        resultBar.html(err_msg_1);
        return;
    }
    resultBar.html("Email is available");
}