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

export default (elementId, contentType) => {
    let element = document.getElementById(elementId);
    let form = new FormData(element);
    let data = null;
    switch (contentType) {

        case "multipart": data = form;
            break;
        case "json": data = JSON.stringify(Object.fromEntries(form));
            break;
        case "urlencoded": data = new URLSearchParams(form);
            break;

    }
    return data;
}
