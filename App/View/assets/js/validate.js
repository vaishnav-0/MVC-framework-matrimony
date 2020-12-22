function getValidRule(rule) {
    switch (rule) {
        case "email":
            return {
                title: "email",
                stop: true,
                required: true,
                email: true
            }
            break;


    }
}

function validate(feild, errnode) {

    valRes = approve.value(feild.value, getValidRule(feild.dataset.validate));
    if (valRes.errors.length) {
        if (errnode.querySelector("#errMsg")) {
            errnode.querySelector("#errMsg").classList.remove("errmsg-fadeout");
            errmsg = errnode.querySelector("#errMsg");
            errmsg.textContent = '';
            valRes.each(function(error) {
                errmsg.textContent += error;
            });
            window.setTimeout(() => {
                errnode.querySelector("#errMsg").classList.add("errmsg-fadeout");
            }, 4000);
        } else {
            valTemp = validationErr.content;
            data = {
                "errMsg": ""
            };
            valRes.each(function(error) {
                data.errMsg += error;
            });
            renderTemp(valTemp, data, errnode);
            window.setTimeout(() => {
                errnode.querySelector("#errMsg").classList.add("errmsg-fadeout");
            }, 2000);
        }
    } else {
        if (errnode.querySelector("#errMsg")) {
            errnode.textContent = '';
        }
    }

}