function checkEmail(email) {
    let filter = /^([a-zA-Z\d_.\-])+@(([a-zA-Z\d\-])+\.)+([a-zA-Z\d]{2,4})+$/;
    return filter.test(email.value);
}

/**
 * @param {string} email
 * @param {string} err_msg_id
 */
async function email_isDuplicate_msg(email, err_msg_id) {
    console.log("Checking if mail is duplicate...")
    const err_msg_1 = "Email already exists";
    const key = email;
    let resultBar = document.getElementById(err_msg_id);

    if (key === '') {
        resultBar.innerHTML = ('');
        return;
    }
    let xmlHttp = new XMLHttpRequest();
    let params = "key=" + email;
    let url = 'http://localhost/hurgada-grnd-hotel/global/js/ajax_php/email_is_duplicate.php'
    xmlHttp.open("GET", url + "?" + params, true);
    xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            let stat = parseInt(xmlHttp.responseText);
            console.log(`Email: ${email}\t Duplicate: ${stat}`)
            if (stat) {
                resultBar.innerHTML = (err_msg_1);
                return;
            }
            resultBar.innerHTML = ("Email is available");
        }
    };
    xmlHttp.send(params);
}