// unintended decoration

// export function getHoroscope() {
//     let form1 = new FormData(document.getElementById('board1'));
//     let form2 = new FormData(document.getElementById('board2'));
//     let data = new Object();
//     data.board1 = Object.fromEntries(form1);
//     data.board2 = Object.fromEntries(form2);
//     data = JSON.stringify(data);
//     return data;
// }

export default (form, contentType, addition) => {
    let formData;
    if (form instanceof HTMLFormElement) {
        formData = new FormData(form);
    }
    else if(form instanceof FormData){
        formData = form;
    } else {
        formData = new FormData();
    }
    if (addition) {
        if (contentType !== 'application/json') {
            for (const [key, value] of Object.entries(addition)) {
                formData.append(key, value);
            }
        }
    }
    let data = null;
    switch (contentType) {

        case "multipart/form-data": data = formData;
            break;
        case "application/json":
            if(addition){
                data = JSON.stringify(Object.assign(Object.fromEntries(formData), addition));
                break;
            }
            data = JSON.stringify(Object.fromEntries(formData));
            break;
        case "application/x-www-form-urlencoded": data = new URLSearchParams(formData);
            break;

    }
    return data;
}
